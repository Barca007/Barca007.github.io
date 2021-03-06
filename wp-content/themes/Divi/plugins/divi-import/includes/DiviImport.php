<?php

/**
 * Main class for import premade REG.Site templates
 * 
 * @since 4.7.5.2
 */
class DiviImport {

  /**
   * Get templates from API
   * 
   * @since 4.7.5.2
   * @return object 
   */
  public static function get_json_content() {
    $response = wp_remote_get('https://api.turnkey.reg.ru/wordpress/console/api/templates/read.php');
    return json_decode( wp_remote_retrieve_body( $response ), true);
  }


  public static function get_all_categories() {
    $categories = array();
    $import_categories = self::get_json_content();

    foreach ($import_categories as $value) {
      $value['categories'] = explode(', ', $value['categories']);
      array_push($categories, $value['categories']);
    }

    $arrOut = array();
    foreach($categories as $subArr){
      $arrOut = array_merge($arrOut,$subArr);
    }
  
    $arrOut = array_map('strtolower', $arrOut);
    return array_unique($arrOut);
  }

  static function get_all_templates() {
    $import_templates = self::get_json_content();
    return $import_templates;
  }


  /**
	 * Import Init
	 */
  public static function import_init( $import_selected, $import_data ) {
 
    // Selected demo import data
    $is_admin_import = false;
    if ( $import_selected !== false ) {
      $is_admin_import = true;

      $import_selected_content = self::get_json_content();
      $import = $import_selected_content[$import_selected];
    } elseif ( $import_data !== false ) {
      $import = $import_data;
    }

    // Verify if the AJAX call is valid (checks nonce and current_user_can).
    if ( $is_admin_import ) {
      self::verify_ajax_call();
    }

    // Delete uploads directory if exists
    self::delete_uploads_directory();

    // Download and extract uploads.zip
    self::import_uploads( $import );

    // Get admin email before database import
    $admin_email = null;
    if ( $is_admin_import ) {
      $admin_email = self::get_admin_email_before_import();
    }

    // Download and import dump.sql
    self::import_dump( $import );

    // Some actions above plugins
    $template_settings = self::get_template_settings( $import );
    
    if ( $template_settings !== null ) {
      self::import_settings( $template_settings );
    }

    if ( $template_settings['plugins'] ) {
      $plugins = $template_settings['plugins'];
      require_once dirname( __FILE__ ) . '/InstallPlugins.php';
      $install_plugins = new InstallPlugins();

      $install_plugins->init( $plugins );
    }

    // Delete divi cache directory
    self::delete_divi_cache();

    // Count template installation
    self::count_import( $import );

    // Set which template was imported at last
    self::set_divi_template_option( $import );

    // Insert admin email after database import
    self::insert_admin_email_after_import( $admin_email );

    // Success message
    if ( $is_admin_import ) {
      $return['message'] = sprintf(
        __( '%1$s%3$sThat\'s it, all done!%4$s%2$sThe demo import has finished. Please %3$s%5$scheck your page%6$s%4$s and make sure that everything has imported correctly. If it did, you can deactivate the %3$sOne Click Demo Import%4$s plugin, because it has done its job.%7$s', 'Divi' ),
        '<div><p>',
        '<br>',
        '<strong>',
        '</strong>',
        '<a href="'.site_url().'">',
        '</a>',
        '</p></div>'
      );
      wp_send_json_success( $return );
    } else {
      echo 'SUCCESS';
    }
  }


  /**
   * Insert admin email after database import
   * 
   * @since 4.9.0.5
   * @param string $admin_email 
   */
  private static function insert_admin_email_after_import( $admin_email ) {
    $email = $admin_email;
    $admin_email_file = dirname( __FILE__, 4 ) . '/email.txt';

    if ( file_exists( $admin_email_file ) ) {
      $email = file_get_contents( $admin_email_file );
      unlink( $admin_email_file );
    }
   
    wp_cache_flush();
    update_option( 'admin_email', $email );
  }


  /**
   * Get admin email before database import
   * 
   * @since 4.9.0.5
   * @return string
   */
  private static function get_admin_email_before_import() {
    $return = get_option( 'admin_email' );
    return $return;
  }


  /**
   * Import customizer settings
   * 
   * @since 4.7.5.2
   * @return void 
   */
  private static function import_settings( $settings ) {
    if ( isset( $settings['data'] ) ) {
      update_option( 'et_divi', $settings['data'] );
    }
  }


