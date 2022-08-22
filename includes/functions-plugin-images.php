<?php
/*
	plugin images functions
*/

/**
 * Declare the Namespace.
 *
 * @since 1.0.0
 */
namespace azurecurve\AddTwitterCards;

/**
 * Custom plugin image path.
 *
 * @since 1.2.0
 */
function custom_image_path( $path ) {
	if ( strpos( $path, PLUGIN_SLUG ) !== false ) {
		$path = plugin_dir_path( __FILE__ ) . '../assets/images';
	}
	return $path;
}

/**
 * Custom plugin image url.
 *
 * @since 1.2.0
 */
function custom_image_url( $url ) {
	if ( strpos( $url, PLUGIN_SLUG ) !== false ) {
		$url = esc_url_raw( plugin_dir_url( __FILE__ ) . '../assets/images' );
	}
	return $url;
}
