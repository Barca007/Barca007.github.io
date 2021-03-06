<?php
/*
 * Contains code copied from and/or based on Divi, Woocommerce and WooCommerce Product Archive Customizer
 * See the license.txt file in the root directory for more information and licenses
 *
 * This file modified by Dominika Rauk, Anna Kurowska and/or others;
 * Last modified 2020-11-23
 */

/**
 * dsdws_THEME_WC class
 */
if (!class_exists('DSDWS_THEME_WC')) {

    /**
     * The Product Archive Customiser class
     */
    class DSDWS_THEME_WC {

        /**
         * The version number.
         *
         * @var     string
         * @access  public
         */
        public $version;

        /**
         * The constructor!
         */
        public function __construct() {
            add_action('init', array($this, 'dsdws_woocommerce_setup'));
            add_action('wp', array($this, 'dsdws_woocommerce_fire_customisations'));
            add_action('wp_enqueue_scripts', array($this, 'divi_woocommerce_store_custom_styles'));
        }

        /**
         * Product Archive Customiser setup
         *
         * @return void
         */
        public function dsdws_woocommerce_setup() {
            add_action('customize_register', array($this, 'dsdws_woocommerce_customize_register'));
        }

        /**
         * Add settings to the Customizer
         *
         * @param array $wp_customize the Customiser settings object.
         * @return void
         */
        public function dsdws_woocommerce_customize_register($wp_customize) {
            $wp_customize->add_section('dsdws_woocommerce', array(
                'title'    => esc_html__('Woocommerce Settings', 'Divi'),
                'priority' => 7,
                'panel'    => 'dsdws_child_theme_customizer',
            ));

            /**
             * Display - custom shop icon
             */
            $wp_customize->add_setting('dsdws_woocommerce_buy_button', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'dsdws_woocommerce_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dsdws_woocommerce_buy_button', array(
                'label'       => __('Display "Add to cart" button', 'Divi'),
                'section'     => 'dsdws_woocommerce',
                'settings'    => 'dsdws_woocommerce_buy_button',
                'type'        => 'checkbox',
                'description' => __('Display "Add to cart" button on products loop.', 'Divi'),
            )));

            $wp_customize->add_setting('dsdws_woocommerce_buy_icon', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'dsdws_woocommerce_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dsdws_woocommerce_buy_icon', array(
                'label'           => __('Replace"Add to cart" button with icon', 'Divi'),
                'section'         => 'dsdws_woocommerce',
                'settings'        => 'dsdws_woocommerce_buy_icon',
                'type'            => 'checkbox',
                'active_callback' => array($this, 'is_dsdws_woocommerce_button_enabled'),
                'description'     => __('', 'Divi'),
            )));

            /**
             * Display - product overlay
             */
            $wp_customize->add_setting('dsdws_woocommerce_product_overlay', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => array($this, 'dsdws_woocommerce_sanitize_checkbox'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dsdws_woocommerce_product_overlay', array(
                'label'       => esc_html__('Replace product overlay with Image hover-zoom effect', 'Divi'),
                'section'     => 'dsdws_woocommerce',
                'settings'    => 'dsdws_woocommerce_product_overlay',
                'type'        => 'checkbox',
                'description' => esc_html__('Disables a product overlay and replaces it with Image Zoom hover effect.', 'Divi'),
            )));
        }

        /**
         * Checkbox sanitization callback.
         *
         * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
         * as a boolean value, either TRUE or FALSE.
         *
         * @param bool $checked Whether the checkbox is checked.
         * @return bool Whether the checkbox is checked.
         */
        public function dsdws_woocommerce_sanitize_checkbox($checked) {
            return ((isset($checked) && true == $checked) ? true : false);
        }

        /**
         * Sanitizes choices (selects / radios)
         * Checks that the input matches one of the available choices
         *
         * @param array $input the available choices.
         * @param array $setting the setting object.
         */
        public function dsdws_woocommerce_sanitize_choices($input, $setting) {
            // Ensure input is a slug.
            $input = sanitize_key($input);

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control($setting->id)->choices;

            // If the input is a valid key, return it; otherwise, return the default.
            return (array_key_exists($input, $choices) ? $input : $setting->default);
        }

        /**
         * New overlay callback
         *
         * @param array $control the Customizer controls.
         * @return bool
         */
        public function is_dsdws_woocommerce_button_enabled($control) {
            return $control->manager->get_setting('dsdws_woocommerce_buy_button')->value() === true ? true : false;
        }

        /**
         * Action our customisations
         *
         * @return void
         */
        function dsdws_woocommerce_fire_customisations() {
            // Buy Icon
            if (get_theme_mod('dsdws_woocommerce_buy_button', true) === true) {
                // Wrap buttons
                add_filter('woocommerce_after_shop_loop_item', 'divi_woocommerce_store_woo_archive_product_open_div', 1);
                // Display Add to cart button
                add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 15);
            }
        }

        public function divi_woocommerce_store_custom_styles() {
            wp_enqueue_style('woocommerce-style', get_stylesheet_directory_uri() . '/regsite/templates/woostore/customizer/woocommerce.css');
            $custom_css = '';

            if (get_theme_mod('dsdws_woocommerce_product_overlay', true) === true) {
                $custom_css = "
                    .et_shop_image:hover .et_overlay {
                       display: none !important;
                    }
                    
                    .et_shop_image {
                       overflow: hidden;
                    }
                    
                    .et_shop_image img {
                        -webkit-transition: all 1s ease-in-out;
                        -moz-transition: all 1s ease-in-out;
                        transition: all 1s ease-in-out;
                    }
                    
                    .et_shop_image:hover img {
                        transform: scale(1.3); 
                    }";
            }

            if (get_theme_mod('dsdws_woocommerce_buy_icon', true) === true) {
                $custom_css = $custom_css . "
                .woocommerce ul.products li.product.instock .star-rating,
                .woocommerce ul.products li.product.instock .price,
                .woocommerce-page ul.products.instock li.product .price,
                .woocommerce ul.products li.product.instock .woocommerce-loop-category__title,
                .woocommerce ul.products li.product.instock .woocommerce-loop-product__title,
                .woocommerce ul.products li.product.instock h3 {
                    padding-right: 50px;
                }

                .woocommerce ul.products li.product .button.add_to_cart_button,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading,
                .woocommerce ul.products li.product .product_type_variable.button,
                .woocommerce ul.products li.product.outofstock .button {
                    width: 46px;
                    height: 46px;
                    line-height: 46px !important;
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    font-size: 0 !important; 
                    text-align: center; 
                    z-index: 5;
                    -webkit-transition: all .2s;
                    -moz-transition: all .2s;
                    transition: all .2s;
                    }
                    
                .woocommerce ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button, 
                .et_pb_wc_related_products ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button {
                    margin-right: 0;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:after,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:after,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:after,
                .woocommerce ul.products li.product .button.add_to_cart_button:after,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:after,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading:after,
                .woocommerce ul.products li.product .product_type_variable.button:after,
                .woocommerce ul.products li.product.outofstock .button:after {
                    display: none !important;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:before,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .button.add_to_cart_button:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .product_type_variable.button:before,
                .woocommerce ul.products li.product.outofstock .button:before {
                    position: relative !important;
                    left: auto !important;
                    right: auto !important;
                    top: 0 !important;
                    text-align: center;
                    margin: 0 auto !important;
                    opacity: 1 !important;
                    font-size: 18px;
                    line-height: 46px;
                    font-family: \"ETmodules\" !important;
                    display: block;
                    -webkit-transition: all, 0.2s, ease-in;
                    -moz-transition: all, 0.2s, ease-in;
                    -o-transition: all, 0.2s, ease-in;
                    transition: all, 0.2s, ease-in;
                }
                
                .woocommerce-page ul.products li.product .button.add_to_cart_button:before,
                .woocommerce ul.products li.product .add_to_cart_button:before,
                .woocommerce ul.products li.product .product_type_variable.button:before,
                .woocommerce ul.products li.product.outofstock .button:before {
                    color: inherit;
                    content: \"\\e015\";
                }
                
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.loading:before,
                .woocommerce ul.products li.product .button.add_to_cart_button.loading:before {
                    color: inherit;
                    content: \"\\e02d\";
                }
                
                .woocommerce-page ul.products li.product .button.ajax_add_to_cart.added:before,
                .woocommerce ul.products li.product .button.ajax_add_to_cart.added:before {
                    color: inherit;
                    content: \"\\4e\";
                }";
            }

            wp_add_inline_style('woocommerce-style', $custom_css);
        }
    }

    $DSDWS_THEME_WC = new DSDWS_THEME_WC();
}
