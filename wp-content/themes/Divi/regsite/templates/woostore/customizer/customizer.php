<?php
/*
 * Contains code copied from and/or based on Divi
 * See the license.txt file in the root directory for more information and licenses
 *
 * This file was modified by Dominika Rauk;
 * Last modified 2020-11-17
 */

add_action('customize_controls_enqueue_scripts', 'divi_woocommerce_store_customizer_css');

function divi_woocommerce_store_customizer_css() {
    wp_enqueue_style('dsdws-customizer-controls-styles', get_stylesheet_directory_uri() . '/regsite/templates/woostore/customizer/customizer.css');
}

/*
 * Add new section to customizer
 */

function divi_woocommerce_store_customize_register($wp_customize) {

    // Create panel
    $wp_customize->add_panel('dsdws_child_theme_customizer', array(
        'title'    => esc_html__('Divi WooCommerce Store Settings', 'Divi'),
        'priority' => 2,
    ));

    // Create sections

    // Color scheme
    $wp_customize->add_section('dsdws_colors', array(
        'title'       => esc_html__('Color Scheme', 'Divi'),
        'panel'       => 'dsdws_child_theme_customizer',
        'priority'    => 1,
        'description' => esc_html__('Color settings will be applied to your Divi Child Theme color scheme.', 'Divi'),
    ));

    // Buttons
    $wp_customize->add_section('dsdws_buttons', array(
        'title'    => esc_html__('Buttons Settings', 'Divi'),
        'panel'    => 'dsdws_child_theme_customizer',
        'priority' => 2,
    ));

    $wp_customize->add_section('dsdws_primary_button', array(
        'title'       => esc_html__('Primary Button Color Scheme', 'Divi'),
        'panel'       => 'dsdws_child_theme_customizer',
        'priority'    => 3,
        'description' => esc_html__('Color settings below will be applied to primary buttons.', 'Divi'),
    ));

    $wp_customize->add_section('dsdws_secondary_button', array(
        'title'       => esc_html__('Secondary Button Color Scheme', 'Divi'),
        'panel'       => 'dsdws_child_theme_customizer',
        'priority'    => 4,
        'description' => esc_html__('Color settings below will be applied to secondary buttons.', 'Divi'),
    ));

    $wp_customize->add_section('dsdws_outline_button', array(
        'title'       => esc_html__('Outline Button Color Scheme', 'Divi'),
        'panel'       => 'dsdws_child_theme_customizer',
        'priority'    => 5,
        'description' => esc_html__('Color settings below will be applied to outline buttons.', 'Divi'),
    ));

    $wp_customize->add_section('dsdws_border', array(
        'title'    => esc_html__('Border Settings', 'Divi'),
        'panel'    => 'dsdws_child_theme_customizer',
        'priority' => 6,
    ));

    // --------------------------------------------------------------------------------------- //
    //                                       Color Scheme
    // --------------------------------------------------------------------------------------- //

    // Primary Accent Color
    $wp_customize->add_setting('dsdws_main_accent_color', array(
        'default'           => '#292BB4',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_main_accent_color',
        array(
            'label'    => esc_html__('Main Accent', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_main_accent_color'
        )
    ));

    // Primary Accent Hover Color
    $wp_customize->add_setting('dsdws_main_hover_accent_color', array(
        'default'           => '#292BB4',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_main_hover_accent_color',
        array(
            'label'    => esc_html__('Main Accent Hover Color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_main_hover_accent_color'
        )
    ));

    // Second Accent Color
    $wp_customize->add_setting('dsdws_second_accent_color', array(
        'default'           => '#118479',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_second_accent_color',
        array(
            'label'    => esc_html__('Second Accent', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_second_accent_color'
        )
    ));

    // Second Accent Hover Color
    $wp_customize->add_setting('dsdws_second_accent_hover_color', array(
        'default'           => '#0e6a61',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_second_accent_hover_color',
        array(
            'label'    => esc_html__('Second Accent Hover Color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_second_accent_hover_color'
        )
    ));

    // Light Grey Color
    $wp_customize->add_setting('dsdws_light_grey_color', array(
        'default'           => '#F3F3F3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_light_grey_color',
        array(
            'label'    => esc_html__('Light grey color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_light_grey_color'
        )
    ));

    // Dark Grey Color
    $wp_customize->add_setting('dsdws_dark_grey_color', array(
        'default'           => '#232323',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_dark_grey_color',
        array(
            'label'    => esc_html__('Dark grey color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_dark_grey_color'
        )
    ));

    // Font Color
    $wp_customize->add_setting('dsdws_font_color', array(
        'default'           => '#82828B',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_font_color',
        array(
            'label'    => esc_html__('Body Text Color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_font_color'
        )
    ));

    // Second Accent Color
    $wp_customize->add_setting('dsdws_headers_color', array(
        'default'           => '#000000',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_headers_color',
        array(
            'label'    => esc_html__('Header Text Color', 'Divi'),
            'section'  => 'dsdws_colors',
            'settings' => 'dsdws_headers_color'
        )
    ));

    // --------------------------------------------------------------------------------------- //
    //                                      Buttons
    // --------------------------------------------------------------------------------------- //

    // General buttons settings

    // Border Radius
    $wp_customize->add_setting('dsdws_buttons_border_width', array(
        'default'           => '1',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new ET_Divi_Range_Option(
        $wp_customize, 'dsdws_buttons_border_width', array(
            'label'       => esc_html__('Border width', 'Divi'),
            'section'     => 'dsdws_buttons',
            'settings'    => 'dsdws_buttons_border_width',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 10,
                'step' => 1
            ),
        )
    ));

    // Border Radius
    $wp_customize->add_setting('dsdws_buttons_border_radius', array(
        'default'           => '0',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new ET_Divi_Range_Option(
        $wp_customize, 'dsdws_buttons_border_radius', array(
            'label'       => esc_html__('Border radius', 'Divi'),
            'section'     => 'dsdws_buttons',
            'settings'    => 'dsdws_buttons_border_radius',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 50,
                'step' => 1
            ),
        )
    ));

    // Primary Button Color Scheme
    $wp_customize->add_setting('dsdws_primary_button_text_color', array(
        'default'           => '#fff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_text_color',
        array(
            'label'    => esc_html__('Text Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_primary_button_border_color', array(
        'default'           => '#003DC1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_border_color',
        array(
            'label'    => esc_html__('Border Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_primary_button_background_color', array(
        'default'           => '#003DC1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_background_color',
        array(
            'label'    => esc_html__('Background Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_background_color'
        )
    ));

    $wp_customize->add_setting('dsdws_primary_button_hover_text_color', array(
        'default'           => '#fff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_hover_text_color',
        array(
            'label'    => esc_html__('Hover Text Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_hover_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_primary_button_hover_border_color', array(
        'default'           => '#292BB4',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_hover_border_color',
        array(
            'label'    => esc_html__('Hover Border Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_hover_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_primary_button_hover_background_color', array(
        'default'           => '#292BB4',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_primary_button_hover_background_color',
        array(
            'label'    => esc_html__('Hover Background Color', 'Divi'),
            'section'  => 'dsdws_primary_button',
            'settings' => 'dsdws_primary_button_hover_background_color'
        )
    ));

    // Secondary Button Color Scheme
    $wp_customize->add_setting('dsdws_secondary_button_text_color', array(
        'default'           => '#FFF',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_text_color',
        array(
            'label'    => esc_html__('Text Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_secondary_button_border_color', array(
        'default'           => '#118479',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_border_color',
        array(
            'label'    => esc_html__('Border Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_secondary_button_background_color', array(
        'default'           => '#118479',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_background_color',
        array(
            'label'    => esc_html__('Background Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_background_color'
        )
    ));

    $wp_customize->add_setting('dsdws_secondary_button_hover_text_color', array(
        'default'           => '#fff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_hover_text_color',
        array(
            'label'    => esc_html__('Hover Text Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_hover_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_secondary_button_hover_border_color', array(
        'default'           => '#0e6a61',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_hover_border_color',
        array(
            'label'    => esc_html__('Hover Border Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_hover_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_secondary_button_hover_background_color', array(
        'default'           => '#0e6a61',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_secondary_button_hover_background_color',
        array(
            'label'    => esc_html__('Hover Background Color', 'Divi'),
            'section'  => 'dsdws_secondary_button',
            'settings' => 'dsdws_secondary_button_hover_background_color'
        )
    ));

    // Outline Button Color Scheme
    $wp_customize->add_setting('dsdws_outline_button_text_color', array(
        'default'           => '#000000',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_text_color',
        array(
            'label'    => esc_html__('Text Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_outline_button_border_color', array(
        'default'           => '#003DC1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_border_color',
        array(
            'label'    => esc_html__('Border Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_outline_button_background_color', array(
        'default'           => 'rgba(0,0,0,0)',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_background_color',
        array(
            'label'    => esc_html__('Background Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_background_color'
        )
    ));

    $wp_customize->add_setting('dsdws_outline_button_hover_text_color', array(
        'default'           => '#FFF',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_hover_text_color',
        array(
            'label'    => esc_html__('Hover Text Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_hover_text_color'
        )
    ));

    $wp_customize->add_setting('dsdws_outline_button_hover_border_color', array(
        'default'           => '#003DC1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_hover_border_color',
        array(
            'label'    => esc_html__('Hover Border Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_hover_border_color'
        )
    ));

    $wp_customize->add_setting('dsdws_outline_button_hover_background_color', array(
        'default'           => '#003DC1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_outline_button_hover_background_color',
        array(
            'label'    => esc_html__('Hover Background Color', 'Divi'),
            'section'  => 'dsdws_outline_button',
            'settings' => 'dsdws_outline_button_hover_background_color'
        )
    ));

    // --------------------------------------------------------------------------------------- //
    //                                      Border
    // --------------------------------------------------------------------------------------- //

    // Border color
    $wp_customize->add_setting('dsdws_border_color', array(
        'default'           => '#E6E6EB',
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new ET_Divi_Customize_Color_Alpha_Control(
        $wp_customize,
        'dsdws_border_color',
        array(
            'label'    => esc_html__('Border Color', 'Divi'),
            'section'  => 'dsdws_border',
            'settings' => 'dsdws_border_color'
        )
    ));

    // Border Radius
    $wp_customize->add_setting('dsdws_border_radius', array(
        'default'           => '0',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new ET_Divi_Range_Option(
        $wp_customize, 'dsdws_border_radius', array(
            'label'       => esc_html__('General border radius (px)', 'Divi'),
            'section'     => 'dsdws_border',
            'settings'    => 'dsdws_border_radius',
            'type'        => 'range',
            'description' => esc_html__('General border radius applied to cards, boxes, images etc.', 'Divi'),
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 50,
                'step' => 1
            ),
        )
    ));

    // Border Radius
    $wp_customize->add_setting('dsdws_form_border_radius', array(
        'default'           => '0',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new ET_Divi_Range_Option(
        $wp_customize, 'dsdws_form_border_radius', array(
            'label'       => esc_html__('Form border radius (px)', 'Divi'),
            'section'     => 'dsdws_border',
            'settings'    => 'dsdws_form_border_radius',
            'type'        => 'range',
            'description' => esc_html__('Border radius applied to form elements like inputs, textareas etc.', 'Divi'),
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 50,
                'step' => 1
            ),
        )
    ));

}

add_action('customize_register', 'divi_woocommerce_store_customize_register');

/*
 * Output  custom settings CSS Style
 */

function divi_woocommerce_store_customize_css() {

    /* ============================= */

    $main_accent = get_theme_mod('dsdws_main_accent_color', '#292BB4');
    $main_hover_accent = get_theme_mod('dsdws_main_hover_accent_color', '#292BB4');
    $second_accent = get_theme_mod('dsdws_second_accent_color', '#118479');
    $second_hover_accent = get_theme_mod('dsdws_second_hover_accent_color', '#0e6a61');
    $light_grey = get_theme_mod('dsdws_light_grey_color', '#F3F3F3');
    $dark_grey = get_theme_mod('dsdws_dark_grey_color', '#232323');
    $font_color = get_theme_mod('dsdws_font_color', '#82828B');
    $headers_color = get_theme_mod('dsdws_headers_color', '#000000');
    $border_color = get_theme_mod('dsdws_border_color', '#E6E6EB');

    $primary_button_text_color = get_theme_mod('dsdws_primary_button_text_color', '#fff');
    $primary_button_bg_color = get_theme_mod('dsdws_primary_button_background_color', '#003DC1');
    $primary_button_border_color = get_theme_mod('dsdws_primary_button_border_color', '#003DC1');
    $primary_button_hover_text_color = get_theme_mod('dsdws_primary_button_hover_text_color', '#fff');
    $primary_button_hover_bg_color = get_theme_mod('dsdws_primary_button_hover_background_color', '#292BB4');
    $primary_button_hover_border_color = get_theme_mod('dsdws_primary_button_hover_border_color', '#292BB4');

    $secondary_button_text_color = get_theme_mod('dsdws_secondary_button_text_color', '#fff');
    $secondary_button_bg_color = get_theme_mod('dsdws_secondary_button_background_color', '#118479');
    $secondary_button_border_color = get_theme_mod('dsdws_secondary_button_border_color', '#118479');
    $secondary_button_hover_text_color = get_theme_mod('dsdws_secondary_button_hover_text_color', '#fff');
    $secondary_button_hover_bg_color = get_theme_mod('dsdws_secondary_button_hover_background_color', '#0e6a61');
    $secondary_button_hover_border_color = get_theme_mod('dsdws_secondary_button_hover_border_color', '#0e6a61');

    $outline_button_text_color = get_theme_mod('dsdws_outline_button_text_color', '#000000');
    $outline_button_bg_color = get_theme_mod('dsdws_outline_button_background_color', 'rgba(0,0,0,0)');
    $outline_button_border_color = get_theme_mod('dsdws_outline_button_border_color', '#003DC1');
    $outline_button_hover_text_color = get_theme_mod('dsdws_outline_button_hover_text_color', '#FFF');
    $outline_button_hover_bg_color = get_theme_mod('dsdws_outline_button_hover_background_color', '#003DC1');
    $outline_button_hover_border_color = get_theme_mod('dsdws_outline_button_hover_border_color', '#003DC1');

    /* ============================= */

    ?>
    <style type="text/css">
        /* Border Color */
        .dsdws-border-color-light, .dsdws-border-color-dark, .dsdws-sidebar .et_pb_widget.widget_product_tag_cloud .tagcloud a, .dsdws-sidebar .et_pb_widget.widget_tag_cloud .tagcloud a, .dsdws-sidebar .et_pb_widget.widget_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_search input[type=search], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=search], .dsdws-sidebar .et_pb_widget:not(:last-child):not(.widget_search), .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form .input, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=email], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=number], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=password], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=tel], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=text], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=url], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form select, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field .input, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=email], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=number], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=password], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=tel], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=text], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=url], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field select, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form textarea, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field textarea, .et-db #et-boc .et-l .dsdws-search input[type=text], .et-db #et-boc .et-l .dsdws-search input[type=search], .et-db #et-boc .et-l .dsdws-contact-form input[type=email], .et-db #et-boc .et-l .dsdws-contact-form input[type=number], .et-db #et-boc .et-l .dsdws-contact-form input[type=password], .et-db #et-boc .et-l .dsdws-contact-form input[type=tel], .et-db #et-boc .et-l .dsdws-contact-form input[type=text], .et-db #et-boc .et-l .dsdws-contact-form input[type=url], .et-db #et-boc .et-l .dsdws-contact-form select, .et-db #et-boc .et-l .dsdws-contact-form textarea, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-arrow-next, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-arrow-prev, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .woocommerce-product-gallery__image img, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .flex-control-thumbs img, .et-db #et-boc .et-l .dsdws-add-to-cart .variations select, .et-db #et-boc .et-l .dsdws-add-to-cart input.qty, .et-db #et-boc .et-l .dsdws-toggle, .et-db #et-boc .et-l .dsdws-post-navigation, #et-boc .et-l .woocommerce input.text, #et-boc .et-l .woocommerce input.input-text, #et-boc .et-l .woocommerce input.title, #et-boc .et-l .woocommerce input[type=email], #et-boc .et-l .woocommerce input[type=number], #et-boc .et-l .woocommerce input[type=password], #et-boc .et-l .woocommerce input[type=tel], #et-boc .et-l .woocommerce input[type=text], #et-boc .et-l .woocommerce input[type=url], #et-boc .et-l .woocommerce select, #et-boc .et-l .woocommerce .select2-container--default .select2-selection--single, #et-boc .et-l .woocommerce textarea, #et-boc .et-l .woocommerce input[type=checkbox]:before, .woocommerce-cart table.cart td.actions .coupon input.input-text, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error, #et-boc .et-l .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error, .woocommerce .woocommerce-error, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info, #et-boc .et-l .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-info, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message, #et-boc .et-l .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-message, .woocommerce table.shop_table td, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tbody td, .woocommerce-order-received .woocommerce-order-details table.shop_table tbody td, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tfoot td, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tfoot th, .woocommerce-order-received .woocommerce-order-details table.shop_table tfoot td, .woocommerce-order-received .woocommerce-order-details table.shop_table tfoot th, .woocommerce-order-received .woocommerce-order ul.woocommerce-order-overview li strong, .dsdws-checkout .woocommerce table.shop_table tbody td, .dsdws-checkout .woocommerce-page table.shop_table tbody td, .dsdws-checkout .woocommerce table.shop_table tfoot td, .dsdws-checkout .woocommerce table.shop_table tfoot th, .dsdws-checkout .woocommerce-page table.shop_table tfoot td, .dsdws-checkout .woocommerce-page table.shop_table tfoot th, .dsdws-my-account .woocommerce .woocommerce-Addresses .u-column1:before, .dsdws-my-account .woocommerce table.woocommerce-orders-table tbody td, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads tbody td, .dsdws-checkout .woocommerce table.woocommerce-orders-table tbody td, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads tbody td, #et-boc .et-l .dsdws-cart table.shop_table tbody tr td, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals table.shop_table th, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals table.shop_table td, .woocommerce .quantity .qty, ol.commentlist .comment .comment-body, #commentform input[type=text], #commentform input[type=email], #commentform input[type=url], #commentform textarea, #et-boc .et-l .dsdws-cart table.shop_table .coupon input[type=text], .woocommerce ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button, .et_pb_wc_related_products ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button {
            border-color : <?php esc_html_e($border_color);?> !important;
        }

        #et-boc .et-l .woocommerce input[type=radio], .dsdws-checkout .woocommerce #payment ul.payment_methods input[type=radio], .dsdws-checkout .woocommerce-page #payment ul.payment_methods input[type=radio] {
            box-shadow : inset 0 0 0 2px <?php esc_html_e($border_color);?> !important;
        }

        /* Body Text Color */
        .dsdws-font-color, .dsdws-sidebar .et_pb_widget.widget_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_search input[type=search], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=search], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form .input, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=email], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=number], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=password], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=tel], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=text], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=url], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form select, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field .input, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=email], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=number], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=password], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=tel], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=text], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=url], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field select, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form textarea, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field textarea, .et-db #et-boc .et-l .dsdws-search input[type=text], .et-db #et-boc .et-l .dsdws-search input[type=search], .et-db #et-boc .et-l .dsdws-contact-form input[type=email], .et-db #et-boc .et-l .dsdws-contact-form input[type=number], .et-db #et-boc .et-l .dsdws-contact-form input[type=password], .et-db #et-boc .et-l .dsdws-contact-form input[type=tel], .et-db #et-boc .et-l .dsdws-contact-form input[type=text], .et-db #et-boc .et-l .dsdws-contact-form input[type=url], .et-db #et-boc .et-l .dsdws-contact-form select, .et-db #et-boc .et-l .dsdws-contact-form textarea, .et-db #et-boc .et-l .dsdws-add-to-cart .variations select, .et-db #et-boc .et-l .dsdws-add-to-cart .woocommerce-variation-price .price del, .et-db #et-boc .et-l .dsdws-add-to-cart input.qty, #et-boc .et-l .woocommerce label, #et-boc .et-l .woocommerce input.text, #et-boc .et-l .woocommerce input.input-text, #et-boc .et-l .woocommerce input.title, #et-boc .et-l .woocommerce input[type=email], #et-boc .et-l .woocommerce input[type=number], #et-boc .et-l .woocommerce input[type=password], #et-boc .et-l .woocommerce input[type=tel], #et-boc .et-l .woocommerce input[type=text], #et-boc .et-l .woocommerce input[type=url], #et-boc .et-l .woocommerce select, #et-boc .et-l .woocommerce .select2-container--default .select2-selection--single, #et-boc .et-l .woocommerce textarea, .woocommerce-cart table.cart td.actions .coupon input.input-text, .woocommerce table.shop_table thead tr th, .woocommerce-order-received .woocommerce-order ul.woocommerce-order-overview li, .dsdws-my-account .woocommerce-MyAccount-navigation ul li a, .woocommerce ul.products li.product h2, .et_pb_wc_related_products ul.products li.product h2, .woocommerce ul.products li.product .price del, .et_pb_wc_related_products ul.products li.product .price del, .woocommerce nav.woocommerce-pagination a.page-numbers, .et-db #et-boc nav.woocommerce-pagination a.page-numbers, .dsdws-shop-categories-list li a, .woocommerce .quantity .qty, .wp-pagenavi a.page, #commentform input[type=text], #commentform input[type=email], #commentform input[type=url], #commentform textarea, .dsdws-categories-list li a {
            color : <?php esc_html_e($font_color);?> !important;
        }

        /* Header Text Color */
        .dsdws-heading-color, .dsdws-footer-widget-title, .dsdws-footer-widget-menu h4.title, .dsdws-sidebar .et_pb_widget.widget_recent_comments ul li a, .dsdws-sidebar .et_pb_widget.widget_recent_entries ul li a, .dsdws-sidebar .et_pb_widget.widget_categories ul li a, .dsdws-sidebar .et_pb_widget.widget_archive ul li a, .dsdws-sidebar .et_pb_widget.widget_product_categories ul li a, .dsdws-sidebar .et_pb_widget.woocommerce-widget-layered-nav ul li a, .dsdws-sidebar .widget_shopping_cart .total .amount, .et-db #et-boc .et-l .dsdws-sidebar ul.product_list_widget li span.product-title, .et-db #et-boc .et-l .dsdws-sidebar ul.cart_list li span.product-title, .et-db #et-boc .et-l .dsdws-sidebar ul.cart_list li a:not(.remove), .et-db #et-boc .et-l .dsdws-sidebar ul.product_list_widget li a, .dsdws-widgettitle, .dsdws-sidebar .widgettitle, .et-db #et-boc .et-l .dsdws-blog .et_pb_post .post-meta .author a, .et-db #et-boc .et-l .dsdws-add-to-cart .woocommerce-variation-price .price, .et-db #et-boc .et-l .dsdws-post-navigation a, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error, #et-boc .et-l .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error, .woocommerce .woocommerce-error, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info, #et-boc .et-l .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-info, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message, #et-boc .et-l .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-message, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table thead th:first-child, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tbody td:first-child, .woocommerce-order-received .woocommerce-order-details table.shop_table thead th:first-child, .woocommerce-order-received .woocommerce-order-details table.shop_table tbody td:first-child, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tbody td.woocommerce-table__product-name a, .woocommerce-order-received .woocommerce-order-details table.shop_table tbody td.woocommerce-table__product-name a, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tfoot .amount, .woocommerce-order-received .woocommerce-order-details table.shop_table tfoot .amount, .woocommerce-order-received .woocommerce-order .woocommerce-thankyou-order-received, .woocommerce-order-received .woocommerce-order ul.woocommerce-order-overview li strong, .dsdws-checkout .woocommerce table.shop_table thead th:first-child, .dsdws-checkout .woocommerce table.shop_table tbody td:first-child, .dsdws-checkout .woocommerce-page table.shop_table thead th:first-child, .dsdws-checkout .woocommerce-page table.shop_table tbody td:first-child, .dsdws-checkout .woocommerce table.shop_table tbody td.woocommerce-table__product-name a, .dsdws-checkout .woocommerce-page table.shop_table tbody td.woocommerce-table__product-name a, .dsdws-checkout .woocommerce table.shop_table tfoot .amount, .dsdws-checkout .woocommerce-page table.shop_table tfoot .amount, .dsdws-checkout .woocommerce #payment ul.payment_methods label, .dsdws-checkout .woocommerce-page #payment ul.payment_methods label, #et-boc .et-l .dsdws-cart table.shop_table .amount, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals table.shop_table th, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals table.shop_table tr.order-total .amount, .woocommerce ul.products li.product h2:hover, .et_pb_wc_related_products ul.products li.product h2:hover, .woocommerce ul.products li.product .price, .et_pb_wc_related_products ul.products li.product .price, .woocommerce nav.woocommerce-pagination span.current, .et-db #et-boc nav.woocommerce-pagination span.current, .dsdws-shop-categories-list li a:hover, .dsdws-reviews #reviews h2.woocommerce-Reviews-title, .dsdws-reviews #reviews .commentlist .meta .woocommerce-review__author, .dsdws-reviews #reviews #respond .comment-reply-title, .wp-pagenavi span.current, .blog .dsdws-categories-list .cat-item-all a, .dsdws-categories-list .current-cat a, .dsdws-categories-list a:hover, .et-db #et-boc .et-l .dsdws-menuPrimary .et-menu-nav li.mega-menu > ul > li > a:first-child {
            color : <?php esc_html_e($headers_color);?> !important;
        }

        /* Light Grey Color */
        .dsdws-background-color-light, .dsdws-sidebar .woocommerce.widget_price_filter .price_label span, .dsdws-checkout .woocommerce table.shop_table, .dsdws-checkout .woocommerce #payment ul.methods, .dsdws-checkout .woocommerce-page table.shop_table, .dsdws-checkout .woocommerce-page #payment ul.methods, .dsdws-my-account .woocommerce-MyAccount-navigation ul li a, .dsdws-my-account .woocommerce table.woocommerce-table--order-details, .dsdws-checkout .woocommerce table.woocommerce-table--order-details, #et-boc .et-l .dsdws-cart table.shop_table .coupon input[type=text], #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals table.shop_table {
            background-color : <?php esc_html_e($light_grey);?> !important;
        }

        .dsdws-link-color-light a, .dsdws-link-hover-color-light a:hover, .dsdws-color-light, .dsdws-heading-color-light h1, .dsdws-heading-color-light h2, .dsdws-heading-color-light h3, .dsdws-heading-color-light h4, .dsdws-heading-color-light h5, .dsdws-heading-color-light h6 {
            color : <?php esc_html_e($light_grey);?> !important;
        }

        /* Dark Grey Color */
        .dsdws-background-color-dark {
            background-color : <?php esc_html_e($dark_grey);?> !important;
        }

        .dsdws-link-color-dark a, .dsdws-link-hover-color-dark a:hover, .dsdws-color-dark, .dsdws-heading-color-dark h1, .dsdws-heading-color-dark h2, .dsdws-heading-color-dark h3, .dsdws-heading-color-dark h4, .dsdws-heading-color-dark h5, .dsdws-heading-color-dark h6 {
            color : <?php esc_html_e($dark_grey);?> !important;
        }

        /* Second Color */
        .dsdws-background-color-second, .dsdws-overlay-second:before, .dsdws-overlay-on-hover-second:before, .dsdws-sidebar .woocommerce.widget_price_filter .ui-slider .ui-slider-range, .dsdws-sidebar .woocommerce.widget_price_filter .ui-slider .ui-slider-handle, .woocommerce li.product .onsale, .woocommerce .dsdws-woo-images .onsale {
            background-color : <?php esc_html_e($second_accent);?> !important;
        }

        .dsdws-button-underline-second, .et_pb_button.dsdws-button-underline-second, body.et-db #et-boc .dsdws-button-underline-second.et_pb_button, body .dsdws-button-underline-second.et_pb_button, .dsdws-module-button-underline-second .et_pb_button, .dsdws-icon-button-second:hover, .et_pb_button.dsdws-icon-button-second:hover, body.et-db #et-boc .dsdws-icon-button-second.et_pb_button:hover, body .dsdws-icon-button-second.et_pb_button:hover, .dsdws-module-icon-button-second .et_pb_button:hover, .dsdws-link-color-second a, .dsdws-link-hover-color-second a:hover, .dsdws-color-second, .dsdws-hover-color-second:hover, .dsdws-heading-color-second h1, .dsdws-heading-color-second h2, .dsdws-heading-color-second h3, .dsdws-heading-color-second h4, .dsdws-heading-color-second h5, .dsdws-heading-color-second h6, .woocommerce ul.products li.product .price ins, .et_pb_wc_related_products ul.products li.product .price ins, .woocommerce ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.added_to_cart, .et_pb_wc_related_products ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.added_to_cart, ol.commentlist .comment .comment-reply-link {
            color : <?php esc_html_e($second_accent);?> !important;
        }

        .dsdws-border-color-second {
            border-color : <?php esc_html_e($second_accent);?> !important;
        }

        /* Second Hover Color */
        .dsdws-button-underline-second:hover, .et_pb_button.dsdws-button-underline-second:hover, body.et-db #et-boc .dsdws-button-underline-second.et_pb_button:hover, body .dsdws-button-underline-second.et_pb_button:hover, .dsdws-module-button-underline-second .et_pb_button:hover, .woocommerce ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.added_to_cart:hover, .et_pb_wc_related_products ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.added_to_cart:hover, ol.commentlist .comment .comment-reply-link:hover {
            color : <?php esc_html_e($second_hover_accent);?> !important;
        }

        /* Main Color */
        .dsdws-background-color-primary, .dsdws-overlay-primary:before, .dsdws-overlay-on-hover-primary:before, .dsdws-sidebar .et_pb_widget.widget_categories > ul > li:before, .dsdws-sidebar .et_pb_widget.widget_archive > ul > li:before, .dsdws-sidebar .et_pb_widget.widget_product_categories > ul > li:before, .dsdws-sidebar .et_pb_widget.woocommerce-widget-layered-nav > ul > li:before, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-controllers a.et-pb-active-control, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-controllers a:hover, .dsdws-my-account .woocommerce-MyAccount-navigation ul li.is-active a, .dsdws-my-account .woocommerce-MyAccount-navigation ul li a:hover {
            background-color : <?php esc_html_e($main_accent);?> !important;
        }

        .dsdws-button-underline-primary, .et_pb_button.dsdws-button-underline-primary, body.et-db #et-boc .dsdws-button-underline-primary.et_pb_button, body .dsdws-button-underline-primary.et_pb_button, .dsdws-module-button-underline-primary .et_pb_button, .dsdws-icon-button-primary:hover, .et_pb_button.dsdws-icon-button-primary:hover, body.et-db #et-boc .dsdws-icon-button-primary.et_pb_button:hover, body .dsdws-icon-button-primary.et_pb_button:hover, .dsdws-module-icon-button-primary .et_pb_button:hover, .dsdws-link-color-primary a, .dsdws-link-hover-color-primary a:hover, .dsdws-color-primary, .dsdws-hover-color-primary:hover, .dsdws-heading-color-primary h1, .dsdws-heading-color-primary h2, .dsdws-heading-color-primary h3, .dsdws-heading-color-primary h4, .dsdws-heading-color-primary h5, .dsdws-heading-color-primary h6, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et-menu > li.menu-item > a:hover, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et-menu li.menu-item-has-children > a:after, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et-menu ul.sub-menu li a:hover, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et-menu ul.sub-menu li.current-menu-item a, .dsdws-footer-widget-menu ul.menu li.current-menu-item a, .dsdws-footer-widget-menu ul.menu li a:hover, .dsdws-sidebar .et_pb_widget.widget_product_tag_cloud .tagcloud a:hover, .dsdws-sidebar .et_pb_widget.widget_tag_cloud .tagcloud a:hover, .dsdws-sidebar .et_pb_widget.widget_recent_comments ul li a:hover, .dsdws-sidebar .et_pb_widget.widget_recent_entries ul li a:hover, .dsdws-sidebar .et_pb_widget.widget_search form:before, .dsdws-sidebar .et_pb_widget.widget_product_search form:before, .dsdws-sidebar .et_pb_widget.widget_categories ul li a:hover, .dsdws-sidebar .et_pb_widget.widget_archive ul li a:hover, .dsdws-sidebar .et_pb_widget.widget_product_categories ul li a:hover, .dsdws-sidebar .et_pb_widget.woocommerce-widget-layered-nav ul li a:hover, .dsdws-sidebar .et_pb_widget.widget_categories ul li.current-cat a, .dsdws-sidebar .et_pb_widget.widget_archive ul li.current-cat a, .dsdws-sidebar .et_pb_widget.widget_product_categories ul li.current-cat a, .dsdws-sidebar .et_pb_widget.woocommerce-widget-layered-nav ul li.current-cat a, .dsdws-sidebar .widget_shopping_cart a.remove, .et-db #et-boc .et-l .dsdws-sidebar ul.product_list_widget li span.product-title:hover, .et-db #et-boc .et-l .dsdws-sidebar ul.cart_list li span.product-title:hover, .et-db #et-boc .et-l .dsdws-sidebar ul.cart_list li a:not(.remove):hover, .et-db #et-boc .et-l .dsdws-sidebar ul.product_list_widget li a:hover, .et-db #et-boc .et-l .dsdws-blog .et_pb_post .entry-title:hover, .et-db #et-boc .et-l .dsdws-blog .et_pb_post .post-meta .author a:hover, .et-db #et-boc .et-l .dsdws-blog .et_pb_post .post-content a.more-link, .et-db #et-boc .et-l .dsdws-search form.et_pb_searchform:before, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-arrow-next, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-arrow-prev, .et-db #et-boc .et-l .dsdws-toggle .et_pb_toggle_title:before, .et-db #et-boc .et-l .dsdws-post-navigation a:hover, .et-db #et-boc .et-l .dsdws-post-navigation a .meta-nav, #et-boc .et-l .woocommerce form .required, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.button.wc-forward, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.woocommerce-Button, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.button.wc-forward, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.woocommerce-Button, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.button.wc-forward, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.woocommerce-Button, #et-boc .et-l .woocommerce .woocommerce-error a.button.wc-forward, #et-boc .et-l .woocommerce .woocommerce-error a.woocommerce-Button, #et-boc .et-l .woocommerce .woocommerce-info a.button.wc-forward, #et-boc .et-l .woocommerce .woocommerce-info a.woocommerce-Button, #et-boc .et-l .woocommerce .woocommerce-message a.button.wc-forward, #et-boc .et-l .woocommerce .woocommerce-message a.woocommerce-Button, .woocommerce-page .woocommerce-error a.button.wc-forward, .woocommerce-page .woocommerce-error a.woocommerce-Button, .woocommerce-page .woocommerce-info a.button.wc-forward, .woocommerce-page .woocommerce-info a.woocommerce-Button, .woocommerce-page .woocommerce-message a.button.wc-forward, .woocommerce-page .woocommerce-message a.woocommerce-Button, .woocommerce .woocommerce-error a.button.wc-forward, .woocommerce .woocommerce-error a.woocommerce-Button, .woocommerce .woocommerce-info a.button.wc-forward, .woocommerce .woocommerce-info a.woocommerce-Button, .woocommerce .woocommerce-message a.button.wc-forward, .woocommerce .woocommerce-message a.woocommerce-Button, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.button, #et-boc .et-l .woocommerce .woocommerce-error a.button, .woocommerce-page .woocommerce-error a.button, .woocommerce .woocommerce-error a.button, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.button, #et-boc .et-l .woocommerce .woocommerce-info a.button, .woocommerce-page .woocommerce-info a.button, .woocommerce .woocommerce-info a.button, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a, #et-boc .et-l .woocommerce .woocommerce-info a, .woocommerce-page .woocommerce-info a, .woocommerce .woocommerce-info a, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info:before, #et-boc .et-l .woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before, .woocommerce .woocommerce-info:before, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.button, #et-boc .et-l .woocommerce .woocommerce-message a.button, .woocommerce-page .woocommerce-message a.button, .woocommerce .woocommerce-message a.button, .dsdws-my-account .woocommerce mark, .woocommerce-order-received mark, .dsdws-my-account .woocommerce .woocommerce-order-details table.shop_table tbody td.woocommerce-table__product-name a:hover, .woocommerce-order-received .woocommerce-order-details table.shop_table tbody td.woocommerce-table__product-name a:hover, .dsdws-checkout .woocommerce table.shop_table tbody td.woocommerce-table__product-name a:hover, .dsdws-checkout .woocommerce-page table.shop_table tbody td.woocommerce-table__product-name a:hover, .dsdws-my-account .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-number a, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-number a, .dsdws-checkout .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-number a, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-number a, .dsdws-my-account .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-actions a.woocommerce-button, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-actions a.woocommerce-button, .dsdws-checkout .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-actions a.woocommerce-button, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-actions a.woocommerce-button, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file, #et-boc .et-l .dsdws-cart table.shop_table td.product-name a:hover, #et-boc .et-l .dsdws-cart table.shop_table td.product-remove a, .woocommerce nav.woocommerce-pagination a.page-numbers:hover, .et-db #et-boc nav.woocommerce-pagination a.page-numbers:hover, .dsdws-cart-contents:hover, .dsdws-cart-contents:before, .wp-pagenavi a.page:hover, .wp-pagenavi .nextpostslink, .wp-pagenavi .previouspostslink, .wp-pagenavi a.last, .wp-pagenavi a.first, ol.commentlist .comment.bypostauthor .comment_postinfo span.fn {
            color : <?php esc_html_e($main_accent);?> !important;
        }

        .dsdws-border-color-primary, .dsdws-sidebar .et_pb_widget.widget_product_tag_cloud .tagcloud a:hover, .dsdws-sidebar .et_pb_widget.widget_tag_cloud .tagcloud a:hover, .dsdws-sidebar .et_pb_widget.widget_search input[type=text]:focus, .dsdws-sidebar .et_pb_widget.widget_search input[type=search]:focus, .dsdws-sidebar .et_pb_widget.widget_product_search input[type=text]:focus, .dsdws-sidebar .et_pb_widget.widget_product_search input[type=search]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form .input:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=email]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=number]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=password]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=tel]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=text]:focus, .et-db #et-boc .et-l .dsdws-optin
        .et_pb_newsletter_form input[type=url]:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form select:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field .input:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=email]:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=number]:focus, .et-db #et-boc .et-l .dsdws-optin p .et_pb_newsletter_field input[type=password]:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=tel]:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=text]:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=url]:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field select:focus, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form textarea:focus, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field textarea:focus, .et-db #et-boc .et-l .dsdws-search input[type=text]:focus, .et-db #et-boc
        .et-l .dsdws-search input[type=search]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=email]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=number]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=password]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=tel]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=text]:focus, .et-db #et-boc .et-l .dsdws-contact-form input[type=url]:focus, .et-db #et-boc .et-l .dsdws-contact-form select:focus, .et-db #et-boc .et-l .dsdws-contact-form textarea:focus, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-controllers a.et-pb-active-control:before, .et-db #et-boc .et-l .dsdws-slider.et_pb_slider .et-pb-controllers a:hover:before, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .flex-control-thumbs img.flex-active, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .flex-control-thumbs img:hover, .et-db #et-boc .et-l .dsdws-add-to-cart .variations select:focus, .et-db #et-boc .et-l .dsdws-add-to-cart input.qty:focus, #et-boc .et-l .woocommerce input.text:focus, #et-boc .et-l .woocommerce input.input-text:focus, #et-boc .et-l .woocommerce input.title:focus, #et-boc .et-l .woocommerce input[type=email]:focus, #et-boc .et-l .woocommerce input[type=number]:focus, #et-boc .et-l .woocommerce input[type=password]:focus, #et-boc .et-l .woocommerce input[type=tel]:focus, #et-boc .et-l .woocommerce input[type=text]:focus, #et-boc .et-l .woocommerce input[type=url]:focus, #et-boc .et-l .woocommerce select:focus, #et-boc .et-l .woocommerce .select2-container--default .select2-selection--single:focus, #et-boc .et-l .woocommerce textarea:focus, #et-boc .et-l .woocommerce input[type=checkbox]:not(:disabled):hover:after, #et-boc .et-l .woocommerce input[type=checkbox]:not(:disabled):hover:before, .woocommerce-cart table.cart td.actions .coupon input.input-text:focus, .woocommerce nav.woocommerce-pagination a.page-numbers:hover:not(.next):not(.prev), .et-db #et-boc nav.woocommerce-pagination a.page-numbers:hover:not(.next):not(.prev), .woocommerce nav.woocommerce-pagination span.current, .et-db #et-boc nav.woocommerce-pagination span.current, .dsdws-shop-categories-list li a:hover, .woocommerce .quantity .qty:focus, .wp-pagenavi a.page:hover, .wp-pagenavi span.current, #commentform input[type=text]:focus, #commentform input[type=email]:focus, #commentform input[type=url]:focus, #commentform textarea:focus, .blog .dsdws-categories-list .cat-item-all a, .dsdws-categories-list .current-cat a, .dsdws-categories-list a:hover {
            border-color : <?php esc_html_e($main_accent);?> !important;
        }

        #et-boc .et-l .woocommerce input[type=radio]:checked, .dsdws-checkout .woocommerce #payment ul.payment_methods input[type=radio]:checked, .dsdws-checkout .woocommerce-page #payment ul.payment_methods input[type=radio]:checked {
            box-shadow : inset 0 0 0 2px <?php esc_html_e($main_accent);?> !important;
        }

        /* Main Hover Color */
        .dsdws-button-underline-primary:hover, .et_pb_button.dsdws-button-underline-primary:hover, body.et-db #et-boc .dsdws-button-underline-primary.et_pb_button:hover, body .dsdws-button-underline-primary.et_pb_button:hover, .dsdws-module-button-underline-primary .et_pb_button:hover, .et-db #et-boc .et-l .dsdws-blog .et_pb_post .post-content a.more-link:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.button.wc-forward:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.woocommerce-Button:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.button.wc-forward:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.woocommerce-Button:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.button.wc-forward:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.woocommerce-Button:hover, #et-boc .et-l .woocommerce .woocommerce-error a.button.wc-forward:hover, #et-boc .et-l .woocommerce .woocommerce-error a.woocommerce-Button:hover, #et-boc .et-l .woocommerce .woocommerce-info a.button.wc-forward:hover, #et-boc .et-l .woocommerce .woocommerce-info a.woocommerce-Button:hover, #et-boc .et-l .woocommerce .woocommerce-message a.button.wc-forward:hover, #et-boc .et-l .woocommerce .woocommerce-message a.woocommerce-Button:hover, .woocommerce-page .woocommerce-error a.button.wc-forward:hover, .woocommerce-page .woocommerce-error a.woocommerce-Button:hover, .woocommerce-page .woocommerce-info a.button.wc-forward:hover, .woocommerce-page .woocommerce-info a.woocommerce-Button:hover, .woocommerce-page .woocommerce-message a.button.wc-forward:hover, .woocommerce-page .woocommerce-message a.woocommerce-Button:hover, .woocommerce .woocommerce-error a.button.wc-forward:hover, .woocommerce .woocommerce-error a.woocommerce-Button:hover, .woocommerce .woocommerce-info a.button.wc-forward:hover, .woocommerce .woocommerce-info a.woocommerce-Button:hover, .woocommerce .woocommerce-message a.button.wc-forward:hover, .woocommerce .woocommerce-message a.woocommerce-Button:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error a.button:hover, #et-boc .et-l .woocommerce .woocommerce-error a.button:hover, .woocommerce-page .woocommerce-error a.button:hover, .woocommerce .woocommerce-error a.button:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info a.button:hover, #et-boc .et-l .woocommerce .woocommerce-info a.button:hover, .woocommerce-page .woocommerce-info a.button:hover, .woocommerce .woocommerce-info a.button:hover, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message a.button:hover, #et-boc .et-l .woocommerce .woocommerce-message a.button:hover, .woocommerce-page .woocommerce-message a.button:hover, .woocommerce .woocommerce-message a.button:hover, .dsdws-my-account .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-number a:hover, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-number a:hover, .dsdws-checkout .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-number a:hover, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-number a:hover, .dsdws-my-account .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-actions a.woocommerce-button:hover, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-actions a.woocommerce-button:hover, .dsdws-checkout .woocommerce table.woocommerce-orders-table td.woocommerce-orders-table__cell-order-actions a.woocommerce-button:hover, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads td.woocommerce-orders-table__cell-order-actions a.woocommerce-button:hover, .dsdws-my-account .woocommerce table.woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file:hover, .dsdws-checkout .woocommerce table.woocommerce-table--order-downloads a.woocommerce-MyAccount-downloads-file:hover, .wp-pagenavi .nextpostslink:hover, .wp-pagenavi .previouspostslink:hover, .wp-pagenavi a.last:hover, .wp-pagenavi a.first:hover {
            color : <?php esc_html_e($main_hover_accent);?> !important;
        }

        /* Radius */
        .dsdws-borderRadius, .dsdws-borderRadiusImage img, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et-menu ul.sub-menu, .et-db #et-boc .et-l .dsdws-menuPrimary ul.et_mobile_menu, .dsdws-sidebar .et_pb_widget.widget_product_tag_cloud .tagcloud a, .dsdws-sidebar .et_pb_widget.widget_tag_cloud .tagcloud a, .dsdws-sidebar .woocommerce.widget_price_filter .price_label span, .et-db #et-boc .et-l .dsdws-sidebar ul.product_list_widget li img, .et-db #et-boc .et-l .dsdws-sidebar ul.cart_list li img, .et-db #et-boc .et-l .dsdws-blog .et_audio_content, .et-db #et-boc .et-l .dsdws-blog .et_main_video_container, .et-db #et-boc .et-l .dsdws-blog .et_pb_slider, .et-db #et-boc .et-l .dsdws-blog .et_pb_image_container, .et-db #et-boc .et-l .dsdws-blog .post_format-post-format-quote .et_quote_content, .et-db #et-boc .et-l .dsdws-blog:not(.et_pb_blog_grid_wrapper) .entry-featured-image-url, .et-db #et-boc .et-l .dsdws-blog .et_pb_post, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .woocommerce-product-gallery__image img, .et-db #et-boc .et-l .dsdws-woo-images .woocommerce-product-gallery .flex-control-thumbs img, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-error, #et-boc .et-l .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error, .woocommerce .woocommerce-error, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-info, #et-boc .et-l .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-info, #et-boc .et-l .et_pb_wc_cart_notice .woocommerce-message, #et-boc .et-l .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-message, .dsdws-checkout .woocommerce table.shop_table, .dsdws-checkout .woocommerce #payment ul.methods, .dsdws-checkout .woocommerce-page table.shop_table, .dsdws-checkout .woocommerce-page #payment ul.methods, .dsdws-checkout .woocommerce #payment div.payment_box, .dsdws-checkout .woocommerce-page #payment div.payment_box, .dsdws-my-account .woocommerce-MyAccount-navigation ul li a, .dsdws-my-account .woocommerce table.woocommerce-table--order-details, .dsdws-checkout .woocommerce table.woocommerce-table--order-details, .woocommerce ul.products li.product .et_shop_image img, .et_pb_wc_related_products ul.products li.product .et_shop_image img, .woocommerce li.product .onsale, .woocommerce .dsdws-woo-images .onsale, ol.commentlist .comment .comment_avatar img {
            border-radius : <?php esc_html_e(get_theme_mod('dsdws_border_radius', 0));?>px !important;
        }

        .dsdws-sidebar .et_pb_widget.widget_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_search input[type=search], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=text], .dsdws-sidebar .et_pb_widget.widget_product_search input[type=search], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form .input, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=email], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=number], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=password], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=tel], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=text], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form input[type=url], .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form select, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field .input, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=email], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=number], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=password], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=tel], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=text], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field input[type=url], .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field select, .et-db #et-boc .et-l .dsdws-optin .et_pb_newsletter_form textarea, .et-db #et-boc .et-l .dsdws-optin p.et_pb_newsletter_field textarea, .et-db #et-boc .et-l .dsdws-search input[type=text], .et-db #et-boc .et-l .dsdws-search input[type=search], .et-db #et-boc .et-l .dsdws-contact-form input[type=email], .et-db #et-boc .et-l .dsdws-contact-form input[type=number], .et-db #et-boc .et-l .dsdws-contact-form input[type=password], .et-db #et-boc .et-l .dsdws-contact-form input[type=tel], .et-db #et-boc .et-l .dsdws-contact-form input[type=text], .et-db #et-boc .et-l .dsdws-contact-form input[type=url], .et-db #et-boc .et-l .dsdws-contact-form select, .et-db #et-boc .et-l .dsdws-contact-form textarea, .et-db #et-boc .et-l .dsdws-add-to-cart .variations select, .et-db #et-boc .et-l .dsdws-add-to-cart input.qty, #et-boc .et-l .woocommerce input.text, #et-boc .et-l .woocommerce input.input-text, #et-boc .et-l .woocommerce input.title, #et-boc .et-l .woocommerce input[type=email], #et-boc .et-l .woocommerce input[type=number], #et-boc .et-l .woocommerce input[type=password], #et-boc .et-l .woocommerce input[type=tel], #et-boc .et-l .woocommerce input[type=text], #et-boc .et-l .woocommerce input[type=url], #et-boc .et-l .woocommerce select, #et-boc .et-l .woocommerce .select2-container--default .select2-selection--single, #et-boc .et-l .woocommerce textarea, #et-boc .et-l .woocommerce input[type=checkbox]:before, .woocommerce-cart table.cart td.actions .coupon input.input-text, .woocommerce .quantity .qty, #commentform input[type=text], #commentform input[type=email], #commentform input[type=url], #commentform textarea {
            border-radius : <?php esc_html_e(get_theme_mod('dsdws_form_border_radius', 0));?>px !important;
        }

        /*
         * Buttons
         */

        /* general button */
        .dsdws-button-primary, .et_pb_button.dsdws-button-primary, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-primary, body.et-db #et-boc .dsdws-button-primary.et_pb_button, body .dsdws-button-primary.et_pb_button, .dsdws-module-button-primary .et_pb_button, .dsdws-button-second, .et_pb_button.dsdws-button-second, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-second, body.et-db #et-boc .dsdws-button-second.et_pb_button, body .dsdws-button-second.et_pb_button, .dsdws-module-button-second .et_pb_button, .dsdws-button-outline, .et_pb_button.dsdws-button-outline, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-outline, body.et-db #et-boc .dsdws-button-outline.et_pb_button, body .dsdws-button-outline.et_pb_button, .dsdws-module-button-outline .et_pb_button, .dsdws-sidebar .widget_shopping_cart .woocommerce-mini-cart__buttons a.button, .dsdws-sidebar .woocommerce.widget_price_filter button.button, .et-db #et-boc .et-l .dsdws-add-to-cart button.button, #et-boc .et-l .woocommerce .woocommerce-Button, #et-boc .et-l .woocommerce input[type=submit], #et-boc .et-l .woocommerce button.button, .dsdws-checkout .woocommerce #payment #place_order, .dsdws-checkout .woocommerce-page #payment #place_order, .dsdws-my-account .woocommerce .woocommerce-order-details .order-again a.button, .dsdws-checkout .woocommerce .woocommerce-order-details .order-again a.button, #et-boc .et-l .dsdws-cart table.shop_table td.actions button.button, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .woocommerce-shipping-calculator .shipping-calculator-form button, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a.button, #et-boc .et-l .dsdws-cart p.return-to-shop a.button.wc-backward, .dsdws-reviews #reviews #respond input[type=submit], #commentform .form-submit .et_pb_button {
            border-radius : <?php esc_html_e(get_theme_mod('dsdws_buttons_border_radius', 0));?>px !important;
            border-width  : <?php esc_html_e(get_theme_mod('dsdws_buttons_border_width', 1));?>px !important;
        }

        /* primary button */
        .dsdws-button-primary, .et_pb_button.dsdws-button-primary, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-primary, body.et-db #et-boc .dsdws-button-primary.et_pb_button, body .dsdws-button-primary.et_pb_button, .dsdws-module-button-primary .et_pb_button, .et-db #et-boc .et-l .dsdws-add-to-cart button.button, #et-boc .et-l .woocommerce .woocommerce-Button, #et-boc .et-l .woocommerce input[type=submit], #et-boc .et-l .woocommerce button.button, .dsdws-checkout .woocommerce #payment #place_order, .dsdws-checkout .woocommerce-page #payment #place_order, .dsdws-my-account .woocommerce .woocommerce-order-details .order-again a.button, .dsdws-checkout .woocommerce .woocommerce-order-details .order-again a.button, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a.button, .woocommerce ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button:hover, .et_pb_wc_related_products ul.products li.product .divi-ecommerce-pro-shop-buttons-wrapper a.button:hover {
            border-color     : <?php esc_html_e($primary_button_border_color );?> !important;
            color            : <?php esc_html_e($primary_button_text_color );?> !important;
            background-color : <?php esc_html_e($primary_button_bg_color );?> !important;
        }

        .dsdws-button-primary:hover, .et_pb_button.dsdws-button-primary:hover, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-primary:hover, body.et-db #et-boc .dsdws-button-primary.et_pb_button:hover, body .dsdws-button-primary.et_pb_button:hover, .dsdws-module-button-primary .et_pb_button:hover, .et-db #et-boc .et-l .dsdws-add-to-cart button.button:hover, #et-boc .et-l .woocommerce .woocommerce-Button:hover, #et-boc .et-l .woocommerce input[type=submit]:hover, #et-boc .et-l .woocommerce button.button:hover, .dsdws-checkout .woocommerce #payment #place_order:hover, .dsdws-checkout .woocommerce-page #payment #place_order:hover, .dsdws-my-account .woocommerce .woocommerce-order-details .order-again a.button:hover, .dsdws-checkout .woocommerce .woocommerce-order-details .order-again a.button:hover, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a.button:hover {
            border-color     : <?php esc_html_e($primary_button_hover_border_color );?> !important;
            color            : <?php esc_html_e($primary_button_hover_text_color );?> !important;
            background-color : <?php esc_html_e($primary_button_hover_bg_color );?> !important;
        }

        /* secondary button */
        .dsdws-button-second, .et_pb_button.dsdws-button-second, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-second, body.et-db #et-boc .dsdws-button-second.et_pb_button, body .dsdws-button-second.et_pb_button, .dsdws-module-button-second .et_pb_button, .dsdws-reviews #reviews #respond input[type=submit] {
            border-color     : <?php esc_html_e($secondary_button_border_color );?> !important;
            color            : <?php esc_html_e($secondary_button_text_color );?> !important;
            background-color : <?php esc_html_e($secondary_button_bg_color );?> !important;
        }

        .dsdws-button-second:hover, .et_pb_button.dsdws-button-second:hover, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-second:hover, body.et-db #et-boc .dsdws-button-second.et_pb_button:hover, body .dsdws-button-second.et_pb_button:hover, .dsdws-module-button-second .et_pb_button:hover, .dsdws-reviews #reviews #respond input[type=submit]:hover {
            border-color     : <?php esc_html_e($secondary_button_hover_border_color );?> !important;
            color            : <?php esc_html_e($secondary_button_hover_text_color );?> !important;
            background-color : <?php esc_html_e($secondary_button_hover_bg_color );?> !important;
        }

        /* outline button */
        .dsdws-button-outline, .et_pb_button.dsdws-button-outline, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-outline, body.et-db #et-boc .dsdws-button-outline.et_pb_button, body .dsdws-button-outline.et_pb_button, .dsdws-module-button-outline .et_pb_button, .dsdws-sidebar .widget_shopping_cart .woocommerce-mini-cart__buttons a.button, .dsdws-sidebar .woocommerce.widget_price_filter button.button, #et-boc .et-l .dsdws-cart table.shop_table td.actions button.button, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .woocommerce-shipping-calculator .shipping-calculator-form button, #et-boc .et-l .dsdws-cart p.return-to-shop a.button.wc-backward, #commentform .form-submit .et_pb_button {
            border-color     : <?php esc_html_e($outline_button_border_color );?> !important;
            color            : <?php esc_html_e($outline_button_text_color );?> !important;
            background-color : <?php esc_html_e($outline_button_bg_color );?> !important;
        }

        .dsdws-button-outline:hover, .et_pb_button.dsdws-button-outline:hover, body.et-db #et-boc .et-l .et_pb_button.dsdws-button-outline:hover, body.et-db #et-boc .dsdws-button-outline.et_pb_button:hover, body .dsdws-button-outline.et_pb_button:hover, .dsdws-module-button-outline .et_pb_button:hover, .dsdws-sidebar .widget_shopping_cart .woocommerce-mini-cart__buttons a.button:hover, .dsdws-sidebar .woocommerce.widget_price_filter button.button:hover, #et-boc .et-l .dsdws-cart table.shop_table td.actions button.button:hover, #et-boc .et-l .dsdws-cart .cart-collaterals .cart_totals .woocommerce-shipping-calculator .shipping-calculator-form button:hover, #et-boc .et-l .dsdws-cart p.return-to-shop a.button.wc-backward:hover, #commentform .form-submit .et_pb_button:hover {
            border-color     : <?php esc_html_e($outline_button_hover_border_color );?> !important;
            color            : <?php esc_html_e($outline_button_hover_text_color );?> !important;
            background-color : <?php esc_html_e($outline_button_hover_bg_color );?> !important;
        }
    </style>
    <?php
}

add_action('wp_head', 'divi_woocommerce_store_customize_css');

// close php tag
?>