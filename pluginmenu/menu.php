<?php

/*

Menu Version 2.0

*/

add_action("admin_menu", "azrcrv_add_plugin_menu");
add_action('admin_head', 'azrcrv_plugin_menu_load_css');

// azurecurve menu
if (!function_exists('azrcrv_add_plugin_menu')){
	function azrcrv_add_plugin_menu(){
		global $admin_page_hooks;
		
		if (empty ($admin_page_hooks['azrcrv-menu-test'])){
			add_menu_page(
				'azurecurve Plugins',
				'azurecurve',
				'manage_options',
				'azrcrv-plugin-menu',
				'azrcrv_plugin_menu',
				plugins_url('/pluginmenu/images/Favicon-16x16.png', __DIR__)
			);
			add_submenu_page(
				'azrcrv-plugin-menu',
				'Plugins',
				'Plugins',
				'manage_options',
				'azrcrv-plugin-menu',
				'azrcrv_plugin_menu'
			);
		}
	}
}

if (!function_exists('azrcrv_plugin_menu_load_css')){
	function azrcrv_plugin_menu_load_css(){
		wp_enqueue_style('azrcrv-plugin-index', plugins_url('css/style.css', __FILE__));
	}
}

if (!function_exists('azrcrv_plugin_menu')){
	function azrcrv_plugin_menu(){
		global $wpdb;
		$table_name = $wpdb->base_prefix.'azrcrv_plugin_menu';
		
		echo "<h3>azurecurve ClassicPress Plugins</h3>";
		
		echo "<div style='display: block;'><h3>Active Plugins</h3>";
		echo "<span class='azrcrv-plugin-index'>";
		
		$sql = 'SELECT * FROM '.$table_name.' ORDER BY text';
		$plugin_array = $wpdb->get_results($sql);
		
		foreach($plugin_array as $plugin_details) {
			if (is_plugin_active($plugin_details->plugin_link)){
				echo '<a href="' . $plugin_details->admin_URL . '" class="azrcrv-plugin-index">' . $plugin_details->text . '</a>';
			}
		}
		
		echo "</span></div>";
		echo "<p style='clear: both' />";
		
		echo "<div style='display: block;'><h3>Other Available Plugins</h3>";
		echo "<span class='azrcrv-plugin-index'>";
		
		$countofplugins = 0;
		
		foreach($plugin_array as $pluginItem) {
			if (!is_plugin_active($pluginItem->plugin_link)){
				echo '<a href="' . $pluginItem->dev_URL . '" class="azrcrv-plugin-index">' . $pluginItem->text . '</a>';
				$countofplugins += 1;
			}
		}
		
		if ($countofplugins == 0){
			echo "Congratulations! You're using all of the azurecurve plugins.";
		}
		
		echo "</span></div>";
		
		echo "<p style='clear: both' />";
		
		echo "<div style='display: block;'><h3>Support azurecurve</h3>";
		echo "<p>azurecurve plugins are free, open source tools for increasing the potential of ClassicPress as a CMS.</p>
				<p>Plugins are a result of many many hours spent to deliver best product possible, reading comments from you and trying to support every ClassicPress release as soon as possible.</p>
				<p>You can help support the development by donating a small amount of money.</p>
				<div style='width:165px; margin: auto; '>
				<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
				<input type='hidden' name='cmd' value='_s-xclick'>
				<input type='hidden' name='hosted_button_id' value='MCJQN9SJZYLWJ'>
				<input type='image' src='https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal – The safer, easier way to pay online.'>
				<img alt='' border='0' src='https://www.paypalobjects.com/en_GB/i/scr/pixel.gif' width='1' height='1'>
				</form>
				</div>
				</div>";
	}
}

/**
 * Create plugin menu on installation.
 *
 * @since 1.0.0
 *
 */
if (!function_exists('azrcrv_create_plugin_menu_atc')){
	function azrcrv_create_plugin_menu_atc(){
		azrcrv_create_plugin_menu_table_atc();
		azrcrv_populate_plugin_menu_table_atc();
	}
}

/**
 * Populate table on installation.
 *
 * @since 1.0.0
 *
 */
