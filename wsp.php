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

/**
 * Check if the current environment is development mode or on production
 * development mode is when the server is localhost
 * return true if the server is localhost
 */
function mm_is_devmode() {
	if ( isset( $_SERVER['REMOTE_ADDR'] ) && in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ), true ) ) {
		return true;
	}
	return false;
}


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
require_once WSP_PLUGIN_PATH . 'components/components.php';
require_once WSP_PLUGIN_PATH . 'wsp-options.php';

/**
 * Menambahkan tombol berbagi ke akhir konten post pada halaman single.
 *
 * Fungsi ini mengaitkan sebuah elemen HTML ke bagian akhir konten post
 * ketika ditampilkan di halaman single post. Hal ini dilakukan dengan menggunakan
 * filter 'the_content' yang disediakan oleh WordPress.
 *
 * @package wsp
 * @since 1.0.0
 * @param string $content Konten asli dari post.
 * @return string Konten yang telah dimodifikasi dengan tombol berbagi.
 */
function mm_append_share_button( $content ) {
	if ( is_singular() ) {
		$wps_location = carbon_get_theme_option( 'wps_location' );

		if ( 'after' === $wps_location ) {
			$share_button = mm_get_button_trigger();
			$content     .= $share_button;
		} elseif ( 'before' === $wps_location ) {
			$share_button = mm_get_button_trigger();
			$content      = $share_button . $content;
		} elseif ( 'both' === $wps_location ) {
			$share_button_before = mm_get_button_trigger();
			$share_button_after  = mm_get_button_trigger();
			$content             = $share_button_before . $content . $share_button_after;
		}
	}

	return $content;
}



/**
 * Shortcode to show trigger button for share buttons.
 *
 * This function creates a shortcode that can be used to display a trigger button
 * for the share buttons. The shortcode can be used in the content of a post or page
 * to display the trigger button wherever it is placed.
 */
function mm_wps_trigger_shortcode() {
	$share_button = mm_get_button_trigger();
	return $share_button;
}


/**
 * Display WPS Trigger
 */
function mm_wps_trigger() {
	if ( is_singular() ) {
		$wps_display = carbon_get_theme_option( 'wps_display' );
		if ( 'auto' === $wps_display ) {
			add_filter( 'the_content', 'mm_append_share_button' );
		} else {
			add_shortcode( 'wsp_trigger', 'mm_wps_trigger_shortcode' );
		}
	} else {
		return;
	}
}
add_action( 'wp', 'mm_wps_trigger' );


/**
 * Get Trigger Text
 */
function mm_get_trigger_text() {
	$wps_trigger_text = carbon_get_theme_option( 'wps_trigger_text' );
	if ( $wps_trigger_text ) {
		return $wps_trigger_text;
	} else {
		return 'Share';
	}
}


/**
 * Get The button trigger
 */
function mm_get_button_trigger() {
	$wpst_bg      = carbon_get_theme_option( 'wps_trigger_bg' );
	$wpst_color   = carbon_get_theme_option( 'wps_trigger_text_color' );
	$share_button = '<div class="wsp-share-btn" style="background-color:' . $wpst_bg . '; color:' . $wpst_color . '">' . esc_html( mm_get_trigger_text() ) . '</div>';
	return $share_button;
}
