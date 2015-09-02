<?php 

/*
Plugin Name: Metapod
Plugin URI: http://eoinmurphy.ie
Description: Plugin for displaying products from an OSCommerce shopping cart database
Author: Eoin Murphy
Version: 0.1
Author URI: http://eoinmurphy.ie
*/

define('METAPOD_DIRECTORY', plugin_dir_path( __FILE__ ));

add_action ('wp_authenticate' , 'check_custom_authentication');

class Metapod {
	public static function log($file, $line){
		$fh = fopen(METAPOD_DIRECTORY . '/watch/' . $file, 'a+');
		fwrite($fh, $line . "\n");
		fclose($fh);
	}
}


function check_custom_authentication ($username) {
    global $wpdb;

    if (!username_exists($username)) {
        return;
    }
    
    $userinfo = get_user_by('login', $username);

    Metapod::log('login.txt', date('d-m-y H:i') . ' - ' .  $userinfo->user_login);
}

add_action( 'load-theme-editor.php', 'watchdog' );
add_action( 'load-plugin-editor.php', 'watchdog' );

function watchdog() {
    $userinfo = wp_get_current_user();

    $string = "Editor::";

    if( !isset($_GET['file']) ){
        $string .= "Default ";
    } else {
        $string .= "EDITING " . $_GET['file'];
        if( isset($_GET['updated']) ){
            $string .= "(SAVED)";
        }
    }

    $string .= " " . $userinfo->user_login;

    Metapod::log('access.txt', $string );
    //this is the wp admin edit.php post listing page!
}

?>