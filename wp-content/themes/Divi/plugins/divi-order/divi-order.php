<?php

/*
Plugin Name: Divi Order
Plugin URI: https://reg.ru
Description: Плагин выводит плашку со ссылкой на заказ конкретного шаблона Divi
Version: 0.1
Author: Denis Lapshin
Author URI: https://reg.ru
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) die();

/**
 * Main plugin class with initialization tasks.
 */
class DiviOrderInit {
  /**
   * Constructor for this class.
   */
  public function __construct() {
    // Set plugin constants.
    $this->set_plugin_constants();

    // Actions
    add_action( 'wp_footer', array( $this, 'create_order_box' ) );
  }

  public function create_order_box() {
    // Add CSS
    wp_enqueue_style( 'DiviOrderPluginStylesheet', DIVI_ORDER_URL . 'assets/main.css' );

    $result = $this->getTemplateData();

    $content  = '<div class="do-order">';
    $content .=   '<div class="et_pb_row do-order_row">';
    $content .=     '<div class="do-order_container">';
    $content .=       '<div class="do-order_description">Шаблон "'. $result['title'] .'"</div>';
    $content .=       '<div class="do-order_button"><a href="https://www.reg.ru/buy/regsite?plan=evolution&theme='. $result['name'] .'" target="_blank">Быстрый старт</a></div>';
    $content .=     '</div>';
    $content .=   '</div>';
    $content .= '</div>';

    echo $content;
  }

  private function getTemplateData() {
    $data_arr = [];

    $url = 'https://api.turnkey.reg.ru/index.php?method=get_themes&cms=wordpress&leng=en&solution=divi';
    $demo_url = site_url();
    $result = file_get_contents($url);
    $data = json_decode($result, true);

    for($i = 0; $i < count($data['answer']); ++$i) {
      if( $data['answer'][$i]['link'] === $demo_url ) {
          $data_arr['title'] = $data['answer'][$i]['title'];
          $data_arr['name'] = $data['answer'][$i]['name'];
      }
    }
    return $data_arr;
  }

  /**
   * Set plugin constants.
   */
  private function set_plugin_constants() {
    // URL to root of this plugin, with trailing slash.
    if ( !defined('DIVI_ORDER_URL') ) {
      define( 'DIVI_ORDER_URL', get_template_directory_uri() . '/plugins/divi-order/' );
    }
  }
}

// Instantiate the plugin class if demo site.
if ( preg_match( '/turnkey.reg.ru/i', home_url() ) ) {
  $DiviOrderPlugin = new DiviOrderInit();
}