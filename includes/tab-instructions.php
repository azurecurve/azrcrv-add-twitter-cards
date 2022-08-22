<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\AddTwitterCards;

/**
 * Instructions tab.
 */

$tab_instructions_label = esc_html__( 'Instructions', 'azrcrv-atc' );
$tab_instructions       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Add Twitter Cards', 'azrcrv-atc' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .

				esc_html__( 'This plugin allows you to attach rich photos to Tweets, helping to drive traffic to your website.', 'azrcrv-atc' ) . '
					
			</p>
		
			<p>' .
				sprintf( esc_html__( 'This %s plugin will allow you to choose between summary and summary large image card types and add them to every page using an image from the page content, featured image or a fall back image specified on the Settings tab.', 'azrcrv-atc' ), '<strong>' . PLUGIN_NAME . '</strong>' ) . '
					
			</p>
		
		</td>
	
	</tr>
	
</table>';
