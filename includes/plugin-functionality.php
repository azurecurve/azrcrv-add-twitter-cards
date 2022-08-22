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
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.0.0
 */
function check_is_plugin_active( $plugin ) {
	return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}


/**
 * Insert Open Graph Tags into post and page.
 *
 * @since 1.0.0
 */
function insert_twittercard_tags() {

	// Bring $post object into scope.
	global $post;

	// Set defaults for shares.
	$url   = get_bloginfo( 'url' );
	$title = get_bloginfo( 'name' );
	$desc  = get_bloginfo( 'description' );

	$content = $post->post_content;

	$options = get_option_with_defaults( 'azrcrv-atc' );

	$image_count = 0;
	$imagetouse  = '';
	if ( ! is_singular() ) {
		$imagetouse  = $options['fallback_image'];
		$image_count = 0;
	} elseif ( $options['use_featured_image'] == 1 and has_post_thumbnail() ) {
		$imagetouse  = get_the_post_thumbnail_url( $post->ID, 'full' );
		$image_count = 0;
	} elseif ( check_is_plugin_active( 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php' ) and $options['use_ffi'] == 1 ) {
		$image_count = 1;
	} elseif ( check_is_plugin_active( 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php' ) and $options['use_ffi'] == 0 and strpos( $content, 'featured-image' ) == true ) {
		$image_count = 2;
	} elseif ( $options['use_ffi'] == 0 and strpos( $content, 'featured-image' ) == false ) {
		$image_count = 1;
	} else {
		$image_count = 1;
	}

	if ( $image_count > 0 ) {
		$counter = 0;
		if ( preg_match_all( '/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', do_shortcode( $content ), $matches ) ) {
			$_matches = reset( $matches );
			foreach ( $_matches as $image ) {
				$counter += 1;
				if ( $counter == $image_count ) {
					if ( preg_match( '`src=(["\'])(.*?)\1`', $image, $_match ) ) {
						list($width, $height) = getimagesize( $_match[2] );
						if ( $width >= $options['dimensions']['width'] || $height >= $options['dimensions']['height'] ) {
							$imagetouse = $_match[2];
							break;
						}
					}
				}
			}
		}
	}

	if ( strlen( $imagetouse ) == 0 ) {
		$imagetouse = $options['fallback_image'];
	}

	if ( strlen( $imagetouse ) > 0 ) {
		list($width, $height) = getimagesize( $imagetouse );
		if ( $width < $options['dimensions']['width'] || $height < $options['dimensions']['height'] ) {
			$imagetouse = $options['fallback_image'];
		}
	}

	$imagetouse .= '?' . uniqid();

	// If on a post or page, reset defaults.
	if ( is_single() || is_page() ) {
		// Update URL to current post/page.
		$url = get_permalink();
		// Update title only if $post has non-empty title.
		$title = ( get_the_title() ) ? get_the_title() : $title;
		// Update description only if $post has non-empty excerpt.
		if ( ! empty( $post->post_excerpt ) ) {
			$desc = $post->post_excerpt;
		} else {
			$desc = trim( wp_strip_all_tags( do_shortcode( $content ) ) );
			if ( strlen( $desc ) > 200 ) {
				$desc = substr( $desc, 0, 199 ) . '‎&hellip;';
			}
		}
	}

	// Assemble the meta tag markup.
	$card_type = $options['card_type'];
	if ( ! isset( $card_type ) ) {
		$card_type = 'summary_large_image'; // summary or summary_large_image
	}
	$markup  = '<meta name="twitter:card" content="' . esc_attr( $card_type ) . '" />' . "\n";
	$markup .= '<meta name="twitter:url" content="' . esc_url_raw( $url ) . '" />' . "\n";
	$markup .= '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
	$markup .= '<meta name="twitter:description" content="' . esc_attr( $desc ) . '" />' . "\n";
	$markup .= '<meta name="twitter:image" content="' . esc_url_raw( $imagetouse ) . '" />' . "\n";
	$markup .= '<meta name="twitter:image:alt" content="' . esc_attr( $title ) . '" />' . "\n";

	// Add site creator tags if author profile has a Twitter username.
	if ( isset( $post ) ) {
		$user_twitter = get_user_meta( $post->post_author, 'azrcrv_atc_twitter', true );
	}
	$site_twitter = $options['twitter'];

	// site twitter account
	if ( isset( $site_twitter ) && strlen( $site_twitter ) > 0 ) {
		$markup .= '<meta name="twitter:site" content="@' . str_replace( '@', '', esc_attr( $site_twitter ) ) . '" />' . "\n";
	}
	// only include creator if card type is summary_large_image and user
	if ( $card_type == 'summary_large_image' ) {
		if ( isset( $user_twitter ) && strlen( $user_twitter ) > 0 ) {
			$markup .= '<meta name="twitter:creator" content="@' . str_replace( '@', '', esc_attr( $user_twitter ) ) . '" />' . "\n";
		}
	}

	// Print the tags.
	echo $markup;
}


/**
 * Add Twitter field to User Profile.
 *
 * @since 1.0.0
 */
function add_twitter( $profile_fields ) {

	// Add new fields
	$profile_fields['azrcrv_atc_twitter'] = 'Twitter Username';

	return $profile_fields;

}
