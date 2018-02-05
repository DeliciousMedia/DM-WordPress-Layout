<?php
/**
 * wp-config.php for Delicious Media projects.
 *
 * Make changes which should apply to all environments here.
 * Make changes which should apply to individual environments in the local-config.php.
 */

/**
 * Always load the database credentials & salts from a seperate file.
 */
if ( ! file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	die( 'local-config.php is missing.' );
}
include( dirname( __FILE__ ) . '/local-config.php' );

/**
 * Setup URLS and the custom content directory.
 */
if ( ! isset( $_SERVER['HTTP_HOST'] ) ) {
	$_SERVER['HTTP_HOST'] = ''; // Prevent wp-cli complaining about missing host.
}

$dm_protocol = ( ! empty( $_SERVER['HTTPS'] ) && 'off' != $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
define( 'WP_SITEURL', $dm_protocol . $_SERVER['SERVER_NAME'] . '/wp' );
define( 'WP_HOME', $dm_protocol . $_SERVER['SERVER_NAME'] );
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', $dm_protocol . $_SERVER['HTTP_HOST'] . '/content' );

/**
 * Other settings.
 */
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'WPLANG', '' );

/**
 * Set some defaults, which we may override in local-config.php
 */
defined( 'WP_POST_REVISIONS' ) || define( 'WP_POST_REVISIONS', 30 );

/**
 * If we're in a development environment, enable debugging.
 * If not, hide errors and disable file/plugin modifications.
 */
if ( 'DEV' === DM_ENVIRONMENT ) {
	define( 'SAVEQUERIES', true );
	define( 'WP_DEBUG', true );
} else {
	ini_set( 'display_errors', 0 );
	define( 'WP_DEBUG_DISPLAY', false );
	define( 'DISALLOW_FILE_EDIT', true );
	define( 'DISALLOW_FILE_MODS', true );
}

/**
 * Load memcached settings, if they are there.
 */
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) ) {
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );
}

/**
 * Load WordPress.
 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );
