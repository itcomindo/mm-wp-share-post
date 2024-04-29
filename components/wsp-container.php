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
				$wps_size = carbon_get_theme_option( 'wps_size' );
				echo '<ul class="animate__animated wsp-list wps-is-' . esc_html( $wps_size ) . '">';
				wsp_load_platforms();
				wsp_custom_platforms();
				echo '</ul>';
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
	} else {
		echo '<p>No platform selected</p>';
	}
}


/**
 * Custom Platforms
 */
function wsp_custom_platforms() {
	$wsp_use_custom_platform = carbon_get_theme_option( 'wsp_use_custom_platform' );
	$wps_size                = carbon_get_theme_option( 'wps_size' );
	if ( is_singular() ) {
		$post_title = str_replace( ' ', '%20', get_the_title() );
		$post_url   = rawurldecode( get_permalink() );
	}
	if ( $wsp_use_custom_platform ) {
		$cps = carbon_get_theme_option( 'wsp_custom_platform' );
		if ( $cps ) {
			foreach ( $cps as $cp ) {
				$cps_name       = $cp['wsp_cp_name'];
				$cps_prefix     = $cp['wsp_cp_prefix'];
				$cps_icon       = $cp['wsp_cp_icon'];
				$cps_bg_color   = $cp['wsp_cp_bg_color'];
				$cps_text_color = $cp['wsp_cp_text_color'];
				?>
				<li style="background-color: <?php echo esc_html( $cps_bg_color ); ?>;" class="platform-item pf-<?php echo esc_html( $cps_name ); ?> wps-size-<?php echo esc_html( $wps_size ); ?>"><a style="color:<?php echo esc_html( $cps_text_color ); ?>;" class="<?php echo esc_html( $cps_name ); ?>" href="<?php echo esc_html( $cps_prefix ) . '' . esc_html( $post_url ); ?>"><i class="<?php echo esc_html( $cps_icon ); ?>"></i></a></li>
				<?php
			}
		}
	}
}