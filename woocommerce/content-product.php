<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$product = wc_get_product();
?>

<div <?php wc_product_class( 'product-card', $product ); ?>>

    <div class="product-card__wrapper">
        <a class="product-card__image" href="<?php echo get_permalink()?>">
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id())) ?>
            <img width="<?php echo $image ? $image[1] : 220?>" height="<?php echo $image ? $image[2] : 220?>" src="<?php echo get_the_post_thumbnail_url($product->get_id()) ? get_the_post_thumbnail_url($product->get_id()) : esc_url( wc_placeholder_img_src( 'woocommerce_single' ))?>"  alt="product-image">
            <?php if(!$product->is_in_stock()) : ?>
                <div class="product-card__image-label">Sold</div>
            <?php endif; ?>
        </a>
    </div>
    <div class="product-card__content">
        <h4 class="h4 h4--bold product-card__title">
            <a class="product-card__title-link" href="<?php echo get_permalink()?>">
                <?php echo get_the_title() ?>
            </a>
        </h4>
        <p class="product-card__artist"><a class="product-card__artist-link" href="<?php echo get_the_permalink(get_field('artist')->ID) ?>"><?php echo get_the_title(get_field('artist')->ID)?></a></p>
        <p class="product-card__price"><?php echo $product->get_price_html(); ?></p>
    </div>
</div>
