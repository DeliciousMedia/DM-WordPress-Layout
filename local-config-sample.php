<?php
/**
 * This file contains the environment specific elements from wp-config.php.
 * It must include the database config, salts and DM_ENVIRONMENT constant.
 */

/* Database configuration */
define( 'DB_NAME', '@DB_NAME@' );
define( 'DB_USER', '@DB_USER@' );
define( 'DB_PASSWORD', '@DB_PASSWORD@' );
define( 'DB_HOST', '@DB_HOST@' );

$table_prefix  = '@DB_PREFIX@';

/* Salts; auto-populated on dev; replace for each environment from https://api.wordpress.org/secret-key/1.1/salt/ */
define( 'AUTH_KEY', '@SALT_PLACEHOLDER@' );
define( 'SECURE_AUTH_KEY', '@SALT_PLACEHOLDER@' );
define( 'LOGGED_IN_KEY', '@SALT_PLACEHOLDER@' );
define( 'NONCE_KEY', '@SALT_PLACEHOLDER@' );
define( 'AUTH_SALT', '@SALT_PLACEHOLDER@' );
define( 'SECURE_AUTH_SALT', '@SALT_PLACEHOLDER@' );
define( 'LOGGED_IN_SALT', '@SALT_PLACEHOLDER@' );
define( 'NONCE_SALT', '@SALT_PLACEHOLDER@' );

/* Define which environment we're in. Usual values are: DEV/STAGE/LIVE */
define( 'DM_ENVIRONMENT', 'DEV' );

/* Location for application logs */
define( 'DM_LOGPATH', '@LOG_PATH@' );
