<?php
/*
Plugin Name: DM Must Use Plugin Loader
Description: Loads MU plugins from subfolders.
Author: Delicious Media Limited
Author URI: https://www.deliciousmedia.co.uk/
Version: 1.1
*/

if ( ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) )
	return;

$dm_plugins = array(
//	'custom-meta-boxes/custom-meta-boxes.php',
);

foreach ( $dm_plugins as $dm_plugin ) {
	require_once WPMU_PLUGIN_DIR . '/' . $dm_plugin;
}

add_action( 'pre_current_active_plugins', function () use ( $dm_plugins ) {
	global $plugins, $wp_list_table;
	// Add our own mu-plugins to the page
	foreach ( $dm_plugins as $plugin_file ) {
		$plugin_data = get_plugin_data( WPMU_PLUGIN_DIR . "/$plugin_file", false, false ); //Do not apply markup/translate as it'll be cached.
		if ( empty ( $plugin_data['Name'] ) )
			$plugin_data['Name'] = $plugin_file;
		$plugins['mustuse'][ $plugin_file ] = $plugin_data;
	}
	// Recount totals
	$GLOBALS['totals']['mustuse'] = count( $plugins['mustuse'] );
	// Only apply the rest if we're actually looking at the page
	if ( $GLOBALS['status'] !== 'mustuse' )
		return;
	// Reset the list table's data
	$wp_list_table->items = $plugins['mustuse'];
	foreach ( $wp_list_table->items as $plugin_file => $plugin_data ) {
		$wp_list_table->items[$plugin_file] = _get_plugin_data_markup_translate( $plugin_file, $plugin_data, false, true );
	}
	$total_this_page = $GLOBALS['totals']['mustuse'];
	if ( $GLOBALS['orderby'] ) {
		uasort( $wp_list_table->items, array( $wp_list_table, '_order_callback' ) );
	}
	// Remove register-theme-directory.php from the list.

	// Force showing all plugins
	// See https://core.trac.wordpress.org/ticket/27110
	$plugins_per_page = $total_this_page;
	$wp_list_table->set_pagination_args( array(
		'total_items' => $total_this_page,
		'per_page' => $plugins_per_page,
	) );
});

add_action( 'network_admin_plugin_action_links', function ( $actions, $plugin_file, $plugin_data, $context ) use ( $dm_plugins ) {
	if ( $context !== 'mustuse' || ! in_array( $plugin_file, $dm_plugins ) ) {
		return;
	}
	$actions[] = sprintf( '<span style="color:#333">File: <code>%s</code></span>', $plugin_file );
	return $actions;
}, 10, 4 );

unset($dm_plugins);