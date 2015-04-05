<?php

/*
	Always load the database credentials & salts from a seperate file outside.
*/

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	die ("Local config file is missing.");
}

/*
	Setup the custom content directory
*/

define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

/*
	Other settings
*/

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'WPLANG', '' );

/*
	Disable file editing & plugin installation via UI
*/

define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

/*
	If we're in a development environment, enable debugging.
	If not, hide errors.
*/

if (defined('DM_DEV')) {
	define( 'SAVEQUERIES', true );
	define( 'WP_DEBUG', true );
} else {
	ini_set( 'display_errors', 0 );
	define( 'WP_DEBUG_DISPLAY', false );
}

/*
	Load memcached settings, if they are there.
*/
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

/*
	Load WordPress
*/


if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
