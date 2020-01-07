<?php

/*

Menu Version 1.0

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
		echo "<h3>azurecurve ClassicPress Plugins</h3>";
		
		echo "<div style='display: block;'><h3>Active Plugins</h3>";
		echo "<span class='azrcrv-plugin-index'>";

		$plugin_array = array(
			array(
				'plugin_link' => 'azrcrv-add-twitter-cards/azrcrv-add-twitter-cards.php',
				'admin_URL'=> 'admin.php?page=azrcrv-atc',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/',
				'text' => 'Add Twitter Cards'
			),
			array(
				'plugin_link' => 'azrcrv-avatars/azrcrv-avatars.php',
				'admin_URL'=> 'admin.php?page=azrcrv-a',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/avatars/',
				'text' => 'Avatars'
			),
			array(
				'plugin_link' => 'azrcrv-bbcode/azrcrv-bbcode.php',
				'admin_URL'=> 'admin.php?page=azrcrv-bbc',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/bbcode/',
				'text' => 'BBCode'
			),
			array(
				'plugin_link' => 'azrcrv-breadcrumbs/azrcrv-breadcrumbs.php',
				'admin_URL'=> 'admin.php?page=azrcrv-b',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/',
				'text' => 'Breadcrumbs'
			),
			array(
				'plugin_link' => 'azrcrv-call-out-boxes/azrcrv-call-out-boxes.php',
				'admin_URL'=> 'admin.php?page=azrcrv-cob',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/call-out-boxes/',
				'text' => 'Call-out Boxes'
			),
			array(
				'plugin_link' => 'azrcrv-code/azrcrv-code.php',
				'admin_URL'=> 'admin.php?page=azrcrv-c',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/code/',
				'text' => 'Code'
			),
			array(
				'plugin_link' => 'azrcrv-comment-validator/azrcrv-comment-validator.php',
				'admin_URL'=> 'admin.php?page=azrcrv-cv',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/comment-validator/',
				'text' => 'Comment Validator'
			),
			array(
				'plugin_link' => 'azrcrv-conditional-links/azrcrv-conditional-links.php',
				'admin_URL'=> 'admin.php?page=azrcrv-cl',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/',
				'text' => 'Conditional Links'
			),
			array(
				'plugin_link' => 'azrcrv-display-after-post-content/azrcrv-display-after-post-content.php',
				'admin_URL'=> 'admin.php?page=azrcrv-dapc',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/',
				'text' => 'Display After Post Content'
			),
			array(
				'plugin_link' => 'azrcrv-filtered-categories/azrcrv-filtered-categories.php',
				'admin_URL'=> 'admin.php?page=azrcrv-fc',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/',
				'text' => 'Filtered Categories'
			),
			array(
				'plugin_link' => 'azrcrv-flags/azrcrv-flags.php',
				'admin_URL'=> 'admin.php?page=azrcrv-f',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/flags/',
				'text' => 'Flags'
			),
			array(
				'plugin_link' => 'azrcrv-floating-featured-image/azrcrv-floating-featured-image.php',
				'admin_URL'=> 'admin.php?page=azrcrv-ffi',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/floating-featured-image/',
				'text' => 'Floating Featured Image'
			),
			array(
				'plugin_link' => 'azrcrv-icons/azrcrv-icons.php',
				'admin_URL'=> 'admin.php?page=azrcrv-i',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/icons/',
				'text' => 'Icons'
			),
			array(
				'plugin_link' => 'azrcrv-images/azrcrv-images.php',
				'admin_URL'=> 'admin.php?page=azrcrv-im',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/images/',
				'text' => 'Images'
			),
			array(
				'plugin_link' => 'azrcrv-insult-generator/azrcrv-insult-generator.php',
				'admin_URL'=> 'admin.php?page=azrcrv-ig',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/insult-generator/',
				'text' => 'Insult Generator'
			),
			array(
				'plugin_link' => 'azrcrv-loop-injection/azrcrv-loop-injection.php',
				'admin_URL'=> 'admin.php?page=azrcrv-li',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/loop-injection/',
				'text' => 'Loop Injection'
			),
			array(
				'plugin_link' => 'azrcrv-mobile-detection/azrcrv-mobile-detection.php',
				'admin_URL'=> 'admin.php?page=azrcrv-md',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/mobile-detection/',
				'text' => 'Mobile Detection'
			),
			array(
				'plugin_link' => 'azrcrv-multisite-favicon/azrcrv-multisite-favicon.php',
				'admin_URL'=> 'admin.php?page=azrcrv-msf',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/multisite-favicon/',
				'text' => 'Multisite Favicon'
			),
			array(
				'plugin_link' => 'azrcrv-page-index/azrcrv-page-index.php',
				'admin_URL'=> 'admin.php?page=azrcrv-pi',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/page-index/',
				'text' => 'Page Index'
			),
			array(
				'plugin_link' => 'azrcrv-post-archive/azrcrv-post-archive.php',
				'admin_URL'=> 'admin.php?page=azrcrv-pa',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/post-archive/',
				'text' => 'Post Archive'
			),
			array(
				'plugin_link' => 'azrcrv-rss-feed/azrcrv-rss-feed.php',
				'admin_URL'=> 'admin.php?page=azrcrv-rssf',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/rss-feed/',
				'text' => 'RSS Feed'
			),
			array(
				'plugin_link' => 'azrcrv-rss-suffix/azrcrv-rss-suffix.php',
				'admin_URL'=> 'admin.php?page=azrcrv-rsss',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/rss-suffix/',
				'text' => 'RSS Suffix'
			),
			array(
				'plugin_link' => 'azrcrv-series-index/azrcrv-series-index.php',
				'admin_URL'=> 'admin.php?page=azrcrv-si',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/series-index/',
				'text' => 'Series Index'
			),
			array(
				'plugin_link' => 'azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php',
				'admin_URL'=> 'admin.php?page=azrcrv-sic',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/',
				'text' => 'Shortcodes in Comments'
			),
			array(
				'plugin_link' => 'azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php',
				'admin_URL'=> 'admin.php?page=azrcrv-siw',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/',
				'text' => 'Shortcodes in Widgets'
			),
			array(
				'plugin_link' => 'azrcrv-sidebar-login/azrcrv-sidebar-login.php',
				'admin_URL'=> 'admin.php?page=azrcrv-sl',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/',
				'text' => 'Sidebar Login'
			),
			array(
				'plugin_link' => 'azrcrv-snippets/azrcrv-snippets.php',
				'admin_URL'=> 'admin.php?page=azrcrv-s',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/snippets/',
				'text' => 'Snippets'
			),
			array(
				'plugin_link' => 'azrcrv-social-sharing/azrcrv-social-sharing.php',
				'admin_URL'=> 'admin.php?page=azrcrv-ss',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/social-sharing/',
				'text' => 'Social Sharing'
			),
			array(
				'plugin_link' => 'azrcrv-tag-cloud/azrcrv-tag-cloud.php',
				'admin_URL'=> 'admin.php?page=azrcrv-tc',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/tag-cloud/',
				'text' => 'Tag Cloud'
			),
			array(
				'plugin_link' => 'azrcrv-taxonomy-index/azrcrv-taxonomy-index.php',
				'admin_URL'=> 'admin.php?page=azrcrv-ti',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-index/',
				'text' => 'Taxonomy Index'
			),
			array(
				'plugin_link' => 'azrcrv-theme-switcher/azrcrv-theme-switcher.php',
				'admin_URL'=> 'admin.php?page=azrcrv-ts',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/',
				'text' => 'Theme Switcher'
			),
			array(
				'plugin_link' => 'azrcrv-timelines/azrcrv-timelines.php',
				'admin_URL'=> 'admin.php?page=azrcrv-t',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/timelines/',
				'text' => 'Timelines'
			),
			array(
				'plugin_link' => 'azrcrv-toggle-showhide/azrcrv-toggle-showhide.php',
				'admin_URL'=> 'admin.php?page=azrcrv-tsh',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/',
				'text' => 'Toggle Show/Hide'
			),
			array(
				'plugin_link' => 'azrcrv-url-shortener/azrcrv-url-shortener.php',
				'admin_URL'=> 'admin.php?page=azrcrv-urls',
				'dev_URL'=> 'https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/',
				'text' => 'URL Shortener'
			),
		);

		foreach($plugin_array as $plugin_details) {
			if (is_plugin_active($plugin_details['plugin_link'])){
				echo '<a href="' . $plugin_details['admin_URL'] . '" class="azrcrv-plugin-index">' . $plugin_details['text'] . '</a>';
			}
		}
		
		echo "</span></div>";
		echo "<p style='clear: both' />";
		
		echo "<div style='display: block;'><h3>Other Available Plugins</h3>";
		echo "<span class='azrcrv-plugin-index'>";

		$countofplugins = 0;

		foreach($plugin_array as $pluginItem) {
			if (!is_plugin_active($pluginItem['plugin_link'])){
				echo '<a href="' . $pluginItem['dev_URL'] . '" class="azrcrv-plugin-index">' . $pluginItem['text'] . '</a>';
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

?>