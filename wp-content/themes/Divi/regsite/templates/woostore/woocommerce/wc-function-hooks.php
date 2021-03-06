<?php
/*
 * Contains code copied from and/or based on Divi and Woocommerce
 * See the ../license.txt file in the root directory for more information and licenses
 *
 * This file was modified by Dominika Rauk;
 * Last modified 2020-11-16
 */

/**
 * Custom "Empty Cart" message
 */

add_filter('wc_empty_cart_message', 'divi_woocommerce_store_custom_wc_empty_cart_message');

function divi_woocommerce_store_custom_wc_empty_cart_message() {
    $content = '<div class="empty-cart">';
    $content .= '<h3>' . esc_html__('Your cart is empty', 'Divi') . '</h3>';
    $content .= '<p>';
    $content .= esc_html__('Looks like you have not made your choice yet...', 'Divi');
    $content .= '</p></div>';
    echo et_core_intentionally_unescaped($content, 'html');
}

/**
 * Product loop hooks
 */

function divi_woocommerce_store_woo_archive_product_open_div() {
    echo '<div class="divi-ecommerce-pro-shop-buttons-wrapper">';
}

/**
 * Hook woo checkout
 */

function divi_woocommerce_store_woocommerce_checkout_open_div() {
    echo '<div class="dsdws-checkout-order">';
}

add_filter('woocommerce_checkout_before_order_review_heading', 'divi_woocommerce_store_woocommerce_checkout_open_div');

function divi_woocommerce_store_woocommerce_checkout_close_div() {
    echo '</div>';
}

add_filter('woocommerce_review_order_after_payment', 'divi_woocommerce_store_woocommerce_checkout_close_div');

/**
 * Hook woo cart
 */

// Add price below item title
function divi_woocommerce_store_show_price_in_cart_items($item_name, $cart_item) {
    $product = $cart_item['data'];
    $price = WC()->cart->get_product_price($product);

    if (is_cart()) {
        $item_name = $item_name . '<br>' . $price;
    }
    return $item_name;
}

add_filter('woocommerce_cart_item_name', 'divi_woocommerce_store_show_price_in_cart_items', 99, 3);

// Add text before cart table
function divi_woocommerce_store_woo_cart_title_text() {
    echo '<h3 class="dsdws-cart-title">' . esc_html__('Your Cart Items', 'Divi') . '</h3>';
}

add_filter('woocommerce_before_cart_table', 'divi_woocommerce_store_woo_cart_title_text');

/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */

function divi_woocommerce_store_enqueue_ajax_script() {
    wp_enqueue_script('dsdws-cart-ajax', get_stylesheet_directory_uri() . '/regsite/templates/woostore/js/cart-ajax.js', array('jquery'), true);
    wp_localize_script('dsdws-cart-ajax', 'divi_woocommerce_store', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'divi_woocommerce_store_enqueue_ajax_script');


add_action('wp_ajax_divi_woocommerce_store_get_cart_link_text', 'divi_woocommerce_store_get_cart_link_text');
add_action('wp_ajax_nopriv_divi_woocommerce_store_get_cart_link_text', 'divi_woocommerce_store_get_cart_link_text');

function divi_woocommerce_store_get_cart_link_text() {
    global $woocommerce;
    esc_html_e((int)$woocommerce->cart->cart_contents_count);
    exit;
}



/**
 * Ajaxify cart
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
    $fragments['span.number'] = '<span class="number">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}, 10, 1 );

function dsdws_cart_items() {
    $string = '<a class="dsdws-cart-contents" href="' . esc_url( wc_get_cart_url() ) . '">' . __('Cart', 'Divi') . ' <span class="number">' . WC()->cart->get_cart_contents_count() .'</span></a>';
    return $string;
}


function dsdws_cart_ajax_hook_js() {
    ?>
    <script>
        jQuery(function ($) {
            $(document.body).on('wc_fragments_refreshed', function () {
                divi_woocommerce_store_update_cart_link_text(); 
            });
        });
    </script>
    <?php
}

add_action('wp_head', 'dsdws_cart_ajax_hook_js');

/**
 * Post categories list shortcode
 *
 * Shortcode:
 * [dsdws-shop-categories hide_empty="true" inline_style="true" orderby="name" exclude="cat_id"]
 */

function divi_woocommerce_store_shop_categories_list($atts) {
    ob_start();

    // define attributes and their defaults
    $shortcode_atts = shortcode_atts(array(
        'hide_empty' => 0,
        'orderby'    => 'name',
        'exclude'    => '',
        'parent'     => 0
    ), $atts);

    $args = array(
        'orderby'    => $shortcode_atts['orderby'],
        'parent'     => $shortcode_atts['parent'],
        'taxonomy'   => 'product_cat',
        'hide_empty' => $shortcode_atts['hide_empty'],
        'exclude'    => $shortcode_atts['exclude']
    );

    $categories = get_categories($args);

    echo '<ul class="dsdws-shop-categories-list">';

    foreach ($categories as $category) {
        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '" rel="bookmark">' . esc_html($category->name) . '</a></li>';
    }

    echo '</ul>';
    return ob_get_clean();
}


/**
 * Registration of shortcodes
 */

add_action('init', 'divi_woocommerce_store_register_woo_shortcodes');

function divi_woocommerce_store_register_woo_shortcodes() {
    add_shortcode('dsdws-shop-categories', 'divi_woocommerce_store_shop_categories_list');
    add_shortcode('dsdws_cart_items', 'dsdws_cart_items');
}
