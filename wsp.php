<?php
/**
 * Plugin Name: MM WP Share Post
 * Author: Budi Haryono
 * Author URI: https://budiharyono.id
 * Version: 1.0.0
 * Description: WordPress plugin to share post as popup modal
 *
 * @package wsp
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

// Define Plugin Path.
define( 'WSP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Define Plugin URL.
define( 'WSP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/**
 * Check CF Loaded
 */
function wsp_call_carbon_fields() {
	if ( ! class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
		\Carbon_Fields\Carbon_Fields::boot();
	}
}

/**
 * MCS CF Loaded
 */
function wsp_cf_loaded() {
	if ( ! function_exists( 'carbon_fields_boot_plugin' ) ) {
		wsp_call_carbon_fields();
	}
}
add_action( 'plugins_loaded', 'wsp_cf_loaded' );



require_once WSP_PLUGIN_PATH . 'assets/assets.php';
