<?php

class HtaccessProtect {
	
	private $config = '.htaccess';
	public function __construct() {
		//$homePath = get_home_path();
		$configPath = ABSPATH . $this->config;

		if( file_exists($configPath) ){
			$this->appendProtection($configPath, $this->rootProtectionFilesDirective());
		}

		$adminConfigPath = ABSPATH . DIRECTORY_SEPARATOR . "wp-admin" . DIRECTORY_SEPARATOR . $this->config;
		if( file_exists($adminConfigPath) ){
			$this->appendProtection($adminConfigPath, $this->wpAdminAllowFilesDirective());
		}


	}

	public function appendProtection($filePath, $text = null){

		if(!$text){
			return;
		}

		$contents = file_get_contents($filePath);
		if( strpos($contents, '#Metapod') !== FALSE){
			return;
		}

		

		$fh = fopen($filePath, 'a+');
		fwrite($fh, $text);
		fclose($fh);
	}

	private function rootProtectionFilesDirective(){

		return "
		
#Metapod BEGIN
Only allows the main WP index.php file to be accessed directly.
<Files *.php>
    Order Deny,Allow
    Deny from all
    Allow from 127.0.0.1
</Files>

<Files index.php>
    Order Allow,Deny
    Allow from all
</Files>

<Files wp-login.php>
	Order Allow,Deny
	Allow from all
</Files>
#Metapod END
";
	}

	private function wpAdminAllowFilesDirective(){
		// WP admin area uses a lot of different PHP files. It's better to add them all

		return "
#Metapod BEGIN
<Files *.php>
	Order Deny,Allow
	Allow from all:while ( <= 10) {
		# code...
	}
</Files>
#Metapod END
		";
	}
}