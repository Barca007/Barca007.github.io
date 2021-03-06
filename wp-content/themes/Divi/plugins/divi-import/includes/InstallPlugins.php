<?php

require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-includes/pluggable.php');
require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/misc.php' );
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
require_once( dirname( __FILE__ ) . '/Disable_Plugin_Updates_Translations.php' );

/**
 * Overwrite the feedback method in the WP_Upgrader_Skin
 * to suppress the normal feedback.
 */
class Quiet_Upgrader_Skin extends \WP_Upgrader_Skin {
  public function feedback( $string, ...$args ) { 
    /* silence */
  }
  public function header() { 
    /* silence */
  }
  public function footer() { 
    /* silence */
  }

  public function before() {
    /* silence */
  }

  public function after() {
    /* silence */
  }
}


class InstallPlugins {

  /**
   * Activate required plugins and install (including custom) if neccessary.
   * 
   * @since 4.7.5.2
   * 
   * @param array $plugins
   * 
   * @return array
   */
  public function init( $plugins ) {

    // To dismiss translation notices when plugin install
    new Disable_Plugin_Updates_Translations();

    if ( $plugins ) {
      self::activate_required_plugins( $plugins );
    } else {
      $return['message'] = 'Проверка необходимых плагинов завершилась с ошибкой.';
      wp_send_json_error( $return );
    }
  }


  /**
   * Activate required plugins and install (including custom) if neccessary.
   * 
   * @since 4.7.5.2
   * @param array $plugins
   * @return array
   */
  private static function activate_required_plugins( $plugins ) {

    // Install plugins from wordpress repository if neccessary.
    foreach ( $plugins as $plugin ) {
      $error = self::start_activate_plugin( $plugin );
    }

    // Install custom plugins if neccessary.
    foreach ( $plugins as $plugin ) {
      if ( ! self::is_plugin_installed( $plugin ) ) {
        $error = self::install_custom_plugin( $plugin );
      }
    }

    // Activate required plugins.
    foreach ( $plugins as $plugin ) {
      if ( self::is_plugin_installed( $plugin ) ) {
        $error = self::activate_installed_plugin( $plugin );
      }
    }
  }


  /**
   * Install custom plugin
   * 
   * @since 4.7.5.2
   * @param string $plugin
   * @return null|string Null when install was succesfull, otherwise error message.
   */
  private static function install_custom_plugin( $plugin ) {
    $plugin_name        = self::get_plugin_dir( $plugin );
    $plugin_url         = 'https://api.turnkey.reg.ru/wordpress/plugins/' . $plugin_name . '.zip';
    $plugin_file_name   = WP_PLUGIN_DIR . '/' . $plugin_name . '.zip';

    // Download plugin archive to plugin directory
    if ( ! file_put_contents( $plugin_file_name, file_get_contents( $plugin_url ) ) ) {
      $return['message'] = 'Плагин ' . $plugin_name . ' не найден.';
      wp_send_json_error( $return );
    }

    // Extract plugin archive
    $zip = new ZipArchive;
    if ( ! $zip->open( $plugin_file_name ) ) {
      $return['message'] = 'Не удалось распаковать файл архив с плагином.';
      wp_send_json_error( $return );
    }
    $zip->extractTo( WP_PLUGIN_DIR );
    $zip->close();

    // Delete plugin archive
    if ( ! unlink( $plugin_file_name ) ) {
      $return['message'] = 'Не удалось удалить файл uploads.zip.';
      wp_send_json_error( $return );
    }
  }


  /**
   * Activates a given plugin. 
   * 
   * If needed it dowloads and/or installs the plugin first.
   *
   * @since 4.7.5.2
   * @param string $plugin The plugin's basename (containing the plugin's base directory and the bootstrap filename).
   * @return void
   */
  private static function start_activate_plugin( $plugin ) {
    $plugin_mainfile = trailingslashit( WP_PLUGIN_DIR ) . $plugin;

    if ( is_plugin_active( $plugin ) ) {
      $error = validate_plugin( $plugin );
      if ( ! is_wp_error( $error ) ) {
          return;
      }
    }

    if ( ! self::is_plugin_installed( $plugin ) ) {
      $error = self::install_plugin( $plugin );
      if ( ! empty( $error ) ) {
        return $error;
      }
    }
  }


  /**
   * Activate plugin if installed
   * 
   * @since 4.9.0.2
   * @param  string  $plugin
   * @return null
   */
  private static function activate_installed_plugin( $plugin ) {
    $current = get_option( 'active_plugins' );

    if ( !in_array( $plugin, $current ) ) {
      $current[] = $plugin;
      sort( $current );
      do_action( 'activate_plugin', trim( $plugin ) );
      update_option( 'active_plugins', $current );
      do_action( 'activate_' . trim( $plugin ) );
      do_action( 'activated_plugin', trim( $plugin) );
    }

    return null;
  }


  /**
   * Check if plugin installed
   * 
   * @since 4.7.5.2
   * @param  string  $plugin
   * @return boolean
   */
  private static function is_plugin_installed( $plugin ) {
    $plugins = get_plugins( '/' . self::get_plugin_dir( $plugin ) );
    if ( ! empty( $plugins ) ) {
        return true;
    }
    return false;
  }


  /**
   * Extraxts the plugins directory (=slug for api) from the plugin basename.
   * 
   * @since 4.7.5.2
   * @param  string  $plugin
   * @return string
   */
  private static function get_plugin_dir( $plugin ) {
    $chunks = explode( '/', $plugin );
    if ( ! is_array( $chunks ) ) {
        $plugin_dir = $chunks;
    } else {
        $plugin_dir = $chunks[0];
    }
    return $plugin_dir;
  }


  /**
   * Intall a given plugin.
   * 
   * @since 4.7.5.2
   * @param  string  $plugin
   * @return null|string Null when install was succesfull, otherwise error message.
   */
  private static function install_plugin( $plugin ) {
    $api = plugins_api(
      'plugin_information',
        array(
          'slug'   => self::get_plugin_dir( $plugin ),
          'fields' => array(
            'short_description' => false,
            'requires'          => false,
            'sections'          => false,
            'rating'            => false,
            'ratings'           => false,
            'downloaded'        => false,
            'last_updated'      => false,
            'added'             => false,
            'tags'              => false,
            'compatibility'     => false,
            'homepage'          => false,
            'donate_link'       => false,
          ),
      )
    );
    
    $skin      = new Quiet_Upgrader_Skin( array( 'api' => $api ) );
    $upgrader  = new \Plugin_Upgrader( $skin );
    $error     = $upgrader->install( $api->download_link );
  }
}