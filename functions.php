<?php
/**
 * Theme functions and definitions
 */

 if ( ! function_exists( 'theme_setup' ) ) :
 /**
  * Sets up theme defaults and registers support for various WordPress features.
  *
  * Note that this function is hooked into the after_setup_theme hook, which
  * runs before the init hook. The init hook is too late for some features, such
  * as indicating support for post thumbnails.
  */
 function theme_setup() {
 	// Add default posts and comments RSS feed links to head.
 	add_theme_support( 'automatic-feed-links' );

 	/*
 	 * Let WordPress manage the document title.
 	 * By adding theme support, we declare that this theme does not use a
 	 * hard-coded <title> tag in the document head, and expect WordPress to
 	 * provide it for us.
 	 */
 	add_theme_support( 'title-tag' );

 	/*
 	 * Enable support for Post Thumbnails on posts and pages.
 	 *
 	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 	 */
 	add_theme_support( 'post-thumbnails' );

     if( function_exists('acf_add_options_page') ) {
         acf_add_options_page();
     }

  // Enable custom menus
  // =======================
  add_theme_support( 'menus' );

 	// This theme uses wp_nav_menu() in one location.
 	register_nav_menus( array(
    // Example
 		//'header-main-menu' => esc_html__( 'Main Menu', 'ben-theme' ),
        'header-menu' => esc_html__( 'Header Menu' ),
        'footer-first-menu' => esc_html__( 'Footer First Menu' ),
        'footer-second-menu' => esc_html__( 'Footer Second Menu' ),
        'blog-menu' => esc_html__( 'Blog Menu' ),
 	) );

 	/*
 	 * Switch default core markup for search form, comment form, and comments
 	 * to output valid HTML5.
 	 */
 	add_theme_support( 'html5', array(
 		'search-form',
 		'comment-form',
 		'comment-list',
 		'gallery',
 		'caption',
 	) );

 	// Add theme support for selective refresh for widgets.
 	add_theme_support( 'customize-selective-refresh-widgets' );

 	add_theme_support( 'woocommerce' );

 	add_theme_support( 'custom-logo' );

 	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
 }
 endif;
 add_action( 'after_setup_theme', 'theme_setup' );


 // Adds CSS
 // ============
 function theme_styles() {
   // Example with external URL
   // wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
   // Example with internal file
     wp_enqueue_style( 'zoomCSS', get_template_directory_uri() . '/css/vendor/magiczoomplus.css' );
     wp_enqueue_style( 'sliderCSS', get_template_directory_uri() . '/css/vendor/jquery-ui.css' );
     wp_enqueue_style( 'selectCSS', get_template_directory_uri() . '/css/vendor/select2.min.css' );
     wp_enqueue_style( 'mainCSS', get_template_directory_uri() . '/css/main.css' );
   	 wp_enqueue_style( 'themeCSS', get_template_directory_uri() . '/style.css' );
 }
 add_action( 'wp_enqueue_scripts', 'theme_styles');
 
// Update CSS within in Admin
function admin_style() {
   wp_enqueue_style( 'adminCSS', get_template_directory_uri() . '/css/admin-style.css' );
}
add_action('admin_enqueue_scripts', 'admin_style');

 // Adds JS
 // ==========
 function theme_js() {
   // Example with external URL
   // wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);
   // Example with internal file
     global $wp_query;
     wp_enqueue_script( 'zoomJS', get_template_directory_uri() . '/js/vendor/magiczoomplus.js', array('jquery'), '', true);
     wp_enqueue_script( 'sliderJS', get_template_directory_uri() . '/js/vendor/jquery-ui.min.js', array('jquery'), '', true);
     wp_enqueue_script( 'selectJS', get_template_directory_uri() . '/js/vendor/select2.full.min.js', array('jquery'), '', true);
     wp_enqueue_script( 'slickJS', get_template_directory_uri() . '/js/vendor/slick.min.js', array('jquery'), '', true);
     wp_enqueue_script( 'animeJS', get_template_directory_uri() . '/js/vendor/anime.min.js', array('jquery'), '', true);
     wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/js/main.js', array('jquery'), '10.3', true);

     wp_localize_script( 'jquery', 'ajaxObject',
         array(
             'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
             'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
             'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
             'max_page' => $wp_query->max_num_pages,
         )
     );
 }
 add_action( 'wp_enqueue_scripts', 'theme_js');

// Implement Additional files
//==========
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Custom Taxonomies file
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
* Load Custom Posts file
*/
require get_template_directory() . '/inc/custom-posts.php';

/**
 * Load Custom Blocks file
 */
require get_template_directory() . '/inc/custom-blocks.php';

/**
* Where to edit login page and dashboard logo
*/
require get_template_directory() . '/inc/theme-appearance.php';


add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
  return  'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; // relative to you theme images folder
}

/**
 * Changing 'Province' field at woocommerce checkout to unrequired
 * https://stackoverflow.com/questions/36556874/how-to-make-province-field-unrequired-in-woocommerce-checkout-page
 */

add_filter( 'woocommerce_billing_fields', 'wc_cf_filter_state', 10, 1 );

function wc_cf_filter_state( $fields ) {
    $fields ['billing_state']['required'] = false;
    return $fields ;
}