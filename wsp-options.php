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

			// how to display, auto or shortcode.
			Field::make( 'select', 'wps_display', 'Display' )
			->add_options(
				array(
					'auto'      => 'Auto',
					'shortcode' => 'Shortcode',
				)
			)
			->set_default_value( 'auto' ),

			// location trigger.
			Field::make( 'select', 'wps_location', 'Location' )
			->add_options(
				array(
					'before' => 'Before Content',
					'after'  => 'After Content',
					'both'   => 'Both',
				)
			)
			->set_conditional_logic(
				array(
					array(
						'field'    => 'wps_display',
						'operator' => '==',
						'value'    => 'auto',
					),
				)
			)
			->set_default_value( 'after' ),

			// html field with content [wsp_trigger] if shortcode is selected.
			Field::make( 'html', 'wps_shortcode', 'Shortcode' )
			->set_conditional_logic(
				array(
					array(
						'field'    => 'wps_display',
						'operator' => '==',
						'value'    => 'shortcode',
					),
				)
			)
			->set_html(
				'<p>Gunakan shortcode <code>[wsp_trigger]</code> untuk menampilkan tombol berbagi.</p>'
			),

			/**
			 * ###################################
			 * Styling Options Start
			 * ###################################
			 */

			Field::make( 'separator', 'stylmsepmsp', 'Styling Options' )
			->set_classes( 'wspsep' ),

			// Share button text.
			Field::make( 'text', 'wps_trigger_text', 'Share Button Text' )
			->set_default_value( 'Share' )
			->set_required( true ),

			// Share button background color.
			Field::make( 'color', 'wps_trigger_bg', 'Background Color' )
			->set_default_value( '#000000' )
			->set_required( true ),

			// Share button text color.
			Field::make( 'color', 'wps_trigger_text_color', 'Text Color' )
			->set_default_value( '#ffffff' )
			->set_required( true ),

			/**
			 * ###################################
			 * Platforms Options Start
			 * ###################################
			 */

			// Platforms start.
			Field::make( 'separator', 'platformsepmsp', 'Platforms Options' )
			->set_classes( 'wspsep' ),

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

			// custom platforms start.
			Field::make( 'checkbox', 'wsp_use_custom_platform', 'Buat Platform Sendiri' )
			->set_option_value( 'yes' )
			->set_default_value( false )
			->set_help_text( 'Aktifkan untuk membuat platform sendiri.' ),

			Field::make( 'complex', 'wsp_custom_platform', 'Custom Platform' )
			->add_fields(
				array(
					// name.
					Field::make( 'text', 'wsp_cp_name', 'Nama' )
					->set_required( true )
					->set_help_text( 'Nama platform yang akan ditampilkan.' ),

					// prefix url.
					Field::make( 'text', 'wsp_cp_prefix', 'Prefix URL' )
					->set_required( true )
					->set_help_text( 'URL yang akan ditambahkan sebelum link situs Anda. contoh: https://www.facebook.com/sharer/sharer.php?u=' ),

					// icon class.
					Field::make( 'text', 'wsp_cp_icon', 'Icon Class' )
					->set_required( true )
					->set_help_text( 'Class icon yang akan ditampilkan. contoh: fab fa-facebook' ),

					// background color.
					Field::make( 'color', 'wsp_cp_bg_color', 'Warna Latar' )
					->set_required( true )
					->set_default_value( '#000000' )
					->set_help_text( 'Warna latar belakang platform.' ),

					// text color.
					Field::make( 'color', 'wsp_cp_text_color', 'Warna Teks' )
					->set_required( true )
					->set_default_value( '#ffffff' )
					->set_help_text( 'Warna teks platform.' ),

				)
			),

		)
	);
}
add_action( 'carbon_fields_register_fields', 'wsp_load_fields' );
