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

define( 'AUTH_KEY', '@SALT1@' );
define( 'SECURE_AUTH_KEY', '@SALT2@' );
define( 'LOGGED_IN_KEY', '@SALT3@' );
define( 'NONCE_KEY', '@SALT4@' );
define( 'AUTH_SALT', '@SALT5@' );
define( 'SECURE_AUTH_SALT', '@SALT6@' );
define( 'LOGGED_IN_SALT', '@SALT7@' );
define( 'NONCE_SALT', '@SALT8@' );

/*
	Enable development stuff. Comment out on live sites.
*/

define('DM_DEV',true);
