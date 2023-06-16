<?php
/**
 * Plugin Name: WPP Views Column
 * Description: This plugin adds a views column to the All Posts page in the WordPress admin.
 */

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
