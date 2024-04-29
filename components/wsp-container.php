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
			<small class="wsp-text animate__animated">Pilih platform yang ingin Anda bagikan:</small>
			<div class="wsp-close-btn">Cancel</div>
				<?php
				wsp_load_platforms();
				?>
		</div>
	</div>
	<?php
}


/**
 * WSP Launcer
 */
function wsp_launcher() {
	if ( is_singular() ) {
		add_action( 'wp_footer', 'wsp_container', 100 );
	}
}
add_action( 'wp', 'wsp_launcher', 100 );

/**
 * Link Share
 */
function wsp_link_share() {
	$link = array(
		'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=',
		'twitter'   => 'https://twitter.com/intent/tweet?url=',
		'linkedin'  => 'https://www.linkedin.com/shareArticle?mini=true&url=',
		'pinterest' => 'https://pinterest.com/pin/create/button/?url=',
		'whatsapp'  => 'https://api.whatsapp.com/send?text=',
		'tumblr'    => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=',
		'reddit'    => 'https://www.reddit.com/submit?url=',
		'telegram'  => 'https://t.me/share/url?url=',
		'vk'        => 'https://vk.com/share.php?url=',
		'xing'      => 'https://www.xing.com/spi/shares/new?url=',
		'email'     => 'mailto:?subject=&body=',
		'copy'      => '',
	);
	return $link;
}

/**
 * WSP Load Platform
 */
function wsp_load_platforms() {

	if ( is_singular() ) {
		$post_title = str_replace( ' ', '%20', get_the_title() );
		$post_url   = rawurldecode( get_permalink() );
	}

	$wps_size = carbon_get_theme_option( 'wps_size' );

	$wps_platform = carbon_get_theme_option( 'wps_platform' );
	if ( ! empty( $wps_platform ) ) {
		echo '<ul class="animate__animated wsp-list wps-is-' . esc_html( $wps_size ) . '">';
		foreach ( $wps_platform as $platform ) {
			if ( 'copy' === $platform ) {
				$icon_class = 'fa-regular fa-clipboard';
			} elseif ( 'email' === $platform ) {
				$icon_class = 'fa-regular fa-envelope';
			} else {
				$icon_class = 'fa-brands fa-' . esc_html( $platform ) . '';
			}
			echo '<li class="platform-item pf-' . esc_html( $platform ) . ' wps-size-' . esc_html( $wps_size ) . '"><a class="' . esc_html( $platform ) . '" href="' . esc_html( wsp_link_share()[ $platform ] ) . '' . esc_html( $post_url ) . '"><i class="' . esc_html( $icon_class ) . '"></i></a></li>';
		}
		echo '</ul>';
	} else {
		echo '<p>No platform selected</p>';
	}
}
