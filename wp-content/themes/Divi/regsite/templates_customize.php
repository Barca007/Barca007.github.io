<?php
// Get which template installed at last
$template = get_option( 'divi_template' );

// If we have this option
if ( $template ) {
  $template_customize_file = dirname(__FILE__) . '/templates/' . $template . '/' . $template . '.php';
  // Check if we have customize file for current template
  if ( file_exists( $template_customize_file ) ) {
    // Require customize file
    require_once( $template_customize_file );
  }
}