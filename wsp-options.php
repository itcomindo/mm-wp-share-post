<?php
/**
 *
 * WSP Options
 *
 * @package wsp
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Field Options
 *
 * Menambahkan field ke dalam halaman WSP Options di dalam admin.
 */
function wsp_load_fields() {
	Container::make( 'theme_options', 'WSP Options' )
	->add_fields(
		array(

			// icon size.
			Field::make( 'select', 'wps_size', 'Size' )
			->add_options(
				array(
					'inherit' => 'Inherit',
					'small'   => 'Small',
					'medium'  => 'Medium',
					'large'   => 'Large',
				)
			)
			->set_default_value( 'inherit' ),

			// platforms.
			Field::make( 'multiselect', 'wps_platform', 'Select Platforms' )
			->set_options(
				array(
					'facebook'  => 'Facebook',
					'twitter'   => 'Twitter',
					'linkedin'  => 'Linkedin',
					'pinterest' => 'Pinterest',
					'whatsapp'  => 'Whatsapp',
					'tumblr'    => 'Tumblr',
					'reddit'    => 'Reddit',
					'telegram'  => 'Telegram',
					'vk'        => 'VK',
					'xing'      => 'Xing',
					'email'     => 'Email',
					'copy'      => 'Copy Link',
				)
			),
		)
	);
}
add_action( 'carbon_fields_register_fields', 'wsp_load_fields' );
