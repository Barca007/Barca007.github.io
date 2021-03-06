<?php

if ( !class_exists('DiviUpdater') ):

class DiviUpdater {
	protected $optionName = '';
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'divi_update_';

	public function __construct(){
        $this->theme = 'Divi';
		$this->dataUrl = 'https://api.turnkey.reg.ru/wordpress/updates/data.json';
		$this->enableAutomaticChecking = true;
        $this->optionName = 'external_divi_updates';
        

		$this->installHooks();		
	}

	public function installHooks(){
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}
		add_filter('site_transient_update_themes', array($this,'injectUpdate')); 
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));
	}

	public function requestUpdate($queryArgs = array()){
		$queryArgs['installed_version'] = $this->getInstalledVersion(); 
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);

		$options = array(
			'timeout' => 60,
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);

		$url = $this->dataUrl; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}

		$result = wp_remote_get($url, $options);

		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = DiviUpdate::fromJson($body);
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}

		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}

	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}

		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}

	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}
		
		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state); 

		$state->update = $this->requestUpdate();
		update_option($this->optionName, $state);
	}

	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}

	public function injectUpdate($updates){
		$state = get_option($this->optionName);

		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$updates->response[$this->theme] = $state->update->toWpFormat();
		}

		return $updates;
	}

	public function deleteStoredData(){
		delete_option($this->optionName);
	} 

	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}

	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}

	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}
	
endif;

if ( !class_exists('DiviUpdate') ):

class DiviUpdate {
	public $version;
	public $details_url; 
	public $download_url;

	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}

		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}

		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
        }

		return $update;
	}

	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);
		
		if ( !empty($this->download_url) ){
			$update['package'] = $this->download_url;
		}
		
		return $update;
	}
}
	
endif;



if ( ! function_exists( 'et_core_enable_automatic_updates' ) ):
function et_core_enable_automatic_updates( $deprecated, $version ) {
    if ( ! is_admin() ) {
        return;
    }

    if ( isset( $GLOBALS['et_core_updates'] ) ) {
        return;
    }

    $GLOBALS['et_core_updates'] = new DiviUpdater();
    }
endif;