if (!function_exists('azrcrv_populate_plugin_menu_table_atc')){
	function azrcrv_populate_plugin_menu_table_atc(){
		global $wpdb;
		
		$table_name = $wpdb->base_prefix.'azrcrv_plugin_menu';
		
		$plugin_array = array(
			array(
				'plugin_link' => 'azrcrv-add-open-graph-tags/azrcrv-add-open-graph-tags.php',
				'admin_URL' => 'admin.php?page=azrcrv-aogt',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/add-open-graph-tags/',
				'text' => 'Add Open Graph Tags',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-add-twitter-cards/azrcrv-add-twitter-cards.php',
				'admin_URL' => 'admin.php?page=azrcrv-atc',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/',
				'text' => 'Add Twitter Cards',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-avatars/azrcrv-avatars.php',
				'admin_URL' => 'admin.php?page=azrcrv-a',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/avatars/',
				'text' => 'Avatars',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-bbcode/azrcrv-bbcode.php',
				'admin_URL' => 'admin.php?page=azrcrv-bbc',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/bbcode/',
				'text' => 'BBCode',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-breadcrumbs/azrcrv-breadcrumbs.php',
				'admin_URL' => 'admin.php?page=azrcrv-b',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/',
				'text' => 'Breadcrumbs',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-call-out-boxes/azrcrv-call-out-boxes.php',
				'admin_URL' => 'admin.php?page=azrcrv-cob',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/call-out-boxes/',
				'text' => 'Call-out Boxes',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-code/azrcrv-code.php',
				'admin_URL' => 'admin.php?page=azrcrv-c',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/code/',
				'text' => 'Code',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-comment-validator/azrcrv-comment-validator.php',
				'admin_URL' => 'admin.php?page=azrcrv-cv',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/comment-validator/',
				'text' => 'Comment Validator',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-conditional-links/azrcrv-conditional-links.php',
				'admin_URL' => 'admin.php?page=azrcrv-cl',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/',
				'text' => 'Conditional Links',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-display-after-post-content/azrcrv-display-after-post-content.php',
				'admin_URL' => 'admin.php?page=azrcrv-dapc',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/',
				'text' => 'Display After Post Content',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-filtered-categories/azrcrv-filtered-categories.php',
				'admin_URL' => 'admin.php?page=azrcrv-fc',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/',
				'text' => 'Filtered Categories',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-flags/azrcrv-flags.php',
				'admin_URL' => 'admin.php?page=azrcrv-f',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/flags/',
				'text' => 'Flags',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php',
				'admin_URL' => 'admin.php?page=azrcrv-ffi',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/floating-featured-image/',
				'text' => 'Floating Featured Image',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-from-twitter/azrcrv-from-twitter.php',
				'admin_URL' => 'admin.php?page=azrcrv-ft',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/from-twitter/',
				'text' => 'From Twitter',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-icons/azrcrv-icons.php',
				'admin_URL' => 'admin.php?page=azrcrv-i',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/icons/',
				'text' => 'Icons',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-images/azrcrv-images.php',
				'admin_URL' => 'admin.php?page=azrcrv-im',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/images/',
				'text' => 'Images',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-insult-generator/azrcrv-insult-generator.php',
				'admin_URL' => 'admin.php?page=azrcrv-ig',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/insult-generator/',
				'text' => 'Insult Generator',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-loop-injection/azrcrv-loop-injection.php',
				'admin_URL' => 'admin.php?page=azrcrv-li',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/loop-injection/',
				'text' => 'Loop Injection',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-mobile-detection/azrcrv-mobile-detection.php',
				'admin_URL' => 'admin.php?page=azrcrv-md',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/mobile-detection/',
				'text' => 'Mobile Detection',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-multisite-favicon/azrcrv-multisite-favicon.php',
				'admin_URL' => 'admin.php?page=azrcrv-msf',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/multisite-favicon/',
				'text' => 'Multisite Favicon',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-page-index/azrcrv-page-index.php',
				'admin_URL' => 'admin.php?page=azrcrv-pi',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/page-index/',
				'text' => 'Page Index',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-markdown/azrcrv-markdown.php',
				'admin_URL' => 'admin.php?page=azrcrv-m',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/markdown/',
				'text' => 'Markdown',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-post-archive/azrcrv-post-archive.php',
				'admin_URL' => 'admin.php?page=azrcrv-pa',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/post-archive/',
				'text' => 'Post Archive',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-read-github-file/azrcrv-read-github-file.php',
				'admin_URL' => 'admin.php?page=azrcrv-rghf',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/read-github-file/',
				'text' => 'Read GitHub File',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-rss-feed/azrcrv-rss-feed.php',
				'admin_URL' => 'admin.php?page=azrcrv-rssf',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/rss-feed/',
				'text' => 'RSS Feed',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-rss-suffix/azrcrv-rss-suffix.php',
				'admin_URL' => 'admin.php?page=azrcrv-rsss',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/rss-suffix/',
				'text' => 'RSS Suffix',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-series-index/azrcrv-series-index.php',
				'admin_URL' => 'admin.php?page=azrcrv-si',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/series-index/',
				'text' => 'Series Index',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php',
				'admin_URL' => 'admin.php?page=azrcrv-sic',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/',
				'text' => 'Shortcodes in Comments',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php',
				'admin_URL' => 'admin.php?page=azrcrv-siw',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/',
				'text' => 'Shortcodes in Widgets',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-sidebar-login/azrcrv-sidebar-login.php',
				'admin_URL' => 'admin.php?page=azrcrv-sl',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/',
				'text' => 'Sidebar Login',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-tag-cloud/azrcrv-tag-cloud.php',
				'admin_URL' => 'admin.php?page=azrcrv-tc',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/tag-cloud/',
				'text' => 'Tag Cloud',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-taxonomy-index/azrcrv-taxonomy-index.php',
				'admin_URL' => 'admin.php?page=azrcrv-ti',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-index/',
				'text' => 'Taxonomy Index',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-theme-switcher/azrcrv-theme-switcher.php',
				'admin_URL' => 'admin.php?page=azrcrv-ts',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/',
				'text' => 'Theme Switcher',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-timelines/azrcrv-timelines.php',
				'admin_URL' => 'admin.php?page=azrcrv-t',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/timelines/',
				'text' => 'Timelines',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-to-twitter/azrcrv-to-twitter.php',
				'admin_URL' => 'admin.php?page=azrcrv-tt',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/',
				'text' => 'To Twitter',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-toggle-showhide/azrcrv-toggle-showhide.php',
				'admin_URL' => 'admin.php?page=azrcrv-tsh',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/',
				'text' => 'Toggle Show/Hide',
				'retired' => 0
			),
			array(
				'plugin_link' => 'azrcrv-url-shortener/azrcrv-url-shortener.php',
				'admin_URL' => 'admin.php?page=azrcrv-urls',
				'dev_URL' => 'https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/',
				'text' => 'URL Shortener',
				'retired' => 0
			),
		);

		foreach($plugin_array as $plugin_details) {
			$plugin_name = $plugin_details['text'];
			$sql = "SELECT COUNT(ID) FROM ".$table_name." WHERE text = '".$plugin_name."'";
			$rowcount = $wpdb->get_var($sql);
			
			if ($rowcount == 0){
				$wpdb->insert(
					$table_name
					,array(
						'plugin_link' => $plugin_details['plugin_link'],
						'admin_URL' => $plugin_details['admin_URL'],
						'dev_URL' => $plugin_details['dev_URL'],
						'text' => $plugin_details['text'],
					)
					,array(
						'%s'
						,'%s'
						,'%s'
						,'%s'
					)
				);
			}
		}
	}
}

/**
 * Create table on installation.
 *
 * @since 1.0.0
 *
 */
if (!function_exists('azrcrv_create_plugin_menu_table_atc')){
	function azrcrv_create_plugin_menu_table_atc(){
		global $wpdb;
		$table_name = $wpdb->base_prefix.'azrcrv_plugin_menu';

		if($wpdb->get_var("show tables like '{$table_name}'") != $table_name){
			$charset_collate = $wpdb->get_charset_collate();
			
			$sql = "CREATE TABLE ".$table_name." (
						ID INT NOT NULL AUTO_INCREMENT,
						plugin_link VARCHAR(200) NOT NULL,
						admin_URL VARCHAR(200) NOT NULL,
						dev_URL VARCHAR(200) NOT NULL,
						text VARCHAR(200) NOT NULL,
						retired INT,
					PRIMARY KEY (ID),
					UNIQUE INDEX ID_UNIQUE (ID ASC)
					) $charset_collate;";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
}