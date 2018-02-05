<?php
/**
 * Plugin Name: Site Configuration
 * Plugin URI: https://github.com/DeliciousMedia/DM-WordPress-Layout
 * Description: Site Configuration
 * Version: 1.0.0
 * Author: Delicious Media Limited
 * Author URI: https://www.deliciousmedia.co.uk/
 * License: GPLv3 or later
 * Text Domain: dm-customisations
 * Contributors: davepullig
 *
 * @package dm-wordpress-layout
 **/

/**
 * Switch plugins on/off according to environment (or other arbitrary rules)
 * Requires https://github.com/DeliciousMedia/Plugin-Control
 */
if ( class_exists( 'CWS_Disable_Plugins' ) ) {

	// Plugins to be disabled on development but enabled on staging/production (e.g. transactional SMTP provider).
	if ( defined( 'DM_ENVIRONMENT' ) && 'DEV' == DM_ENVIRONMENT ) {
		new CWS_Disable_Plugins( [ 'mailgun/mailgun.php' ], 'Disabled on development' );
	} else {
		new CWS_Enable_Plugins( [ 'mailgun/mailgun.php' ], 'Required on production & staging' );
	}

	// Stuff that is only required on live, but should be disabled elsewhere (e.g. tracking codes etc).
	$dm_plugins_live_only = [];
	if ( defined( 'DM_ENVIRONMENT' ) && 'LIVE' == DM_ENVIRONMENT ) {
		new CWS_Enable_Plugins( $dm_plugins_live_only, 'Required on production' );
	} else {
		new CWS_Disable_Plugins( $dm_plugins_live_only, 'Disabled on development & staging' );
	}
}
