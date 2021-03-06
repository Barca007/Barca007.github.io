<?php

define('AGS_THEME_DIRECTORY', dirname(__FILE__) . '/');

/**
 * Enqueue custom scripts for theme
 */
function divi_woocommerce_store_configuration() {
  // Stylesheets
  wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/regsite/templates/woostore/scss/app.css');
  wp_enqueue_style('customizer-style', get_stylesheet_directory_uri() . '/regsite/templates/woostore/customizer/customizer.css');

  // Scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('mobile-menu', get_stylesheet_directory_uri() . '/regsite/templates/woostore/js/mobile-menu.js');
}

add_action('wp_enqueue_scripts', 'divi_woocommerce_store_configuration');


/**
 * Woocommerce hooks & functions
 */
if (class_exists('Woocommerce')) {
  require_once(AGS_THEME_DIRECTORY . 'woocommerce/wc-function-hooks.php');
}


/**
 *  Add child theme color scheme
 *  Create new tab in wordpress customizer
 */

@include(AGS_THEME_DIRECTORY . 'customizer/customizer.php');

require_once(AGS_THEME_DIRECTORY . 'customizer/woocommerce-customizer.php');


/**
 * Register Woocommerce Sidebar
 */

function divi_woocommerce_store_register_sidebars() {
  register_sidebar(
      array(
          'id'            => 'diviwoocommercestore-woo-sidebar',
          'name'          => __('Woocommerce Sidebar', 'Divi'),
          'description'   => __('This is the WooCommerce shop sidebar', 'Divi'),
          'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widgettitle">',
          'after_title'   => '</h4>',
      )
  );
}

add_action('widgets_init', 'divi_woocommerce_store_register_sidebars');


/**
 *  Breadcrumbs template
 *
 * Shortcode:
 * [navxt-breadcrumbs]
 */

function divi_woocommerce_store_breadcrumbs() {
  ob_start();

  if (function_exists('bcn_display')) {
      echo '<div class="navxt-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">';
      bcn_display();
      echo '</div>';
  }

  return ob_get_clean();
}


/**
 * Post categories list
 *
 * Shortcode:
 * [dsdws-blog-categories]
 */

function divi_woocommerce_store_categories_list() {
  ob_start();

  echo '<ul class="dsdws-categories-list">';
  wp_list_categories(array(
      'orderby'         => 'name',
      'hide_empty'      => true,
      'title_li'        => '',
      'show_option_all' => esc_html__('All', 'Divi'),
  ));
  echo '</ul>';

  return ob_get_clean();
}


/**
 * Registration of shortcodes
 */
add_action('init', 'divi_woocommerce_store_register_shortcodes');

function divi_woocommerce_store_register_shortcodes() {
    add_shortcode('navxt-breadcrumbs', 'divi_woocommerce_store_breadcrumbs');
    add_shortcode('dsdws-blog-categories', 'divi_woocommerce_store_categories_list');
}


/**
 * Add custom body classes
 */

function divi_woocommerce_store_custom_body_classes($classes) {
    if (!is_user_logged_in()) {
        $classes[] = 'user-logged-out';
    }
    return $classes;
}

add_filter('body_class', 'divi_woocommerce_store_custom_body_classes');