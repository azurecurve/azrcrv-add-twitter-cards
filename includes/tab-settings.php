<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\AddTwitterCards;

/**
 * Settings tab.
 */

$tab_settings_label = PLUGIN_NAME . ' ' . esc_html__( 'Settings', 'azrcrv-atc' );
$tab_settings       = '
<table class="form-table azrcrv-settings">
		
	<tr>
	
		<th scope="row" colspan="2">
		
			<label for="explanation">
				' . sprintf( esc_html__( '%s allow you to attach rich photos to Tweets, helping to drive traffic to your website.', 'azrcrv-atc' ), PLUGIN_NAME ) . '
			</label>
			
		</th>
		
	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Use featured image?', 'azrcrv-atc' ) . '
			
		</th>
		
		<td>
			
			<legend class="screen-reader-text">
					' . esc_html__( 'Use featured image?', 'azrcrv-atc' ) . '
			</legend>

			<input name="use_featured_image" type="checkbox" id="use_featured_image" value="1" ' . checked( '1', $options['use_featured_image'], false ) . ' />
			<label for="use_featured_image">
				<span class="description">
					' . esc_html__( 'Use featured image set on the post.', 'azrcrv-atc' ) . '
				</span>
			</label>
			
		</td>
		
	</tr>

	<tr>
	
		<th scope="row">
		
			' . esc_html__( 'Use floating featured image?', 'azrcrv-atc' ) . '
			
		</th>
		
		<td>
			
			<legend class="screen-reader-text">
					' . esc_html__( 'Use floating featured image?', 'azrcrv-atc' ) . '
			</legend>';

if ( check_is_plugin_active( 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php' ) ) {

	$tab_settings .= '
					<input name="use_ffi" type="checkbox" id="use_ffi" value="1" ' . checked( '1', $options['use_ffi'], false ) . ' />
			<label for="use_ffi">
				<span class="description">
					' . esc_html__( 'Use floating featured image if available in the post.', 'azrcrv-atc' ) . '
				</span>
			</label>';

} else {

	$tab_settings .= sprintf( esc_html__( '%1$s from %2$s is not installed', 'azrcrv-atc' ), '<a href="' . DEVELOPER_URL_RAW . '/floating-featured-image/">Floating Featured Image</a>', DEVELOPER_URL );

}

		$tab_settings .= '</td>
		
	</tr>
	
	<tr>
		
		<th scope="row">
		
			<label for="card_type">' . esc_html__( 'Card Type', 'azrcrv-atc' ) . '</label>
			
		</th>
		
		<td>
		
			<select name="card_type">
				
				<option value="summary" ' . ( $options['card_type'] == 'summary' ? 'selected="selected"' : '' ) . '>
					' . esc_html__( 'Summary', 'azrcrv-atc' ) . '
				</option>
				
				<option value="summary_large_image" ' . ( $options['card_type'] == 'summary_large_image' ? 'selected="selected"' : '' ) . '>
					' . esc_html__( 'Summary Large Image', 'azrcrv-atc' ) . '
				</option>
				
			</select>
			
			<p class="description">
				' . esc_html__( 'Select type of Twitter card.', 'azrcrv-atc' ) . '
			</p>
		
		</td>
		
	</tr>
				
	<tr>
		
		<th scope="row">
		
			<label for="twitter">' . esc_html__( 'Twitter Username', 'azrcrv-atc' ) . '</label>

		</th>
		
		<td>
			
			<input type="text" name="twitter" value=" ' . esc_html( $options['twitter'] ) . '" class="regular-text" />
			
			<p class="description">
				' . esc_html__( 'Site\'s Twitter Username', 'azrcrv-atc' ) . '
			</p>
		
		</td>
	</tr>

	<tr>
		<th scope="row">
		
			' . esc_html__( 'Minimum Dimensions', 'azrcrv-atc' ) . '
			
		</th>
		
		<td>
		
			<input type="number" name="dimensions-width" value="' . esc_html( $options['dimensions']['width'] ) . '" class="small-text" />&nbsp;x&nbsp;<input type="number" name="dimensions-height" value="' . esc_html( $options['dimensions']['height'] ) . '" class="small-text" />
			
			<p class="description">
				' . esc_html__( 'Specify minimum dimensions (width and height).', 'azrcrv-atc' ) . '
			</p>
		
		</td>
	
	</tr>

	<tr>
		<th scope="row">
		
			' . esc_html__( 'Fallback Image', 'azrcrv-atc' ) . '
			
		</th>
		
		<td>

			<p>
			
				<img src="' . esc_url_raw( $options['fallback_image'] ) . '" id="' . PLUGIN_HYPHEN . '-fallback-image" style="width: 300px;"><br />
				
				<!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
				<input type="hidden" name="fallback_image" id="fallback_image" value="' . esc_url_raw( $options['fallback_image'] ) . '" class="regular-text" />
				
				<input type="button" id="' . PLUGIN_HYPHEN . '-upload-image" class="button upload" value="' . esc_html__( 'Upload image', 'azrcrv-atc' ) . '" />
				<input type="button" id="' . PLUGIN_HYPHEN . '-remove-image" class="button remove" value="' . esc_html__( 'Remove image', 'azrcrv-atc' ) . '" />
				
			</p>
			
			<p class="description">
				' . esc_html__( 'Upload, choose or remove your fallback image; recommended open graph image is 1200px by 627px.', 'azrcrv-atc' ) . '
			</p>
	
		</td>
		
	</tr>
				
	<tr>
		
		<th scope="row">' . esc_html__( 'Enable Author Twitter?', 'azrcrv-atc' ) . '
		</th>
		
		<td>
		
			<input name="enable_author_twitter" type="checkbox" id="enable_author_twitter" value="1" ' . checked( '1', $options['enable_author_twitter'], false ) . ' />
			<label for="enable_author_twitter">
				' . esc_html__( 'Enable Author Twitter on user profiles; used to add Content Creator to Twitter card.', 'azrcrv-atc' ) . '
			</label>
		</td>
		
	</tr>

</table>';
