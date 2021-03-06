<?php

/**
 * Disables translation updates when install plugin.
 * 
 * @since 4.7.5.2
 */
class Disable_Plugin_Updates_Translations {
  // Constructor
  public function __construct() {
    // Disable Plugin Translations 2.8 to 3.0
    add_action( 'pre_transient_update_plugins', array( $this, 'remove_translations' ), 10, 2 );

    // Disable Plugin Translations 3.0
    add_filter( 'pre_site_transient_update_plugins', array( $this, 'remove_translations' ), 10, 2 );
  }

  /**
   * Remove translations
   * 
   * @param array $transient Transient options
   * @param value $key       Transient value name
   * @return array $option
   */
  public function remove_translations( $transient, $key ) {
    remove_filter( 'pre_transient_update_plugins', array( $this, 'remove_translations' ), 10, 2 );
    remove_filter( 'pre_site_transient_update_plugins', array( $this, 'remove_translations' ), 10, 2 );

    $option = get_site_transient( $key );
		if ( isset( $option->translations ) ) {
			$option->translations = array();
		}

    add_filter('pre_transient_update_plugins', array($this, 'remove_translations'), 10, 2);
    add_filter('pre_site_transient_update_plugins', array($this, 'remove_translations'), 10, 2);

    return $option;
  }
}