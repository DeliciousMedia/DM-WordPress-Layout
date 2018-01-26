<?php
/**
 * Plugin Name: DM Site Options
 * Description: Default options page for DM sites.
 * Author URI: https://www.deliciousmedia.co.uk/
 * Version: 1.1
 * Network: true
 *
 * @package  _s
 */

/**
 * Create an options page for site.
 * Classes can be added to create columns (.cols-2, .cols-3).
 */
function dmso_register_theme_options_metabox() {

	$prefix = '_dmso_';
	$name = get_bloginfo( 'name' );

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box(
		[
			'id'                 => 'dmso_metabox',
			'title'              => esc_html( $name ) . esc_html__( ' Settings', 'textdomain' ),
			'object_types'       => [ 'options-page' ],

			/*
             * The following parameters are specific to the options-page box
             * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
             */

			'option_key'         => 'site_options', // The option key and admin menu page slug.
			'icon_url'           => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
			'menu_title'         => esc_html__( ' Options', 'textdomain' ), // Falls back to 'title' (above).
			// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
			// 'capability'         => 'edit_pages', // Cap required to view options-page.
			// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'textdomain' ), // The text for the options-page save button. Defaults to 'Save'.
		]
	);

	/*
     * Options fields ids only need
     * to be unique within this box.
     * Prefix is not needed.
     */

	$cmb_options->add_field(
		[
			'name'       => __( 'Phone number', 'textdomain' ),
			'id'         => $prefix . 'phone_number',
			'type'       => 'text',
			'classes'    => 'cols-2',
		]
	);

	$cmb_options->add_field(
		array(
			'name'    => __( 'Email', 'textdomain' ),
			'id'      => $prefix . 'email',
			'type'    => 'text_email',
			'classes' => 'cols-2',
		)
	);

	$cmb_options->add_field(
		[
			'name'       => 'Address',
			'id'         => $prefix . 'address',
			'type'       => 'text',
			'repeatable' => true,
		]
	);

	$cmb_options->add_field(
		[
			'name'    => __( 'Twitter', 'textdomain' ),
			'id'      => $prefix . 'twitter',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);

	$cmb_options->add_field(
		[
			'name'    => __( 'Facebook', 'textdomain' ),
			'id'      => $prefix . 'facebook',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);

	$cmb_options->add_field(
		[
			'name'    => __( 'Instagram', 'textdomain' ),
			'id'      => $prefix . 'instagram',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);

	/**
	$cmb_options->add_field(
		[
			'name'    => __( 'LinkedIn', 'textdomain' ),
			'id'      => $prefix . 'linkedin',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);

	$cmb_options->add_field(
		[
			'name'    => __( 'Google+', 'textdomain' ),
			'id'      => $prefix . 'Google+',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);

	$cmb_options->add_field(
		[
			'name'    => __( 'LinkedIn', 'textdomain' ),
			'id'      => $prefix . 'Pinterest',
			'type'    => 'text_url',
			'classes' => 'cols-3',
		]
	);
	*/
}
add_action( 'cmb2_admin_init', 'dmso_register_theme_options_metabox' );

/**
 * Wrapper function around cmb2_get_option
 *
 * @since  0.1.0
 * @param  string $key     Options array key.
 * @param  mixed  $default Optional default value.
 * @return mixed           Option value.
 */
function dmso_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'dmso_options', $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'dmso_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

/**
 * Load custom column styles for CMB2 on Site Options admin page.
 *
 * @return mixed
 */
function dmso_custom_column_styles() {
	if ( ! is_admin() ) {
		return;
	}
	echo '<style>
		@media screen and (min-width: 1250px) {
			.cmb2-options-page #cmb2-metabox-dmso_metabox {
				width: 100%;
				max-width: 1200px;
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row {
				float: left;
				padding: 16px;
				width: -webkit-calc(100% - 34px);
				width: -moz-calc(100% - 34px);
				width: calc(100% - 34px);
				max-width: 1200px;
			}
		   .cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-2 {
		   		width: 566px;
				width: -webkit-calc(50% - 34px);
				width: -moz-calc(50% - 34px);
				width: calc(50% - 34px);
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-2:first-of-type {
				width: 567px;
				margin-right: -1px;
				width: -webkit-calc(50% - 33px);
				width: -moz-calc(50% - 33px);
				width: calc(50% - 33px);
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-3 {
				width: 366px;
				width: -webkit-calc(33.3333% - 34px);
				width: -moz-calc(33.3333% - 34px);
				width: calc(33.3333% - 34px);
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-3:not(:last-of-type) {
				width: 367px;
				margin-right: -1px;
				width: -webkit-calc(33.3333% - 33px);
				width: -moz-calc(33.3333% - 33px);
				width: calc(33.3333% - 33px);
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-3 .cmb-th {
				width: 100px;
			}
			.cmb2-options-page #cmb2-metabox-dmso_metabox>.cmb-row.cols-3 .cmb-td {
				margin-left: 100px;
			}
			.cmb2-options-page input#submit-cmb.button.button-primary {
				clear: both;
				float: left;
				margin-top: 2rem;
			}
		}
	 </style>';
}
add_action( 'admin_head', 'dmso_custom_column_styles' );
