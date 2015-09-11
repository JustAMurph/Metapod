<?php

/*
*
* A collection of helper functions. Wrapped into the 'Metapod' class to fake a namespace for older versions of PHP.
*
*/

class Metapod {
	
	public static function displayNotices() {

		global $wp_session;

		if(!isset($wp_session['Metapod.notices']) || empty($wp_session['Metapod.notices'])){
			return;
		}

		foreach($wp_session['Metapod.notices'] as $notice){
			   echo"<div class=\"error\"> <p>$notice</p></div>"; 
		}
	}

	public static function addNotice($notice, $type = 'error'){
		global $wp_session;

		if(isset($wp_session['Metapod.notices'])){
			$wp_session['Metapod.notices'][] = $notice;
			return;
		}

		$wp_session['Metapod.notices'] = array(
			$notice
		);
	}

	public static function getDateTime(){
		return date('d-m-y H:i');
	}

}

add_action( 'admin_notices', array('Metapod', 'displayNotices') ); 
