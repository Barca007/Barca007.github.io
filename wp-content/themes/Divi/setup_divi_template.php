<?php

/**
 * Author: Denis Lapshin <lapshin@reg.ru>
 * Usage: php setup_divi_template.php template=wooshop (eg.)
 * Important: Must be placed into Divi folder.
 * Version: 2.0
 */


// Set memory and execution time limit.
ini_set( 'memory_limit', '512M' );
ini_set( 'max_execution_time', 300 );


// Get global arguments.
global $argv;


// Loads the WordPress Environment.
require_once dirname( __FILE__, 4 ) . '/wp-load.php';
// Require Divi Import
require_once dirname( __FILE__ ) . '/plugins/divi-import/includes/DiviImport.php';


// Get params from command line.
foreach ((array)$argv as $value) {
	@list($key, $value) = @explode("=",$value);
	if ($key && $value) $params[$key] = $value;
}


// Get templates list.
$templates_list = DiviImport::get_json_content();


// Set slug name for template arg ( $template ).
for( $i = 0; $i < count( $templates_list ); ++$i ) {
  if ( $params['template'] == $templates_list[$i]['slug'] ) {
		$template = $templates_list[$i];
		if ( isset( $params['email'] ) ) file_put_contents( dirname( __FILE__ ) . '/email.txt', $params['email'] );
	}
}


// Import Init
DiviImport::import_init( false, $template );
