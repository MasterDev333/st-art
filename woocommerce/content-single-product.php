<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
//do_action( 'woocommerce_before_single_product' );

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

        <div class="product__top">
            <?php
            $post_thumbnail_id = $product->get_image_id();
            ?>
            <div class="product__image-wrapper">
                <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0] ?: esc_url(wc_placeholder_img_src('woocommerce_single'));
                $width = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[1] ?: 754;
                $height = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[2] ?: 754;
                ?>
                <a href="<?php echo $image ?>" class="MagicZoom"
                   data-options="zoomMode: magnifier;cssClass: mz-square; expand: off;">
                    <picture class="product__image">
                        <img class="product__image-img no-lazyloading" width="<?php echo $width ?>" height="<?php echo $height ?>"
                             src="<?php echo $image ?>">
                    </picture>
                </a>
            </div>
            <div>
                <h1 class="product__title h3"><?php echo get_the_title() ?></h1>
                <a class="product__artist h4 h4--bold"
                   href="<?php echo get_the_permalink(get_field('artist')->ID) ?>"><?php echo get_the_title(get_field('artist')->ID) ?></a>
                <div class="product__categories">
                    <?php $is_sculpture = false;
                    foreach ($product->get_category_ids() as $id): ?>
                        <?php $termName = get_term_by('term_id', $id, 'product_cat')->name;
                        if ($termName === 'Sculpture'): $is_sculpture = true; endif; ?>
                        <?php if (get_term_by('term_id', $id, 'product_cat')->parent === 0): ?>
                            <div class="category parent-category">
                                <?php echo $termName; ?>
                            </div>
                            <span class="seperator">,&nbsp;</span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="product__image-wrapper product__image-wrapper--mobile">
                    <picture class="product__image">
                        <?php
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0] ?: esc_url(wc_placeholder_img_src('woocommerce_single'));
                        $width = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[1] ?: 754;
                        $height = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[2] ?: 754;
                        ?>
                        <img class="product__image-img" width="<?php echo $width ?>" height="<?php echo $height ?>"
                             src="<?php echo $image ?>">
                    </picture>
                </div>
                <?php if ($product->is_in_stock()) : ?>
                    <p class="product__price h4 h4--bold"><?php echo $product->get_price_html(); ?></p>
                <?php endif; ?>
                <?php if (!$is_sculpture): ?>
                    <a href="#room_view" class="h4 product__view-link">View it in a room</a>
                <?php endif; ?>
                <?php if ($product->is_in_stock()) : ?>
                    <form class="cart product__buy"
                          action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                          method="post" enctype='multipart/form-data'>
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                                class="single_add_to_cart_button alt">Buy it now
                        </button>
                    </form>
                    <div class="product__rent">
                         <?php if (get_field('rent_text', 'options')): ?>
                            <p><?php echo get_field('rent_text', 'options') ?>
                                                            <?php echo bcdiv(floatval($product->get_price()) - (floatval($product->get_price()) / 100 * floatval(get_field('rent_percent', 'options')) ),1,2);  ?>€/<span class="d-sm-none">month</span><span class="d-sm-block">m</span>

                            </p>
                        <?php endif; ?>
                        <?php if (get_field('rent_link_text', 'options')): ?>
                            <a href="<?php echo get_field('rent_link', 'options') ?>" target="_blank">
                                <?php echo get_field('rent_link_text', 'options') ?><?php get_template_part('partials/svg/link-arrow') ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="sold-out-button__wrapper">
                        <div class="sold-out-button">Sold</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="product__bottom">
            <div class="product__information">
                <div class="product__info-col">
                    <p>Dimensions:</p>
                    <p><?php
                        if ($product->get_length()) :
                            echo $product->get_length() . get_option('woocommerce_dimension_unit') . ' x ';
                        endif;
                        if ($product->get_height()) :
                            echo $product->get_height() . get_option('woocommerce_dimension_unit');
                        endif;
                        ?></p>
                    <?php if (get_field('year')) : ?>
                        <p>Year:</p>
                        <p><?php echo get_field('year'); ?></p>
                    <?php endif; ?>
                    <?php if (get_field('frame')) : ?>
                        <p>Frame:</p>
                        <p><?php echo get_field('frame'); ?></p>
                    <?php endif; ?>
                    <?php
                    $attributes = $product->get_attribute('pa_technique');
                    if ($attributes):?>
                        <p>Technique:</p>
                        <p><?php echo $attributes ?></p>
                    <?php endif; ?>
                </div>
                <div class="product__info-col product__info-col--mobile-wrap">
                    <?php if (get_the_content()) : ?>
                        <p>Description:</p>
                        <div><?php echo get_the_content() ?></div>
                    <?php endif ?>
                </div>
            </div>
            <?php if (!$is_sculpture): ?>
                <div class="product__compare">
                    <div class="product__compare-image">
                        <img class="placeholder" src="<?php echo get_template_directory_uri() ?>/img/compare-image.png">
                        <?php if (wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')): ?>
                            <img
                                    class="picture"
                                    src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0]; ?>"
                                    style="
                                            width: <?php echo 100 * $product->get_length() / 611 ?>%;
                                            height: <?php echo 100 * $product->get_height() / 471 ?>%;
                                            "
                            >
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php do_action('woocommerce_after_single_product'); ?>