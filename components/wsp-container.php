<?php
/**
 *
 * WSP Container
 *
 * @package wsp
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


/**
 * WSP Container
 */
function wsp_container() {
	?>
	<div id="wsp-pr" class="hide">
		<div id="wsp-wr">
			<div class="wsp-close-btn">Cancel</div>
			<ul class="wsp-list">
				<li><a href="#" title="">F</a></li>
				<li><a href="#" title="">I</a></li>
				<li><a href="#" title="">T</a></li>
				<li><a href="#" title="">X</a></li>
				<li><a href="#" title="">P</a></li>
				<li><a href="#" title="">F</a></li>
				<li><a href="#" title="">I</a></li>
				<li><a href="#" title="">T</a></li>
				<li><a href="#" title="">X</a></li>
				<li><a href="#" title="">P</a></li>
			</ul>
		</div>
	</div>
	<?php
}


/**
 * WSP Launcer
 */
function wsp_launcher() {
	if ( is_single() || is_page() || is_singular() ) {
		add_action( 'wp_footer', 'wsp_container', 100 );
	}
}
add_action( 'wp', 'wsp_launcher', 100 );