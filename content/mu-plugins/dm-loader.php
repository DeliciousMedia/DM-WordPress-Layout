/*
Plugin Name: DM Plugin & Library Loader
Description: Loads required plugins and libraries.
Author: Delicious Media Limited
Author URI: https://www.deliciousmedia.co.uk/
Version: 1.0
*/

if ( ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) )
	return;

$dm_plugins = array(
	'custom-meta-boxes/custom-meta-boxes.php',
);

foreach ( $dm_plugins as $dm_plugin ) {
	require_once WPMU_PLUGIN_DIR . '/' . $dm_plugin;
}
unset($dm_plugin);
