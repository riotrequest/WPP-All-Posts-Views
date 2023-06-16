<?php
/**
 * Plugin Name: WPP Views Column
 * Description: This plugin adds a views column to the All Posts page in the WordPress admin.
 */

// Check if WordPress Popular Posts plugin is active
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(!is_plugin_active('wordpress-popular-posts/wordpress-popular-posts.php')) {
    function wpp_not_installed_notice() {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e('The <a href="https://wordpress.org/plugins/wordpress-popular-posts/" target="_blank">WordPress Popular Posts</a> plugin must be installed and activated for the WPP Views Column plugin to work.', 'text-domain'); ?></p>
        </div>
        <?php
    }
    add_action('admin_notices', 'wpp_not_installed_notice');
} else {
    add_filter('manage_posts_columns', 'add_views_column');
    function add_views_column($columns) {
        $columns['views'] = 'Views';
        return $columns;
    }

    add_action('manage_posts_custom_column', 'show_views_column_data', 10, 2);
    function show_views_column_data($column_name, $post_id) {
        if ('views' == $column_name) {
            if (function_exists('wpp_get_views')) {
                echo wpp_get_views($post_id);
            }
        }
    }

    add_filter('manage_edit-post_sortable_columns', 'sort_views_column');
    function sort_views_column($columns) {
        $columns['views'] = 'views';
        return $columns;
    }
}
