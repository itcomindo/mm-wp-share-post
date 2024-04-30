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

	$suffix = wsp_is_devmode() ? '' : '.min';

	wp_enqueue_style( 'animate-style', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1', 'all' );

	wp_enqueue_style( 'wsp-style', WSP_PLUGIN_URL . 'assets/css/wsp' . $suffix . '.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'wsp-script', WSP_PLUGIN_URL . 'assets/js/wsp' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'wsp_load_assets' );


/**
 * Load Font Awesome if not exist
 */
function wsp_enqueue_fa() {
	if ( ! wp_style_is( 'fontawesome-handle', 'enqueued' ) ) {
		wp_enqueue_style( 'mm-fontawesome-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
	}
}

add_action( 'wp_enqueue_scripts', 'wsp_enqueue_fa' );
