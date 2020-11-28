<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Add Twitter Cards
 * Description: Add Twitter Cards to attach rich photos to Tweets, helping to drive traffic to your website.
 * Version: 1.3.2
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/
 * Text Domain: add-twitter-cards
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname(__FILE__).'/pluginmenu/menu.php');
add_action('admin_init', 'azrcrv_create_plugin_menu_atc');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */

// add actions
add_action('admin_menu', 'azrcrv_atc_create_admin_menu');
add_action('admin_post_azrcrv_atc_save_options', 'azrcrv_atc_save_options');
add_action('admin_enqueue_scripts', 'azrcrv_atc_load_jquery');
add_action('admin_enqueue_scripts', 'azrcrv_atc_media_uploader');
add_action( 'wp_head', 'azrcrv_atc_insert_twittercard_tags', 0 );
add_action('plugins_loaded', 'azrcrv_atc_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_atc_add_plugin_action_link', 10, 2);
add_filter('codepotent_update_manager_image_path', 'azrcrv_atc_custom_image_path');
add_filter('codepotent_update_manager_image_url', 'azrcrv_atc_custom_image_url');

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('add-twitter-cards', false, $plugin_rel_path);
}

/**
 * Load JQuery.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_media_uploader() {
    global $post_type;
        if(function_exists('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        else {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
}

/**
 * Load JQuery.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_load_jquery($hook){
	wp_enqueue_script( 'azrcrv-atc', plugins_url('assets/jquery/jquery.js',__FILE__));
}

/**
 * Custom plugin image path.
 *
 * @since 1.2.0
 *
 */
function azrcrv_atc_custom_image_path($path){
    if (strpos($path, 'azrcrv-add-twitter-card') !== false){
        $path = plugin_dir_path(__FILE__).'assets/pluginimages';
    }
    return $path;
}

/**
 * Custom plugin image url.
 *
 * @since 1.2.0
 *
 */
function azrcrv_atc_custom_image_url($url){
    if (strpos($url, 'azrcrv-add-twitter-card') !== false){
        $url = plugin_dir_url(__FILE__).'assets/pluginimages';
    }
    return $url;
}

/**
 * Get options including defaults.
 *
 * @since 1.3.0
 *
 */
function azrcrv_atc_get_option($option_name){
 
	$defaults = array(
						'card_type' => 'summary',
						'enable_author_twitter' => 1,
						'dimensions' => array(
													'width' => 100,
													'height' => 100,
												),
					);

	$options = get_option($option_name, $defaults);

	$options = wp_parse_args($options, $defaults);

	return $options;

 }

