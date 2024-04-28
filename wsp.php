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

require_once WSP_PLUGIN_PATH . 'assets/assets.php';
