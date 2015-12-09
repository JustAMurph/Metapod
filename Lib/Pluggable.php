<?php

/**
 * These functions replace the Core Wordpress 'pluggable functions'
 *
 */


/*
* Very similar to the Core WP Function except the addition of the "do_action('wp_login_success')"
*/

function wp_authenticate($username, $password) {
	if(!session_id()) {
        session_start();
    }

    /*$loginAttempts = 0;

	if(isset($_SESSION['Metapod.loginAttempts'])){
		$loginAttempts = $_SESSION['Metapod.loginAttempts'];
	}

	$loginAttempts++;

    $lastLoginAttempt = null;
	if(isset($_SESSION['Metapod.lastLoginAttempt'])){
		$lastLoginAttempt = $_SESSION['Metapod.lastLoginAttempt'];
	}

	$currentAttempt = time();

	if($loginAttempts > 3){

		$tolerence = 900; // Fifteen Minutes in seconds
		if( ($currentAttempt - $lastLoginAttempt) < $tolerence){
			return new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Too many uncessful login attempts. This account has been disabled for 15 minutes.'));
		} else {
			$loginAttempts = 0;
			$currentAttempt = time();
			return new WP_Error('authentication_failed', __('Your are now permitted 3 more login attemps. Please try to login again.'));
		}

	}
	
	$_SESSION['Metapod.loginAttempts'] = $loginAttempts;
	$_SESSION['Metapod.lastLoginAttempt'] = $currentAttempt;

    */
    
	$username = sanitize_user($username);
	$password = trim($password);

	$user = apply_filters( 'authenticate', null, $username, $password );

	if ( $user == null ) {
		$user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));
	}

	$ignore_codes = array('empty_username', 'empty_password');

	if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
		do_action( 'wp_login_failed', $username );
	} else {
		do_action( 'wp_login_success', $username);
	}

	return $user;
}