<?php
// Check that code was called from ClassicPress with uninstallation constant declared
if (! defined('WP_UNINSTALL_PLUGIN')){
	exit;
}

// Options to remove
$options = array(
    'azrcrv-atc'
);

// Remove from single site
if (! is_multisite()){

    foreach ($options as $option){
        delete_option($option);
    }
	
}
// Remove from multi site
else {
    global $wpdb;

    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    $original_blog_id = get_current_blog_id();

    foreach ($blog_ids as $blog_id){
        switch_to_blog($blog_id);

        foreach ($options as $option){
            delete_option($option);
        }
    }

    switch_to_blog($original_blog_id);

	foreach ($options as $option){
		delete_site_option($option);
	}
}
?>