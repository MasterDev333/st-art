<?php
/**
 * Custom posts for use with this theme
 *
 *
 */

add_action('init', 'register_post_types');
function register_post_types()
{
  register_post_type('artists', [
    'label' => null,
    'labels' => [
      'name' => 'Artists',
      'singular_name' => 'Artist',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Artist',
      'edit_item' => 'Edit Artist',
      'new_item' => 'New Artist',
      'view_item' => 'View Artist',
      'search_items' => 'Search Artist',
      'not_found' => 'No artists found.',
      'not_found_in_trash' => 'No artists found in Trash.',
      'parent_item_colon' => '',
      'menu_name' => 'Artists',
    ],
    'description' => '',
    'public' => true,
    // 'publicly_queryable'  => null,
    // 'exclude_from_search' => null,
    // 'show_ui'             => null,
    // 'show_in_nav_menus'   => null,
    'show_in_menu' => null,
    // 'show_in_admin_bar'   => null,
    'show_in_rest' => false,
    'rest_base' => null,
    'menu_position' => null,
    'menu_icon' => null,
    //'capability_type'   => 'post',
    //'capabilities'      => 'post',
    //'map_meta_cap'      => null,
    'hierarchical' => false,
    'supports' => ['title', 'editor', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => ['artist_cat'],
    'has_archive' => true,
    'rewrite' => true,
    'query_var' => true,
  ]);

  register_post_type('team', [
    'label' => null,
    'labels' => [
      'name' => 'Team',
      'singular_name' => 'Teammate',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Teammate',
      'edit_item' => 'Edit Teammate',
      'new_item' => 'New Teammate',
      'view_item' => 'View Teammate',
      'search_items' => 'Search Teammate',
      'not_found' => 'No artists found.',
      'not_found_in_trash' => 'No teammates found in Trash.',
      'parent_item_colon' => '',
      'menu_name' => 'Team',
    ],
    'description' => '',
    'public' => true,
    // 'publicly_queryable'  => null,
     'exclude_from_search' => true,
    // 'show_ui'             => null,
    // 'show_in_nav_menus'   => null,
    'show_in_menu' => null,
    // 'show_in_admin_bar'   => null,
    'show_in_rest' => false,
    'rest_base' => null,
    'menu_position' => null,
    'menu_icon' => null,
    //'capability_type'   => 'post',
    //'capabilities'      => 'post',
    //'map_meta_cap'      => null,
    'hierarchical' => false,
    'supports' => ['title', 'editor', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    // 'taxonomies' => ['artist_cat'],
    'has_archive' => true,
    'rewrite' => true,
    'query_var' => true,
  ]);
}