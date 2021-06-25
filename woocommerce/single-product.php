<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<main class="main">
    <?php get_template_part('partials/back-link', '', ['link' => get_permalink( woocommerce_get_page_id( 'shop' ) )]) ?>
	<section class="single-product">
		<div class="container container--padding">
			<div class="single-product__inner">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile;?>
			</div>
		</div>
	</section>
    <?php
	$artist = get_field('artist')->ID;
	$query = new Wp_Query([
		'post_type' => 'product',
		'post_status' => 'publish',
		'meta_key' => 'artist',
		'meta_value' => $artist,
		'meta_compare' => '===',
	]);
    if ($query->have_posts() && $query->post_count > 1) {
        get_template_part('partials/related-posts', '', 
			[
			'title' => 'More From ' . get_the_title(get_field('artist')->ID),
			'posts' => $query,
			'type' => 'artworks'
			]
		);
	};
    ?>
</main>


<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */