<?php
/*
	other plugins tab on settings page
*/

/**
 * Declare the Namespace.
 */
namespace azurecurve\AddTwitterCards;

/**
 * Other Plugins tab.
 */
$plugin_array = get_option( 'azrcrv-plugin-menu' );

$plugin_list = '';
foreach ( $plugin_array as $plugin_name => $plugin_details ) {
	if ( $plugin_details['retired'] == 0 ) {
		$alternative_color = '';
		if ( isset( $plugin_details['bright'] ) and $plugin_details['bright'] == 1 ) {
			$alternative_color = 'bright-';
		}
		if ( isset( $plugin_details['premium'] ) and $plugin_details['premium'] == 1 ) {
			$alternative_color = 'premium-';
		}
		if ( ! is_plugin_active( $plugin_details['plugin_link'] ) ) {
			$plugin_list .= "<a href='{$plugin_details['dev_URL']}' class='azrcrv-{$alternative_color}plugin-index'>{$plugin_name}</a>";
		}
	}
}

$tab_plugins_label = esc_html__( 'Other Plugins', 'azrcrv-atc' );
$tab_plugins       = '
<table class="form-table azrcrv-settings">

	<tr>
	
		<td scope="row" colspan=2>
		
			<p>' .
				sprintf( esc_html__( '%1$s was one of the first plugin developers to start developing for ClassicPress; all plugins are available from %2$s and are integrated with the %3$s plugin for fully integrated, no hassle, updates.', 'azrcrv-atc' ), '<strong>' . DEVELOPER_SHORTNAME . '</strong>', DEVELOPER_URL, '<a href="https://directory.classicpress.net/plugins/update-manager/">Update Manager</a>' )
			. '</p>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Integrated Plugins', 'azrcrv-atc' ) . '</h2>
			
		</th>

	</tr>';

// check if floating featured image plugin is active.
if ( check_is_plugin_active( 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php' ) ) {
	$plugin_ffi = '<a href="admin.php?page=azrcrv-ffi" class="azrcrv-plugin-index">Floating Featured Image</a>';
} else {
	$plugin_ffi = '<a href="https://development.azurecurve.co.uk/classicpress-plugins/floating-featured-image/" class="azrcrv-plugin-index">Floating Featured Image</a>';
}

// check if floating featured image plugin is active.
if ( check_is_plugin_active( 'azrcrv-add-open-graph-tags/azrcrv-add-open-graph-tags.php' ) ) {
	$plugin_atc = '<a href="admin.php?page=azrcrv-aogt" class="azrcrv-plugin-index">Add Open Graph Tags</a>';
} else {
	$plugin_atc = '<a href="https://development.azurecurve.co.uk/classicpress-plugins/add-open-graph-tags/" class="azrcrv-plugin-index">Add Open Graph Tags</a>';
}

	$tab_plugins .= '<tr>
	
		<td scope="row" colspan=2>
		
			
			<label for="additional-plugins">
				' . sprintf( esc_html__( '%1$s integrates with the following plugins from %2$s:', 'azrcrv-atc' ), '<strong>' . PLUGIN_NAME . '</strong>', DEVELOPER_URL ) . '
			</label>
			<ul class="azrcrv-plugin-index">
				<li>
					' .
						$plugin_ffi
					. '
				</li>
			</ul>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Complimentary Plugins', 'azrcrv-atc' ) . '</h2>
			
		</th>

	</tr>

	<tr>
	
		<td scope="row" colspan=2>
		
			
			<label for="complimentary-plugins">
				' . sprintf( esc_html__( 'The below plugin from %1$s compliments %2$s:', 'azrcrv-atc' ), DEVELOPER_URL, '<strong>' . PLUGIN_NAME . '</strong>' ) . '
			</label>
			<ul class="azrcrv-plugin-index">
				<li>
					' .
						$plugin_atc
					. '
				</li>
			</ul>
		
		</td>
	
	</tr>

	<tr>
	
		<th scope="row" colspan=2 class="azrcrv-settings-section-heading">
			
				<h2 class="azrcrv-settings-section-heading">' . esc_html__( 'Available Plugins', 'azrcrv-atc' ) . '</h2>
			
		</th>

	</tr>
	
	<tr>
	
		<td scope="row" colspan=2>
			
			<p>' .
				sprintf( esc_html__( 'Other plugins available from %s, which you are not using, are:', 'azrcrv-atc' ), '<strong>' . DEVELOPER_URL . '</strong>' )
			. '</p>
		
		</td>
	
	</tr>
	
	<tr>
	
		<td scope="row" colspan=2>
		
			' . $plugin_list . '
			
		</td>

	</tr>
	
</table>';
