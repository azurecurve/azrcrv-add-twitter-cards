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
			add_menu_page("azurecurve Plugins"
							,"azurecurve"
							,'manage_options'
							,"azrcrv-plugin-menu"
							,"azrcrv_plugin_menu"
							,plugins_url('/pluginmenu/images/Favicon-16x16.png', __DIR__));
			add_submenu_page("azrcrv-plugin-menu"
								,"Plugins"
								,"Plugins"
								,'manage_options'
								,"azrcrv-plugin-menu"
								,"azrcrv_plugin_menu");
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
		if (is_plugin_active('azrcrv-add-twitter-cards/azrcrv-add-twitter-cards.php')){
			echo "<a href='admin.php?page=azrcrv-a' class='azrcrv-plugin-index'>Add Twitter Cards</a>";
		}
		if (is_plugin_active('azrcrv-avatars/azrcrv-avatars.php')){
			echo "<a href='admin.php?page=azrcrv-a' class='azrcrv-plugin-index'>Avatars</a>";
		}
		if (is_plugin_active('azrcrv-bbcode/azrcrv-bbcode.php')){
			echo "<a href='admin.php?page=azrcrv-bbc' class='azrcrv-plugin-index'>BBCode</a>";
		}
		if (is_plugin_active('azrcrv-breadcrumbs/azrcrv-breadcrumbs.php')){
			echo "<a href='admin.php?page=azrcrv-b' class='azrcrv-plugin-index'>Breadcrumbs</a>";
		}
		if (is_plugin_active('azrcrv-call-out-boxes/azrcrv-call-out-boxes.php')){
			echo "<a href='admin.php?page=azrcrv-cob' class='azrcrv-plugin-index'>Call-out Boxes</a>";
		}
		if (is_plugin_active('azrcrv-code/azrcrv-code.php')){
			echo "<a href='admin.php?page=azrcrv-c' class='azrcrv-plugin-index'>Code</a>";
		}
		if (is_plugin_active('azrcrv-comment-validator/azrcrv-comment-validator.php')){
			echo "<a href='admin.php?page=azrcrv-cv' class='azrcrv-plugin-index'>Comment Validator</a>";
		}
		if (is_plugin_active('azrcrv-conditional-links/azrcrv-conditional-links.php')){
			echo "<a href='admin.php?page=azrcrv-cl' class='azrcrv-plugin-index'>Conditional Links</a>";
		}
		if (is_plugin_active('azrcrv-display-after-post-content/azrcrv-display-after-post-content.php')){
			echo "<a href='admin.php?page=azrcrv-dapc' class='azrcrv-plugin-index'>Display After Post Content</a>";
		}
		if (is_plugin_active('azrcrv-filtered-categories/azrcrv-filtered-categories.php')){
			echo "<a href='admin.php?page=azrcrv-fc' class='azrcrv-plugin-index'>Filtered Categories</a>";
		}
		if (is_plugin_active('azrcrv-flags/azrcrv-flags.php')){
			echo "<a href='admin.php?page=azrcrv-f' class='azrcrv-plugin-index'>Flags</a>";
		}
		if (is_plugin_active('azrcrv-floating-featured-image/azrcrv-floating-featured-image.php')){
			echo "<a href='admin.php?page=azrcrv-ffi' class='azrcrv-plugin-index'>Floating Featured Image</a>";
		}
		if (is_plugin_active('azrcrv-icons/azrcrv-icons.php')){
			echo "<a href='admin.php?page=azrcrv-f' class='azrcrv-plugin-index'>Icons</a>";
		}
		if (is_plugin_active('azrcrv-images/azrcrv-images.php')){
			echo "<a href='admin.php?page=azrcrv-im' class='azrcrv-plugin-index'>Images</a>";
		}
		if (is_plugin_active('azrcrv-insult-generator/azrcrv-insult-generator.php')){
			echo "<a href='admin.php?page=azrcrv-ig' class='azrcrv-plugin-index'>Insult Generator</a>";
		}
		if (is_plugin_active('azrcrv-mobile-detection/azrcrv-mobile-detection.php')){
			echo "<a href='admin.php?page=azrcrv-md' class='azrcrv-plugin-index'>Mobile Detection</a>";
		}
		if (is_plugin_active('azrcrv-multisite-favicon/azrcrv-multisite-favicon.php')){
			echo "<a href='admin.php?page=azrcrv-msf' class='azrcrv-plugin-index'>Multisite Favicon</a>";
		}
		if (is_plugin_active('azrcrv-page-index/azrcrv-page-index.php')){
			echo "<a href='admin.php?page=azrcrv-pi' class='azrcrv-plugin-index'>Page Index</a>";
		}
		if (is_plugin_active('azrcrv-post-archive/azrcrv-post-archive.php')){
			echo "<a href='admin.php?page=azrcrv-pa' class='azrcrv-plugin-index'>Post Archive</a>";
		}
		if (is_plugin_active('azrcrv-rss-feed/azrcrv-rss-feed.php')){
			echo "<a href='admin.php?page=azrcrv-rssf' class='azrcrv-plugin-index'>RSS Feed</a>";
		}
		if (is_plugin_active('azrcrv-rss-suffix/azrcrv-rss-suffix.php')){
			echo "<a href='admin.php?page=azrcrv-rsss' class='azrcrv-plugin-index'>RSS Suffix</a>";
		}
		if (is_plugin_active('azrcrv-series-index/azrcrv-series-index.php')){
			echo "<a href='admin.php?page=azrcrv-si' class='azrcrv-plugin-index'>Series Index</a>";
		}
		if (is_plugin_active('azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php')){
			echo "<a href='admin.php?page=azrcrv-sic' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
		}
		if (is_plugin_active('azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php')){
			echo "<a href='admin.php?page=azrcrv-siw' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
		}
		if (is_plugin_active('azrcrv-sidebar-login/azrcrv-sidebar-login.php')){
			echo "<a href='admin.php?page=azrcrv-sl' class='azrcrv-plugin-index'>Sidebar Login</a>";
		}
		if (is_plugin_active('azrcrv-snippets/azrcrv-snippets.php')){
			echo "<a href='admin.php?page=azrcrv-sl' class='azrcrv-plugin-index'>Snippets</a>";
		}
		if (is_plugin_active('azrcrv-tag-cloud/azrcrv-tag-cloud.php')){
			echo "<a href='admin.php?page=azrcrv-tc' class='azrcrv-plugin-index'>Tag Cloud</a>";
		}
		if (is_plugin_active('azrcrv-taxonomy-index/azrcrv-taxonomy-index.php')){
			echo "<a href='admin.php?page=azrcrv-ti' class='azrcrv-plugin-index'>Taxonomy Index</a>";
		}
		if (is_plugin_active('azrcrv-theme-switcher/azrcrv-theme-switcher.php')){
			echo "<a href='admin.php?page=azrcrv-ts' class='azrcrv-plugin-index'>Theme Switcher</a>";
		}
		if (is_plugin_active('azrcrv-timelines/azrcrv-timelines.php')){
			echo "<a href='admin.php?page=azrcrv-t' class='azrcrv-plugin-index'>Timelines</a>";
		}
		if (is_plugin_active('azrcrv-toggle-showhide/azrcrv-toggle-showhide.php')){
			echo "<a href='admin.php?page=azrcrv-tsh' class='azrcrv-plugin-index'>Toggle Show/Hide</a>";
		}
		if (is_plugin_active('azrcrv-url-shortener/azrcrv-url-shortener.php')){
			echo "<a href='admin.php?page=azrcrv-urls' class='azrcrv-plugin-index'>URL Shortener</a>";
		}
		echo "</span></div>";
		echo "<p style='clear: both' />";
		
		echo "<div style='display: block;'><h3>Other Available Plugins</h3>";
		echo "<span class='azrcrv-plugin-index'>";
		$countofplugins = 0;
		if (!is_plugin_active('azrcrv-add-twitter-cards/azrcrv-add-twitter-cards.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/' class='azrcrv-plugin-index'>Add Twitter Cards</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-avatars/azrcrv-avatars.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/avatars/' class='azrcrv-plugin-index'>Avatars</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-bbcode/azrcrv-bbcode.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/bb-code/' class='azrcrv-plugin-index'>BBCode</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-breadcrumbs/azrcrv-breadcrumbs.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/' class='azrcrv-plugin-index'>Breadcrumbs</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-code/azrcrv-code.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/code/' class='azrcrv-plugin-index'>Code</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-call-out-boxes/azrcrv-call-out-boxes.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/call-out-boxes/' class='azrcrv-plugin-index'>Call-out Boxes</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-comment-validator/azrcrv-comment-validator.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/comment-validator/' class='azrcrv-plugin-index'>Comment Validator</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-conditional-links/azrcrv-conditional-links.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/' class='azrcrv-plugin-index'>Conditional Links</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-display-after-post-content/azrcrv-display-after-post-content.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/' class='azrcrv-plugin-index'>Display After Post Content</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-filtered-categories/azrcrv-filtered-categories.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/' class='azrcrv-plugin-index'>Filtered Categories</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-flags/azrcrv-flags.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/flags/' class='azrcrv-plugin-index'>Flags</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-floating-featured-image/azrcrv-floating-featured-image.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/floating-featured-image/' class='azrcrv-plugin-index'>Floating Featured Image</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-icons/azrcrv-icons.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/icons/' class='azrcrv-plugin-index'>Icons</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-images/azrcrv-images.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/images/' class='azrcrv-plugin-index'>Images</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-insult-generator/azrcrv-insult-generator.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/insult-generator/' class='azrcrv-plugin-index'>Insult Generator</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-mobile-detection/azrcrv-mobile-detection.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/mobile-detection/' class='azrcrv-plugin-index'>Mobile Detection</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-multisite-favicon/azrcrv-multisite-favicon.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/multisite-favicon/' class='azrcrv-plugin-index'>Multisite Favicon</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-page-index/azrcrv-page-index.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/page-index/' class='azrcrv-plugin-index'>Page Index</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-post-archive/azrcrv-post-archive.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/post-archive/' class='azrcrv-plugin-index'>Post Archive</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-rss-feed/azrcrv-rss-feed.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/rss-feed/' class='azrcrv-plugin-index'>RSS Feed</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-rss-suffix/azrcrv-rss-suffix.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/rss-suffix/' class='azrcrv-plugin-index'>RSS Suffix</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-series-index/azrcrv-series-index.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/series-index/' class='azrcrv-plugin-index'>Series Index</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-shortcodes-in-comments/azrcrv-shortcodes-in-comments.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-comments/' class='azrcrv-plugin-index'>Shortcodes in Comments</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-shortcodes-in-widgets/azrcrv-shortcodes-in-widgets.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/shortcodes-in-widgets/' class='azrcrv-plugin-index'>Shortcodes in Widgets</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-sidebar-login/azrcrv-sidebar-login.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/' class='azrcrv-plugin-index'>Sidebar Login</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-snippets/azrcrv-snippets.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/snippets/' class='azrcrv-plugin-index'>Snippets</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-tag-cloud/azrcrv-tag-cloud.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/tag-cloud/' class='azrcrv-plugin-index'>Tag Cloud</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-taxonomy-index/azrcrv-taxonomy-index.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-index/' class='azrcrv-plugin-index'>Taxonomy Index</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-theme-switcher/azrcrv-theme-switcher.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/' class='azrcrv-plugin-index'>Theme Switcher</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-timelines/azrcrv-timelines.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/timelines/' class='azrcrv-plugin-index'>Timelines</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-toggle-showhide/azrcrv-toggle-showhide.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/' class='azrcrv-plugin-index'>Toggle Show/Hide</a>";
			$countofplugins += 1;
		}
		if (!is_plugin_active('azrcrv-url-shortener/azrcrv-url-shortener.php')){
			echo "<a href='https://development.azurecurve.co.uk/classicpress-plugins/url-shortener/' class='azrcrv-plugin-index'>URL Shortener</a>";
			$countofplugins += 1;
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