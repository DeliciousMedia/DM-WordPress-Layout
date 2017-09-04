<?php
/**
 * Plugin Name: DM Environment Indicators
 * Description: Add an indicator to the admin bar to show which environment we are in.
 * Version: 1.1
 * Author URI: https://www.deliciousmedia.co.uk/
 * Network: true
 */

// Default to unknown if no environment is set.
defined ( 'DM_ENVIRONMENT' ) || define ( 'DM_ENVIRONMENT', 'UNKNOWN' );

// Add node into admin bar.
function dmei_add_adminbar_node( $wp_admin_bar ) {
	$wp_admin_bar->add_node( [
		'title'  => esc_html( strtoupper( DM_ENVIRONMENT ) ),
		'id'     => 'dmei',
		'parent' => 'top-secondary',
		'meta'   => [
			'class' => 'dmei',
		],
	] );
}
add_action( 'admin_bar_menu', 'dmei_add_adminbar_node', 1 );

// Insert CSS into head.
function dmei_insert_css() {

	// Don't insert CSS if we're not logged in.
	if ( ! is_user_logged_in() ) return;

	switch ( strtoupper( DM_ENVIRONMENT ) ) {

		case 'DEV':
		case 'LOCAL':
			$color = '#00cc00';
			break;

		case 'STAGING':
		case 'STAGE':
		case 'TEST':
		case 'UAT':
		case 'PREPROD':
			$color = '#ff9933';
			break;

		case 'LIVE':
		case 'PROD':
		case 'PRODUCTION':
			$color = '#ff0000';
			break;
		default:
			$color = '#666';
			break;
	}
	?>
	<style type="text/css">
		#wpadminbar .dmei .ab-item {
			background-color: <?php echo esc_html( $color ); ?> !important;
			color: #fff !important;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'dmei_insert_css' );
add_action( 'wp_head', 'dmei_insert_css' );
