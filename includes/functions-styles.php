<?php
/*
	tab output on settings page
*/

/**
 * Declare the Namespace.
 *
 * @since 1.0.0
 */
namespace azurecurve\AddTwitterCards;

/**
 * Register admin styles.
 *
 * @since 2.0.0
 */
function register_admin_styles() {
	wp_register_style( 'azrcrv-admin-standard-styles', esc_url_raw( plugins_url( '../assets/css/admin-standard.css', __FILE__ ) ), array(), '22.3.2' );
	wp_register_style( 'azrcrv-pluginmenu-admin-styles', esc_url_raw( plugins_url( '../assets/css/admin-pluginmenu.css', __FILE__ ) ), array(), '22.3.2' );
}

/**
 * Enqueue admin styles.
 *
 * @since 2.0.0
 */
function enqueue_admin_styles() {
	global $pagenow;

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['page'] ) && ( $_GET['page'] == PLUGIN_HYPHEN || $_GET['page'] == 'azrcrv-plugin-menu' ) || $pagenow == 'profile.php' || $pagenow == 'edit-user.php' ) {
		wp_enqueue_style( 'azrcrv-admin-standard-styles' );
		wp_enqueue_style( 'azrcrv-pluginmenu-admin-styles' );
	}
}

/**
 * Check if shortcode on current page and then load css and jqeury.
 *
 * @since 2.0.0
 */
function check_for_shortcode( $posts ) {
	if ( empty( $posts ) ) {
		return $posts;
	}

	// array of shortcodes to search for.
	$shortcodes = array(
		'shortcode',
	);

	// loop through posts.
	$found = false;
	foreach ( $posts as $post ) {
		// loop through shortcodes.
		foreach ( $shortcodes as $shortcode ) {
			// check the post content for the shortcode.
			if ( has_shortcode( $post->post_content, $shortcode ) ) {
				$found = true;
				// break loop as shortcode found in page content.
				break 2;
			}
		}
	}

	if ( $found ) {
		// as shortcode found call functions to load css and jquery.
		enqueue_frontend_styles();
	}
	return $posts;
}

