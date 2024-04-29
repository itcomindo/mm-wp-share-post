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
			$share_button = '<div class="wsp-share-btn">Share</div>';
			$content     .= $share_button;
		} elseif ( 'before' === $wps_location ) {
			$share_button = '<span class="wsp-share-btn">Share</span>';
			$content      = $share_button . $content;
		} elseif ( 'both' === $wps_location ) {
			$share_button = '<div class="wsp-share-btn">Share</div>' . $content . '<div class="wsp-share-btn">Share</div>';
			$content     .= $share_button;
		}
	}

	return $content;
}
add_filter( 'the_content', 'mm_append_share_button' );
