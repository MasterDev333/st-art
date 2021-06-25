<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_checkout_form', $checkout );
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="woocommerce-checkout__column">
        <div class="woocommerce-billing-fields">
            <h4 class="h4 h4--bold">Contact Information</h4>
            <div class="woocommerce-billing-fields__field-wrapper">
            <?php
                $fields = $checkout->get_checkout_fields( 'billing' );

                foreach ( $fields as $key => $field ) {
                    //var_dump($key);
                    if($key == 'billing_first_name' || $key == 'billing_last_name' || $key == 'billing_phone' || $key == 'billing_email') {
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                    }
                }
            ?>
            </div>
        </div>
        <div class="woocommerce-shipping-fields">
            <h4 class="h4 h4--bold">Address</h4>
            <div class="woocommerce-shipping-fields__field-wrapper">
                <?php
                $fields = $checkout->get_checkout_fields( 'shipping' );

                foreach ( $fields as $key => $field ) {
                    //var_dump($key);
                    if($key == 'shipping_country' || $key == 'shipping_address_1' || $key == 'shipping_address_2' || $key == 'shipping_city' || $key == 'shipping_postcode') {
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                    }

                }
                ?>
            </div>
        </div>

        <?php woocommerce_checkout_payment() ?>

        <div class="woocommerce-billing-fields">
            <h4 class="h4 h4--bold">Billing Address</h4>
            <div class="change-billing-address">
                <div class="change-billing-address__input">
                    <input type="radio" name="billing" id="billing_1" value="same"><label for="billing_1">Same as shipping address</label>
                </div>
                <div class="change-billing-address__input">
                    <input type="radio" name="billing" value="new" id="billing_2" checked><label for="billing_2">Use a different billing address</label>
                </div>
            </div>
            <div class="woocommerce-billing-fields__field-wrapper">
            <?php
            $fields = $checkout->get_checkout_fields( 'billing' );

            foreach ( $fields as $key => $field ) {
                //var_dump($key);
                if($key == 'billing_country' || $key == 'billing_address_1' || $key == 'billing_address_2' || $key == 'billing_city' || $key == 'billing_postcode') {
                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                }
            }
            ?>
            </div>
        </div>
        <div class="woocommerce-rememberme">
            <h4 class="h4 h4--bold">Remember me</h4>
            <div class="woocommerce-rememberme__field">
                <input class="form-checkbox woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                <label class="" for="rememberme">Save my information for fastest checkout</label>
            </div>
        </div>
        <div class="woocommerce-additional-fields">
            <h4 class="h4 h4--bold">Additional Information</h4>
            <div class="woocommerce-additional-fields__field-wrapper">
                <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
	<div class="woocommerce-checkout__order-column">
        <div class="woocommerce-checkout__order-block">
            <h4 id="order_review_heading" class="h4 h4--bold ">Your order</h4>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <div class="widget_shopping_cart_content"></div>
            </div>
            <div class="form-row place-order">
                <a href="#" class="place-order__cart-link"><?php get_template_part('partials/svg/link-arrow') ?>Return to cart</a>
                <noscript>
                    Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                    <br/>
                    <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                </noscript>

                <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>
                <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>

            </div>
        </div>

    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>