  /**
   * Get settings from file settings.json
   * 
   * @since 4.7.5.2
   * @return object|false 
   */
  private static function get_template_settings( $import ) {
    $required_plugins_file = dirname( __FILE__ ) . '/required_plugins.json';
    $required_plugins = json_decode( file_get_contents( $required_plugins_file ), true );

    if ( $import['url_settings'] !== null ) {
      $settings_url   = $import['url_settings'];
      $response       = wp_remote_get( $settings_url );

      if ( wp_remote_retrieve_response_code( $response ) === 404 ) {
        $return['message'] = 'Файл settings.json отсутствует на удаленном сервере.';
        wp_send_json_error( $return );
      }
      $result = json_decode( wp_remote_retrieve_body( $response ), true );

      $required_plugins = array_merge_recursive( $required_plugins, $result );
    }

    return $required_plugins;
  }


  /**
   * Set which template was imported at last.
   * 
   * @since 4.7.5.2
   * @return void 
   */
  private static function set_divi_template_option( $import ) {
    if ( ! get_option( 'divi_template' ) ) {
      add_option( 'divi_template', $import['slug'] );
    } else {
      update_option( 'divi_template', $import['slug'] );
    }
  }


  /**
	 * Count template imports
	 */
  public static function count_import($import) {
    $args = [
      'slug' => $import['slug']
    ];

    $url = 'https://api.turnkey.reg.ru/wordpress/console/api/templates/count.php';
    $data = wp_remote_post($url, array(
      'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
      'body'        => json_encode($args),
      'method'      => 'POST',
      'data_format' => 'body',
    ));
  }


  /**
	 * Delete divi cache directory
	 */
  public static function delete_divi_cache() {
    $divi_cache_directory  = WP_CONTENT_DIR . '/et-cache';

    // Delete divi cache directory if exists
    if ( is_dir( $divi_cache_directory ) ) {
      self::remove_directory( $divi_cache_directory );
    }
  }

  /**
	 * Download and import dump.sql
	 */
  public static function import_dump($import) {

    $dump_url = $import['url_dump'];
    $demo_url = $import['url_preview'];
    $demo_dump_file = WP_CONTENT_DIR . '/dump.sql';

    // Download dump.sql to wp-content directory
    if( !file_put_contents( $demo_dump_file, file_get_contents( $dump_url ) )) {
      $return['message'] = 'Файл dump.sql не найден.';
      wp_send_json_error($return);
    }

    // Replace old url to new from get_site_url()
    $dump_data = file_get_contents( $demo_dump_file );
    $dump_data = str_replace( $demo_url, get_site_url(), $dump_data );
    file_put_contents( $demo_dump_file, $dump_data );

    // Fix serialization
    // self::fix_serialization( $demo_dump_file );

    // Drop tables before import.
    self::drop_tables();

    // Import MySQL
    $output = shell_exec("mysql -h ".DB_HOST." -u ".DB_USER." -p'".DB_PASSWORD."' ".DB_NAME." < ".$demo_dump_file);

    // Upgrade MySQL
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    upgrade_all();


    // Delete dump.sql
    if ( ! unlink( $demo_dump_file )) {
      $return['message'] = 'Не удалось удалить файл dump.sql.';
      wp_send_json_error( $return );
    }
  }


  /**
   * Drop tables before import.
   */
  private static function drop_tables () {
    global $wpdb;

    // Get tables list in array.
    $query = $wpdb->get_results( "SHOW TABLES", ARRAY_N );

    // Set foreign key checks off.
    $wpdb->query( 'SET foreign_key_checks=0' );

    foreach( $query as $row ) {
      // Except important users tables.
      if ( $row[0] == $wpdb->prefix .'users' ) continue;
      if ( $row[0] == $wpdb->prefix .'usermeta' ) continue;

      // Drop other tables.
      $wpdb->query( "DROP TABLE IF EXISTS $row[0]" );
    }

    // Set foreign key checks on.
    $wpdb->query( 'SET foreign_key_checks=1' );
  }


