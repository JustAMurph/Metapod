<?php 

/*
Plugin Name: Metapod
Plugin URI: http://eoinmurphy.ie/metapod
Description: A plugin for helping secure wordpress against attacks.
Author: Eoin Murphy
Version: 0.1
Author URI: http://eoinmurphy.ie
*/

require('Class/Interfaces/LoggerInterface.php');
require('Class/FileLogger.php');
require('Class/Watchdog.php');
require('Class/Metapod.php');
require('Class/HtaccessProtect.php');

require('Lib/Install.php');
require('Lib/Pluggable.php');

define('METAPOD_DIRECTORY', plugin_dir_path( __FILE__ ));
define('DS', DIRECTORY_SEPARATOR);

$logger = new FileLogger();

$watchDog = new WatchDog($logger);
$watchDog->watchFiles();
$watchDog->watchLogin();

function metapod_install(){
	//metapod_create_tables();

	if( strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== FALSE ){

		$HtaccessProtect = new HtaccessProtect();

	}

}

add_action( 'init', 'metapod_init' );

function metapod_init() {
     //$HtaccessProtect = new HtaccessProtect();

}

register_activation_hook( __FILE__, 'metapod_install' );

?>