<?php
/**
 *
 * Assets
 *
 * @package wsp
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Loads Assets
 */
function wsp_load_assets() {

	wp_enqueue_style( 'wsp-style', WSP_PLUGIN_URL . 'assets/css/wsp.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'wsp-script', WSP_PLUGIN_URL . 'assets/js/wsp.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'wsp_load_assets' );