/**
 * Add pluginnameazrcrv-atc action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.admin_url('admin.php?page=azrcrv-atc').'"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'add-twitter-cards').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add to menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_create_admin_menu(){
	//global $admin_page_hooks;
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Add Twitter Card Settings", 'add-twitter-cards')
						,esc_html__("Add Twitter Card", 'add-twitter-cards')
						,'manage_options'
						,'azrcrv-atc'
						,'azrcrv_atc_display_options');
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_display_options(){
	if (!current_user_can('manage_options')){
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'add-twitter-cards'));
    }
	
	// Retrieve plugin configuration options from database
	$options = azrcrv_atc_get_option('azrcrv-atc');
	?>
	<div id="azrcrv-atc-general" class="wrap">
		<fieldset>
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<?php if(isset($_GET['settings-updated'])){ ?>
				<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Settings have been saved.', 'add-twitter-cards'); ?></strong></p>
				</div>
			<?php } ?>
			<form method="post" action="admin-post.php">
				<input type="hidden" name="action" value="azrcrv_atc_save_options" />
				<input name="page_options" type="hidden" value="min_length,max_length,mod_length,use_network" />
				
				<!-- Adding security through hidden referrer field -->
				<?php wp_nonce_field('azrcrv-atc', 'azrcrv-atc-nonce'); ?>
				<table class="form-table">
				
				<tr><th scope="row"><?php esc_html_e('Use floating featured image?', 'add-twitter-cards'); ?></th><td>
					<fieldset><legend class="screen-reader-text"><span>Use floating featured image</span></legend>
					<label for="use_ffi"><input name="use_ffi" type="checkbox" id="use_ffi" value="1" <?php checked( '1', $options['use_ffi'] ); ?> /><?php esc_html_e('Use floating featured image in Twitter card?', 'add-twitter-cards'); ?></label>
					</fieldset>
				</td></tr>
				
				<tr><th scope="row"><label for="card_type"><?php esc_html_e('Card Type', 'add-twitter-cards'); ?></label></th><td>
					<select name="card_type">
						<option value="summary" <?php if($options['card_type'] == 'summary'){ echo ' selected="selected"'; } ?>><?php esc_html_e('Summary', 'add-twitter-cards'); ?></option>
						<option value="summary_large_image" <?php if($options['card_type'] == 'summary_large_image'){ echo ' selected="selected"'; } ?>><?php esc_html_e('Summary Large Image', 'add-twitter-cards'); ?></option>
					</select>
					<p class="description"><?php esc_html_e('Select type of Twitter card.', 'add-twitter-cards'); ?></p>
				</td></tr>
				
				<tr><th scope="row"><label for="twitter"><?php esc_html_e('Twitter Username', 'add-twitter-cards'); ?></label></th><td>
					<input type="text" name="twitter" value="<?php echo esc_html(stripslashes($options['twitter'])); ?>" class="regular-text" />
					<p class="description"><?php esc_html_e('Site\'s Twitter Username', 'add-twitter-cards'); ?></p>
				</td></tr>
				
				<tr><th scope="row"><label for="dimensions"><?php esc_html_e('Minimum Dimensions', 'add-twitter-cards'); ?></label></th><td>
					<input type="number" name="dimensions-width" value="<?php echo esc_html(stripslashes($options['dimensions']['width'])); ?>" class="small-text" />&nbsp;x&nbsp;<input type="number" name="dimensions-height" value="<?php echo esc_html(stripslashes($options['dimensions']['height'])); ?>" class="small-text" />
					<p class="description"><?php esc_html_e('Specify minimum dimensions (width and height).', 'add-twitter-cards'); ?></p>
				</td></tr>
				
				<tr><th scope="row"><label for="fallback_image"><?php esc_html_e('Fallback Image', 'add-twitter-cards'); ?></label></th><td>
					<img src="<?php echo esc_url($options['fallback_image']); ?>" id="azrcrv-atc-fallback-image" style="width: 300px;"><br />
					<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
					<input type="hidden" name="fallback_image" id="fallback_image" value="<?php echo esc_url($options['fallback_image']); ?>" class="regular-text" />
					
					<input type='button' id="azrcrv-atc-upload-image" class="button upload" value="<?php esc_html_e( 'Upload image', 'add-twitter-cards' ); ?>" />
					<input type='button' id="azrcrv-atc-remove-image" class="button remove" value="<?php esc_html_e( 'Remove image', 'add-twitter-cards' ); ?>" /><br />
					<span class="description"><?php esc_html_e( 'Upload, choose or remove your profile picture; save your profile to add-twitter-cards the change.', 'add-twitter-cards' ); ?></span>
				</td></tr>
				
				<tr><th scope="row"><?php esc_html_e('Enable Author Twitter?', 'add-twitter-cards'); ?></th><td>
					<fieldset><legend class="screen-reader-text"><span>Enable Author Twitter</span></legend>
					<label for="enable_author_twitter"><input name="enable_author_twitter" type="checkbox" id="enable_author_twitter" value="1" <?php checked( '1', $options['enable_author_twitter'] ); ?> /><?php esc_html_e('Enable Author Twitter on user profiles; used to add Content Creator to Twitter card.', 'add-twitter-cards'); ?></label>
					</fieldset>
				</td></tr>
				
				</table>
				<input type="submit" value="Save Changes" class="button-primary"/>
			</form>
		</fieldset>
	</div>
	<?php
}

/**
 * Save settings.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_save_options(){
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'add-twitter-cards'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-atc', 'azrcrv-atc-nonce')){
	
		// Retrieve original plugin options array
		$options = get_option('azrcrv-atc');
		
		$option_name = 'use_ffi';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		$option_name = 'card_type';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		}
		
		$option_name = 'twitter';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		}
		
		$option_name = 'dimensions-width';
		if (isset($_POST[$option_name])){
			$options['dimensions']['width'] = sanitize_text_field($_POST[$option_name]);
		}
		$option_name = 'dimensions-height';
		if (isset($_POST[$option_name])){
			$options['dimensions']['height'] = sanitize_text_field($_POST[$option_name]);
		}
		
		$option_name = 'fallback_image';
		if (isset($_POST[$option_name])){
			$options[$option_name] = sanitize_text_field($_POST[$option_name]);
		}
		
		$option_name = 'enable_author_twitter';
		if (isset($_POST[$option_name])){
			$options[$option_name] = 1;
		}else{
			$options[$option_name] = 0;
		}
		
		// Store updated options array to database
		update_option('azrcrv-atc', $options);
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-atc&settings-updated', admin_url('admin.php')));
		exit;
	}
}

/**
 * Check if function active (included due to standard function failing due to order of load).
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_is_plugin_active($plugin){
    return in_array($plugin, (array) get_option('active_plugins', array()));
}

/**
 * Insert Twitter Card into post and page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_insert_twittercard_tags() {
	
	// Bring $post object into scope.
	global $post;
	// Set defaults for Twitter shares.
	$url   = get_bloginfo( 'url' );
	$title = get_bloginfo( 'name' );
	$desc  = get_bloginfo( 'description' );
	
	$option_name = 'azrcrv-atc';
	$options = azrcrv_atc_get_option($option_name);
	
	$image_count = 0;
	$imagetouse = '';
	if (!is_singular()){
		$imagetouse = $options['fallback_image'];
		$image_count = 0;
	/*}elseif ($options['use_thumbnail'] == 1 AND has_post_thumbnail()){
		$image_properties = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'medium_large' );
		$imagetouse = $image_properties[0];*/
	}elseif (azrcrv_atc_is_plugin_active('azrcrv-floating-featured-image/azrcrv-floating-featured-image.php') AND $options['use_ffi'] == 1){
		$image_count = 1;
	}elseif (azrcrv_atc_is_plugin_active('azrcrv-floating-featured-image/azrcrv-floating-featured-image.php') AND $options['use_ffi'] == 0 AND strpos($post->post_content, 'featured-image') == true){
		$image_count = 2;
	}elseif ($options['use_ffi'] == 0 AND strpos($post->post_content, 'featured-image') == false){
		$image_count = 1;
	}else{
		$image_count = 1;
	}
	
	if ($image_count > 0){
		$counter = 0;
		if ( preg_match_all( '/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s',  do_shortcode($post->post_content), $matches ) ) {
			$_matches = reset( $matches );
			foreach ( $_matches as $image ) {
				$counter += 1;
				if ($counter == $image_count){
					if ( preg_match( '`src=(["\'])(.*?)\1`', $image, $_match ) ) {
						
						list($width, $height) = getimagesize($_match[2]);
						if ($width >= $options['dimensions']['width'] || $height >= $options['dimensions']['height']){
							$imagetouse = $_match[2];
							break;
						}
					}
				}
			}
		}
	}
	
	if (STRLEN($imagetouse) == 0){
		$imagetouse = $options['fallback_image'];
	}
	$imagetouse .= '?'.uniqid();
	
	// If on a post or page, reset defaults.
	if( is_single() || is_page() ) {
		// Update URL to current post/page.
		$url = get_permalink();
		// Update title only if $post has non-empty title.
		$title = (get_the_title() ) ? get_the_title() : $title;
		// Update description only if $post has non-empty excerpt.
		if (!empty( $post->post_excerpt)){
			$desc = $post->post_excerpt;
		}else{
			$desc = trim(strip_tags(do_shortcode($post->post_content)));
			if (strlen($desc) > 200){
				$desc = substr($desc, 0 , 199).'‎&hellip;';
			}
		}
		
	}
	// Assemble the meta tag markup.
	$card_type = $options['card_type'];
	if (!isset($card_type)){
		$card_type = 'summary_large_image'; //summary or summary_large_image
	}
	$markup  = '<meta name="twitter:card" content="'.esc_html($card_type).'" />' . "\n";
	$markup .= '<meta name="twitter:url" content="' . $url . '" />' . "\n";
	$markup .= '<meta name="twitter:title" content="' . $title . '" />' . "\n";
	$markup .= '<meta name="twitter:description" content="' . $desc . '" />' . "\n";
	$markup .= '<meta name="twitter:image" content="' . $imagetouse . '" />' . "\n";
	$markup .= '<meta name="twitter:image:alt" content="' . $title . '" />' . "\n";
	$markup .= '<meta name="twitter:site" content="@'.str_replace( '@', '', esc_html($options['twitter'])).'" />' . "\n";
	
	// Add creator tag if author profile has a Twitter username.
	if (isset($post)){
		$twitter = get_user_meta($post->post_author, 'azrcrv_atc_twitter', true);
	}else{
		$twitter = $options['twitter'];
	}
	if ($card_type == 'summary_large_image' AND $twitter){
		$markup .= '<meta name="twitter:creator" content="@'.str_replace('@', '', esc_html($twitter)).'" />'."\n";
	}
	// Print the tags.
	echo $markup;
}

/**
 * Add Twitter field to User Profile.
 *
 * @since 1.0.0
 *
 */
function azrcrv_atc_add_twitter($profile_fields) {

	// Add new fields
	$profile_fields['azrcrv_atc_twitter'] = 'Twitter Username';

	return $profile_fields;
}
add_filter('user_contactmethods', 'azrcrv_atc_add_twitter');

?>