  /**
   * Fix serialization before dump import
   */
  private static function fix_serialization( $path ) {
    function unescape_mysql( $value ) {
      return str_replace(array("\\\\", "\\0", "\\n", "\\r", "\Z",  "\'", '\"'),
                 array("\\",   "\0",  "\n",  "\r",  "\x1a", "'", '"'), 
                 $value);
    }
    function unescape_quotes( $value ) {
      return str_replace( '\"', '"', $value );
    }

    if ( ! file_exists( $path ) ) {
      $return['message'] = 'Не найден dump.sql.';
      wp_send_json_error($return);
    } else {
      if (!($fp = fopen($path, 'r'))) {
        echo 'Error: can`t open input file for read'."\n";
        echo $path."\n\n";
      } else {
        $do_preg_replace = false;
        if (!($data = fread($fp, filesize($path)))) {
          echo 'Error: can`t read entire data from input file'."\n";
          echo $path."\n\n";
        } elseif (!(isset($data) && strlen($data) > 0)) {
          echo "Warning: the file is empty or can't read contents\n";
          echo $path."\n\n";
        } else {
          $do_preg_replace = true;
          $data = preg_replace_callback( '/s\:(\d+)\:\"(.*?)\";/s',    function($matches){return 's:'.strlen($matches[2]).':"'.$matches[2].'";'; },   $data );
        }
        fclose($fp);
        if (!(isset($data) && strlen($data) > 0)) {
          if ($do_preg_replace) {
            echo "Error: preg_replace returns nothing\n";
            if (function_exists('preg_last_error')) echo "preg_last_error() = ".preg_last_error()."\n";
            echo $path."\n\n";
          }
        } else {
          if (!($fp = fopen($path, 'w'))) {
            echo "Error: can't open input file for writing\n";
            echo $path."\n\n";
          } else {
            if (!fwrite($fp, $data)) {
              echo "Error: can't write input file\n";
              echo $path."\n\n";
            }
            fclose($fp);
          }
        }
      }
    }
  }


  /**
	 * Download and extract uploads.zip
	 */
  public static function import_uploads($import) {

    // If ZipArchive class exists
    if ( ! class_exists('ZipArchive') ) {
      $return['message'] = 'PHP класс ZipArchive() не найден.';
      wp_send_json_error($return);
    }


    $uploads_file_url     = $import['url_file'];
    $uploads_extract_dir  = WP_CONTENT_DIR;
    $uploads_file_name    = $uploads_extract_dir . '/uploads.zip';

    // Download uploads.zip to wp-content directory
    if( !file_put_contents($uploads_file_name, file_get_contents($uploads_file_url))) {
      $return['message'] = 'Архив uploads.zip не найден.';
      wp_send_json_error($return);
    }


    // Extract uploads.zip
    $zip = new ZipArchive;
    if ( ! $zip->open( $uploads_file_name )) {
      $return['message'] = 'Не удалось распаковать файл uploads.zip.';
      wp_send_json_error( $return );
    }
    $zip->extractTo( $uploads_extract_dir );
    $zip->close();


    // Delete uploads.zip
    if ( ! unlink( $uploads_file_name )) {
      $return['message'] = 'Не удалось удалить файл uploads.zip.';
      wp_send_json_error( $return );
    }
  }


  /**
	 * Delete uploads directory if exists.
	 */
  public static function delete_uploads_directory() {
    $uploads_directory = WP_CONTENT_DIR . '/uploads';

    // Delete directory uploads if exists
    if ( is_dir( $uploads_directory ) ) {
      self::remove_directory( $uploads_directory );
    }
  }


  /**
	 * Check if the AJAX call is valid.
	 */
  public static function verify_ajax_call() {
		check_ajax_referer( 'ocdi-ajax-verification', 'security' );

		// Check if user has the WP capability to import data.
		if ( ! current_user_can( 'import' ) ) {
      $return = array(
        'message' => sprintf(__( '%sYour user role isn\'t high enough. You don\'t have permission to import demo data.%s', 'Divi' ), '<p>', '</p>'),
      );
      return wp_send_json_error($return);
    }
  }

  /**
	 * Get selected file index or set it to 0.
	 */
  public static function get_import_selected_demo() {
    $selected_indexes = empty( $_POST['selected'] ) ? 0 : absint( $_POST['selected'] );
    
    return $selected_indexes;
  }


  /**
	 * Recursive remove directory 
	 */
  public static function remove_directory($src) {
		$dir = opendir($src);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				$full = $src . '/' . $file;
				if ( is_dir($full) ) {
					self::remove_directory($full);
				}
				else {
					unlink($full);
				}
			}
		}
		closedir($dir);
    rmdir($src);
    
		return true;
	}
}