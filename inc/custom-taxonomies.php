<?php
/**
 * Custom taxonomies for use with this theme
 *
 *
 */

add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

    register_taxonomy( 'artist_cat', [ 'artists' ], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Artist Categories',
            'singular_name'     => 'Artist Category',
            'search_items'      => 'Search Artist Categories',
            'all_items'         => 'All Artist Categories',
            'view_item '        => 'View Artist Category',
            'parent_item'       => 'Parent Artist Category',
            'parent_item_colon' => 'Parent Artist Category:',
            'edit_item'         => 'Edit Artist Category',
            'update_item'       => 'Update Artist Category',
            'add_new_item'      => 'Add Artist Category',
            'new_item_name'     => 'New Artist Category',
            'menu_name'         => 'Artist Category',
        ],
        'description'           => '',
        'public'                => true,
        // 'publicly_queryable'    => null,
        // 'show_in_nav_menus'     => true,
        // 'show_ui'               => true,
        // 'show_in_menu'          => true,
        // 'show_tagcloud'         => true,
        // 'show_in_quick_edit'    => null,
        'hierarchical'          => true,

        'rewrite'               => true,
        //'query_var'             => $taxonomy,
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => null,
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ] );

}
