<?php
/*
	This is a sample local-config.php file
	It must include the database config and salts
*/

/*
	Database config.
*/

define( 'DB_NAME', '@DB_NAME@' );
define( 'DB_USER', '@DB_USER@' );
define( 'DB_PASSWORD', '@DB_PASSWORD@' );
define( 'DB_HOST', '@DB_HOST@' );

$table_prefix  = '@DB_PREFIX@';

/*
	Salts. Get them from https://api.wordpress.org/secret-key/1.1/salt
*/

define( 'AUTH_KEY', '@SALT@' );
define( 'SECURE_AUTH_KEY', '@SALT@' );
define( 'LOGGED_IN_KEY', '@SALT@' );
define( 'NONCE_KEY', '@SALT@' );
define( 'AUTH_SALT', '@SALT@' );
define( 'SECURE_AUTH_SALT', '@SALT@' );
define( 'LOGGED_IN_SALT', '@SALT@' );
define( 'NONCE_SALT', '@SALT@' );

/*
	Enable development stuff. Comment out on live sites.
*/

define('DM_DEV',true);
