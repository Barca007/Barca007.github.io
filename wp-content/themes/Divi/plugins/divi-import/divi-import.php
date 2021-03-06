<?php
/*
Plugin Name: Divi Import
Plugin URI: https://www.reg.ru
Description: Плагин для увтвлога и импорт готовых шаблонов.
Version: 0.2
Author: Denis Lapshin
Author URI: https://www.reg.ru
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) die();


/**
 * Main plugin class with initialization tasks.
 */
class DiviImportInit {
  /**
   * Constructor for this class.
   */
  public function __construct() {
    // Set plugin constants.
    $this->set_plugin_constants();

    // Require the main plugin class.
    require_once DIVI_IMPORT_PATH . 'includes/DiviImport.php';

    // Actions
    add_action( 'admin_menu', array( $this, 'create_plugin_page' ) );
    add_action( 'wp_ajax_di_import_demo_data', array( $this, 'di_import_demo_data_ajax_callback' ) );
  }

  /**
	 * Creates the plugin page and a submenu item in WP Appearance menu.
	 */
	public function create_plugin_page() {
		$this->plugin_page_setup = apply_filters( 'plugin_page_setup', array(
			'parent_slug' => 'themes.php',
			'page_title'  => esc_html__( 'One Click Demo Import' , 'Divi' ),
			'menu_title'  => esc_html__( 'Import Demo Data' , 'Divi' ),
			'capability'  => 'import',
			'menu_slug'   => 'divi-import',
		) );

		$this->plugin_page = add_submenu_page(
			$this->plugin_page_setup['parent_slug'],
			$this->plugin_page_setup['page_title'],
			$this->plugin_page_setup['menu_title'],
			$this->plugin_page_setup['capability'],
			$this->plugin_page_setup['menu_slug'],
			apply_filters( 'plugin_page_display_callback_function', array( $this, 'display_plugin_page' ) )
		);

		register_importer( $this->plugin_page_setup['menu_slug'], $this->plugin_page_setup['page_title'], $this->plugin_page_setup['menu_title'], apply_filters( 'plugin_page_display_callback_function', array( $this, 'display_plugin_page' ) ) );
  }
  
  /**
	 * Main AJAX callback function
	 */
  public function di_import_demo_data_ajax_callback() {
    // Try to update PHP memory limit and max execution time.
    ini_set( 'memory_limit', '512M' );
    ini_set( 'max_execution_time', 300 );

    $import_selected = DiviImport::get_import_selected_demo();

    // Initiate import process
    DiviImport::import_init( $import_selected, false );
  }


  /**
   * Display Divi Import page.
   */
  public function display_plugin_page() {
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );

    wp_enqueue_style( 'DiviImportPluginStylesheet', DIVI_IMPORT_URL . 'assets/main.css' );
    wp_enqueue_script( 'DiviImportPluginScript', DIVI_IMPORT_URL . 'assets/main.js', array( 'jquery', 'jquery-ui-dialog' ), DI_VERSION );

    wp_localize_script('DiviImportPluginScript', 'ocdi',
      array (
        'import_files'     => DiviImport::get_all_templates(),
        'ajax_url'         => admin_url( 'admin-ajax.php' ),
        'ajax_nonce'       => wp_create_nonce( 'ocdi-ajax-verification' ),
        'import_popup'     => apply_filters( 'pt-ocdi/enable_grid_layout_import_popup_confirmation', true ),
        'texts'            => array(
          'missing_preview_image' => esc_html__( 'No preview image defined for this import.', 'Divi' ),
          'dialog_title'          => esc_html__( 'Are you sure?', 'Divi' ),
          'dialog_no'             => esc_html__( 'Cancel', 'Divi' ),
          'dialog_yes'            => esc_html__( 'Yes, import!', 'Divi' ),
          'selected_import_title' => esc_html__( 'Selected demo import:', 'Divi' ),
        ),
        'dialog_options' => apply_filters( 'pt-ocdi/confirmation_dialog_options', array() )
      )
    );
    require_once DIVI_IMPORT_PATH . 'templates/plugin-page.php';
  }


  /**
   * Set plugin constants.
   */
  private function set_plugin_constants() {
    // Path to root of this plugin, with trailing slash.
    if ( !defined('DIVI_IMPORT_PATH') ) {
      define( 'DIVI_IMPORT_PATH', get_template_directory() . '/plugins/divi-import/' );
    }
    
    // URL to root of this plugin, with trailing slash.
    if ( !defined('DIVI_IMPORT_URL') ) {
      define( 'DIVI_IMPORT_URL', get_template_directory_uri() . '/plugins/divi-import/' );
    }

    if ( ! defined( 'DI_VERSION' ) ) {
      $get_headers = [ 'ver'=>'Version', 'author'=>'Author', 'name'=>'Plugin Name' ];
			$plugin_data = get_file_data( __FILE__, $get_headers );
			define( 'DI_VERSION', $plugin_data['ver'] );
		}
  }
}


// Instantiate the plugin class.
if ( ! preg_match( '/turnkey.reg.ru/i', home_url() ) ) {
  $DiviImportPlugin = new DiviImportInit();
}