<?php
/**
 * Plugin Name: DM Customisations
 * Description: Customisations to WordPress for Delicious Media projects.
 * Author URI: https://www.deliciousmedia.co.uk/
 * Version: 1.1
 * Network: true
 *
 * @package  DM-WordPress-layout
 */

/**
 * Disable XMLRPC functionality.
 */
add_filter( 'wp_xmlrpc_server_class', '__return_false' );
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Tidy up WP Head.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Let's not enqueue the Emoji scripts & styles.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Remove comment and trackback support from all post types.
 */
function dm_remove_comment_support() {
	foreach ( get_post_types() as $post_type ) {
		remove_post_type_support( $post_type, 'comments' );
		remove_post_type_support( $post_type, 'trackbacks' );
	}
}

add_action( 'init', 'dm_remove_comment_support', 900 );
