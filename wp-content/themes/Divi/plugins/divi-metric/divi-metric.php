<?php
/*
Plugin Name: Divi Metric
Plugin URI: https://reg.ru
Description: Плагин для подсчета NPS вашего продукта.
Version: 0.1
Author: Denis Lapshin
Author URI: https://reg.ru
*/

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) die();


/**
 * Main plugin class with initialization tasks.
 */
class DiviMetricInit {

  /**
   * Constructor for this class.
   */
  public function __construct() {

    // Set plugin constants.
    $this->set_plugin_constants();

    // Require the main plugin class.
    require_once DIVI_METRIC_PATH . 'includes/DiviMetric.php';

    // Add first time option.
    DiviMetric::addFirstMetricOptions();

    // Check when show metric.
    if( DiviMetric::checkMetricOption() and DiviMetric::checkMonthPast() and DiviMetric::checkWeekPast()) {
      add_action( 'admin_notices', array( $this, 'divi_metric_admin_info_notice') );
      add_action( 'admin_menu', array( $this, 'divi_metric_admin_menu' ) );
    }
  }


  /**
   * Display admin notice to take poll.
   */
  public function divi_metric_admin_info_notice() {
    $notice_messege = 'Пожалуйста, <a href="'.get_admin_url( null, 'admin.php?page=divi-metric' ).'">оцените</a> работу конструктора REG.Site.';
    echo '<div class="notice notice-info dm-notice"><p>' . $notice_messege . '</p></div>';
  }


  /**
   * Add page with poll metric.
   */
  public function divi_metric_admin_menu() {
    add_menu_page(
      __( 'Divi Metric', 'Divi' ),
      'Оцените услугу',
      'manage_options',
      'divi-metric',
      array( $this, 'divi_metric_display_plugin_page'),
      'dashicons-admin-comments',
      99
    );
  }


  /**
   * Display Divi Metric page.
   */
  public function divi_metric_display_plugin_page() {
    wp_enqueue_style( 'DiviMetricPluginStylesheet', DIVI_METRIC_URL . 'assets/main.css' );
    require_once DIVI_METRIC_PATH . 'templates/plugin-page.php';
  }


  /**
   * Set plugin constants.
   */
  private function set_plugin_constants() {
    // Path to root of this plugin, with trailing slash.
    if ( !defined('DIVI_METRIC_PATH') ) {
      define( 'DIVI_METRIC_PATH', get_template_directory() . '/plugins/divi-metric/' );
    }
    
    // URL to root of this plugin, with trailing slash.
    if ( !defined('DIVI_METRIC_URL') ) {
      define( 'DIVI_METRIC_URL', get_template_directory_uri() . '/plugins/divi-metric/' );
    }
  }
}


// Instantiate the plugin class.
if ( ! preg_match( '/turnkey.reg.ru/i', home_url() ) ) {
  $DiviMetricPlugin = new DiviMetricInit();
}
