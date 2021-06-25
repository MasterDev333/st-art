<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<div class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

    <?php
    $is_visible        = $product && $product->is_visible();
    $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
    ?>
    <div>
        <picture class="woocommerce-table__product-image">
            <img src="<?php echo get_the_post_thumbnail_url($product->get_id(), 'medium') ?>">
        </picture>
    </div>

    <div>
        <h4 class="h4 h4--bold woocommerce-table__product-name"><a href="<?php echo $product_permalink ?>"><?php echo $item->get_name() ?></a></h4>
        <a class="woocommerce-table__artist" href="<?php echo get_the_permalink(get_field('artist', $product->get_id())->ID) ?>"><?php echo get_the_title(get_field('artist', $product->get_id())->ID)?></a>
        <p class="woocommerce-table__info">
            <?php foreach ($product->get_category_ids() as $id): ?>
                <?php $termName = get_term_by('term_id', $id, 'product_cat')->name; ?>
                <span><?php echo $termName; ?>,</span>
            <?php endforeach; ?>
            <span><?php
                if($product->get_length()) :
                    echo $product->get_length().get_option( 'woocommerce_dimension_unit' ).' x ';
                endif;
                if($product->get_height()) :
                    echo $product->get_height().get_option( 'woocommerce_dimension_unit' );
                endif;
                ?></span>
        </p>
    </div>

	<div class="woocommerce-table__product-total product-total">
        <?php echo number_format($item->get_total(), 2).get_woocommerce_currency_symbol() ?>
	</div>

</div>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<div class="woocommerce-table__product-purchase-note product-purchase-note">

	<div><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

</div>

<?php endif; ?>
