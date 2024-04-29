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
			Field::make( 'text', 'sdsdsdsteremsdse', 'Test' ),
		)
	);
}
add_action( 'carbon_fields_register_fields', 'wsp_load_fields' );
