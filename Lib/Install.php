<?php


function metapod_create_tables() {

	$table_name = $wpdb->prefix . 'metapod_admin_login';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		lastLoginAttempt datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		ip tinytext NOT NULL,
		loginAttempts mediumint(3) text NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	dbDelta( $sql );

}