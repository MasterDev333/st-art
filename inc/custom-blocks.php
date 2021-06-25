<?php
/**
 * Custom blocks for use with this theme
 *
 *
 */

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'Follow Us',
            'title'             => __('Follow us'),
            'description'       => __('follow us'),
            'render_template'   => 'partials/follow-us/follow-us.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'follow', 'social', 'instagram', 'twitter' ),
        ));

        acf_register_block_type(array(
            'name'              => 'full-width-image',
            'title'             => __('Full Width Image'),
            'description'       => __('full width image'),
            'render_template'   => 'partials/full-width-image/full-width-image.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'image', 'full', 'width' ),
        ));

        acf_register_block_type(array(
            'name'              => 'two-columns-content',
            'title'             => __('Two Columns Content'),
            'description'       => __('Content block with two columns'),
            'render_template'   => 'partials/two-columns-content/two-columns-content.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'two', 'columns' ),
        ));

        acf_register_block_type(array(
            'name'              => 'animated-line-content',
            'title'             => __('Animated Line Content'),
            'description'       => __('Content block with simple line draw animation.'),
            'render_template'   => 'partials/animation-line-content/animation-line-content.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'animation', 'content' ),
        ));

        acf_register_block_type(array(
            'name'              => 'cta-carousel',
            'title'             => __('CTA Carousel'),
            'description'       => __('A call to action carousel block.'),
            'render_template'   => 'partials/cta-carousel/cta-carousel.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'cta', 'carousel' ),
        ));

        acf_register_block_type(array(
            'name'              => 'custom-gallery',
            'title'             => __('Custom Gallery'),
            'description'       => __('A custom gallery block.'),
            'render_template'   => 'partials/custom-gallery/gallery-block.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'gallery' ),
        ));

        acf_register_block_type(array(
          'name'              => 'block-info',
          'title'             => __('Custom Info'),
          'description'       => __('A custom info block.'),
          'render_template'   => 'partials/custom-info/info-block.php',
          'category'          => 'formatting',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'info' ),
        ));

        acf_register_block_type(array(
          'name'              => 'latest-news',
          'title'             => __('Latest News'),
          'description'       => __('A custom latest news block.'),
          'render_template'   => 'partials/latest-news/latest-news-block.php',
          'category'          => 'formatting',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'news' ),
        ));

        acf_register_block_type(array(
          'name'              => 'curators-selection',
          'title'             => __('Curators Selection'),
          'description'       => __('A custom latest curators selection block.'),
          'render_template'   => 'partials/curators-selection/curators-selection-block.php',
          'category'          => 'formatting',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'curators-selection' ),
        ));

        acf_register_block_type(array(
          'name'              => 'discover-our-media',
          'title'             => __('Discover our Media'),
          'description'       => __('A custom latest discover-our-media block.'),
          'render_template'   => 'partials/discover-our-media/discover-our-media-block.php',
          'category'          => 'formatting',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'discover-our-media' ),
        ));

        acf_register_block_type(array(
          'name'              => 'featured-artists',
          'title'             => __('Featured Artists'),
          'description'       => __('A custom latest featured artists block.'),
          'render_template'   => 'partials/featured-artists/featured-artists-block.php',
          'category'          => 'formatting',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'featured-artists' ),
        ));

      acf_register_block_type(array(
        'name'              => 'video-tutorials',
        'title'             => __('Video Tutorials'),
        'description'       => __('A custom latest video tutorials block.'),
        'render_template'   => 'partials/video-tutorials/video-tutorials-block.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'video-tutorials' ),
      ));
    }
}