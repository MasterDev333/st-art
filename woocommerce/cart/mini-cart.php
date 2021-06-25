<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
 ?>

<div class="cart">
<div class="woocommerce-mini-cart__header">
    <h4 class="h4 h4--bold woocommerce-mini-cart__title">Cart</h4>
    
    <a href="#" class="woocommerce-mini-cart__close">
        <img src="<?php echo get_template_directory_uri() . '/img/icons/icon_close.svg'; ?>" />
    </a>
</div>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = '<picture><img src="'.get_the_post_thumbnail_url($product_id, 'medium').'"></picture>';
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="woocommerce-mini-cart-item__column">
                        <a class="woocommerce-mini-cart-item__image" href="<?php echo esc_url( $product_permalink ); ?>">
                            <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    </div>
                    <div class="woocommerce-mini-cart-item__column">
                        <a class="woocommerce-mini-cart-item__title h4 h4--bold" href="<?php echo esc_url( $product_permalink ); ?>">
                            <?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                        <a class="woocommerce-mini-cart-item__artist" href="<?php echo get_the_permalink(get_field('artist', $product_id)->ID) ?>"><?php echo get_the_title(get_field('artist', $product_id)->ID)?></a>
                        <p class="woocommerce-mini-cart-item__info">
                        <?php foreach ($_product->get_category_ids() as $id): ?>
                        <?php $termName = get_term_by('term_id', $id, 'product_cat')->name; ?>
                        <span><?php echo $termName; ?>,</span>
                        <?php endforeach; ?>
                        <span><?php
                            if($_product->get_length()) :
                                echo $_product->get_length().get_option( 'woocommerce_dimension_unit' ).' x ';
                            endif;
                            if($_product->get_height()) :
                                echo $_product->get_height().get_option( 'woocommerce_dimension_unit' );
                            endif;
                            ?></span>
                        </p>
                    </div>
                    <div class="woocommerce-mini-cart-item__column">
                        <a
                                href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>"
                                class="remove remove_from_cart_button"
                                aria-label="<?php echo esc_attr__( 'Remove this item', 'woocommerce' ) ?>"
                                data-product_id="<?php echo esc_attr( $product_id ) ?>"
                                data-cart_item_key="<?php echo esc_attr( $cart_item_key ) ?>"
                                data-product_sku="<?php echo esc_attr( $_product->get_sku() ) ?>"
                        >
                            Remove
                        </a>
                        <p class="woocommerce-mini-cart-item__price h4 h4--bold"><?php echo $product_price ?></p>
                    </div>
                </li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>
    <div class="woocommerce-mini-cart__footer">
        <a class="woocommerce-mini-cart__close"><?php get_template_part('partials/svg/link-arrow') ?>Continue Shopping</a>
        <p class="h4 h4--bold woocommerce-mini-cart__total"><?php echo WC()->cart->get_cart_subtotal() ?></p>
        <a href="<?php echo esc_url( wc_get_checkout_url() ) ?>" class="button checkout wc-forward">Go to checkout</a>
    </div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>
</div>

<table class="shop_table woocommerce-checkout-review-order-table">
    <tbody>
    <?php
    do_action( 'woocommerce_review_order_before_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            ?>
            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <td class="product-name">
                    <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </td>
                <td class="product-total">
                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </td>
            </tr>
            <?php
        }
    }

    do_action( 'woocommerce_review_order_after_cart_contents' );
    ?>
    </tbody>
    <tfoot>

    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
            <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

        <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

    <?php endif; ?>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <tr class="fee">
            <th><?php echo esc_html( $fee->name ); ?></th>
            <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
        <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
            <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <th><?php echo esc_html( $tax->label ); ?></th>
                    <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr class="tax-total">
                <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                <td><?php wc_cart_totals_taxes_total_html(); ?></td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>

    <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

    <tr class="order-total">
        <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
        <td><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

    <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

    </tfoot>
</table>


<script type="text/javascript">
    jQuery('.woocommerce-mini-cart__close').click(function (e) {
        e.preventDefault();
        jQuery('.cart-wrapper').removeClass('open');
        jQuery('body').removeClass('no-scroll');
    })

    jQuery('.cart-wrapper').click(function (e) {
        var div = jQuery('.widget_shopping_cart_content');
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            jQuery('.cart-wrapper').removeClass('open');
            jQuery('body').removeClass('no-scroll');
        }
    })

    jQuery('.woocommerce-remove-coupon').empty().append('-')
</script>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>