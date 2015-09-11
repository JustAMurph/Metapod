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

define('METAPOD_DIRECTORY', plugin_dir_path( __FILE__ ));
define('DS', DIRECTORY_SEPARATOR);

$logger = new FileLogger();

$watchDog = new WatchDog($logger);
$watchDog->watchFiles();
$watchDog->watchLogin();

?>