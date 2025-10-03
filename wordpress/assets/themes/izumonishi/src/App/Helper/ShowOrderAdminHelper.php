<?php declare(strict_types=1);
/**
 * Add a "順序" column to the admin list for the front_works post type
 */
add_filter('manage_edit-front_works_columns', 'add_front_works_menu_order_column');
function add_front_works_menu_order_column($columns)
{
    // Build a new array to control the exact column order
    $new_columns = [];

    // Loop through existing columns
    foreach ($columns as $key => $value) {
        // Add the current column to the new array
        $new_columns[$key] = $value;

        // If the current column is 'title', insert 'menu_order' **after** it
        if ('title' === $key) {
            $new_columns['menu_order'] = '順序';
        }
    }

    return $new_columns;
}

/**
 * Output the menu_order value in the custom column
 */
add_action('manage_front_works_posts_custom_column', 'show_front_works_menu_order_column', 10, 2);
function show_front_works_menu_order_column($column, $post_id)
{
    if ('menu_order' === $column) {
        echo (int) get_post_field('menu_order', $post_id);
    }
}

/**
 * 3. Make '順序' (menu_order) column sortable
 */
add_filter('manage_edit-front_works_sortable_columns', 'front_works_menu_order_sortable_column');
function front_works_menu_order_sortable_column($columns)
{
    $columns['menu_order'] = 'menu_order';
    return $columns;
}

/**
 * 4. Handle sort request by 'menu_order'
 */
add_action('pre_get_posts', 'sort_front_works_by_menu_order');
function sort_front_works_by_menu_order($query)
{
    // Must be in admin & main query
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    // Check if we’re ordering by 'menu_order'
    if ($query->get('orderby') === 'menu_order') {
        // Force orderby
        $query->set('orderby', 'menu_order');

        // You can let WP pick ASC or DESC from the URL, e.g.:
        // $query->set('order', $query->get('order') === 'desc' ? 'DESC' : 'ASC');

        // Or always force ASC:
        $query->set('order', 'ASC');
    }
}


