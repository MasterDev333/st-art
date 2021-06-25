<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ben_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'theme_body_classes' );

/**
 * Disable Editor
 *
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {
    $excluded_templates = array(
        'template-blog.php',
    );

    $excluded_ids = array(
        woocommerce_get_page_id( 'shop' ),
    );
    if( empty( $id ) )
        return false;
    $id = intval( $id );
    $template = get_page_template_slug( $id );
    return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}
/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {
    if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
        return $can_edit;
    if( ea_disable_editor( $_GET['post'] ) )
        $can_edit = false;
    return $can_edit;
}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );


add_action('wp_ajax_reloadArtworks', 'reloadArtworks_handler');
add_action('wp_ajax_nopriv_reloadArtworks', 'reloadArtworks_handler');

function reloadArtworks_handler() {
    $category = $_POST['category'];
    $style = $_POST['style'];
    $technique = $_POST['technique'];
    $format = $_POST['format'];
    $size = $_POST['size'];
    $minPrice = intval($_POST['minPrice']);
    $maxPrice = intval($_POST['maxPrice']);

    $args = [];
    $args['post_type'] = 'product';
    $args['post_status'] = 'publish';
    $args['posts_per_page'] = '12';

    $args['tax_query'] = [
        'relation' => 'AND',
    ];
    if($category != 'all'){
        array_push($args['tax_query'], [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category,
        ]);
    }

    if($style != 'all'){
        array_push($args['tax_query'], [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $style,
        ]);
    }

    if($format != 'all'){
        array_push($args['tax_query'], [
            'taxonomy' => 'pa_format',
            'field' => 'slug',
            'terms' => $format,
        ]);
    }

    if($size != 'all'){
        array_push($args['tax_query'], [
            'taxonomy' => 'pa_size',
            'field' => 'slug',
            'terms' => $size,
        ]);
    }

    if($technique != 'all'){
        array_push($args['tax_query'], [
            'taxonomy' => 'pa_technique',
            'field' => 'slug',
            'terms' => $technique,
        ]);
    }

//    if($artist != 'all'){
//        $args['meta_key'] = 'artist';
//        $args['meta_value'] = $artist;
//        $args['meta_compare'] = '===';
//    }

    $args['meta_query'] = [
        'relation' => 'AND',
        [
            'key' => '_price',
            'value' => [$minPrice, $maxPrice],
            'compare' => 'BETWEEN',
            'type' => 'DECIMAL'
        ]
    ];

    $query = new Wp_Query($args);

    $output = '';
    $count = $query->found_posts;
    if ($query->have_posts() && $count > 0) :
        while ($query->have_posts()) :
            $query->the_post();
			global $product;
            ob_start();
			?>

<div <?php wc_product_class( 'product-card', $product ); ?>>

	<div class="product-card__wrapper">
		<a class="product-card__image" href="<?php echo get_permalink()?>">
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id())) ?>
			<img width="<?php echo $image ? $image[1] : 220?>" height="<?php echo $image ? $image[2] : 220?>" data-src="<?php echo get_the_post_thumbnail_url($product->get_id()) ? get_the_post_thumbnail_url($product->get_id()) : esc_url( wc_placeholder_img_src( 'woocommerce_single' ))?>"  alt="product-image">
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

            <?php
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;

    else :
        $output .= '<li class="products__empty">Empty</li>';
    endif;

    $data = array(
        'output' => $output,
        'posts' => json_encode($query->query_vars),
        'max_page' => $query->max_num_pages,
    );

    echo json_encode($data);

    die;
}

add_action('wp_ajax_reloadArtists', 'reloadArtists_handler');
add_action('wp_ajax_nopriv_reloadArtists', 'reloadArtists_handler');

function reloadArtists_handler() {

    $args = [];
    $args['post_type'] = 'artists';
    $args['post_status'] = 'publish';
    $args['posts_per_page'] = '12';

    if(!empty($_POST['categories'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'artist_cat',
                'field' => 'slug',
                'terms' => explode(',', $_POST['categories']),
            ]
        ];
    }


    $query = new Wp_Query($args);

    $output = '';
    $count = $query->found_posts;
    if ($query->have_posts() && $count > 0) :
        while ($query->have_posts()) :
            $query->the_post();
            ob_start();
            get_template_part('partials/artist-card');
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;

    else :
        $output .= '<div class="artist-card products__empty">Empty</div>';
    endif;

    $data = array(
        'output' => $output,
        'posts' => json_encode($query->query_vars),
        'max_page' => $query->max_num_pages,
    );

    echo json_encode($data);

    die;
}

add_action('wp_ajax_loadPosts', 'loadPosts_handler');
add_action('wp_ajax_nopriv_loadPosts', 'loadPosts_handler');

function loadPosts_handler() {

    $query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '9',
    ]);
    $output = '';

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            ob_start();
            get_template_part('partials/post-card');
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;
    else :
        $output .= '<div class="artist-card products__empty">Empty</div>';
    endif;

    $data = array(
        'output' => $output,
        'posts' => json_encode($query->query_vars),
        'max_page' => $query->max_num_pages,
    );

    echo json_encode($data);

    die;
}

add_action('wp_ajax_loadMoreArtworks', 'loadMoreArtworks_handler');
add_action('wp_ajax_nopriv_loadMoreArtworks', 'loadMoreArtworks_handler');

function loadMoreArtworks_handler() {

    $args = json_decode( stripslashes( $_POST['posts'] ), true );
    $args['paged'] = $_POST['current_page'] + 1;

    query_posts($args);
    $output = '';

    if (have_posts()) :
        while (have_posts()) :
            the_post();
			global $product;
            ob_start();
            ?>

			<div <?php wc_product_class( 'product-card', $product ); ?>>

				<div class="product-card__wrapper">
					<a class="product-card__image" href="<?php echo get_permalink()?>">
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id())) ?>
						<img width="<?php echo $image ? $image[1] : 220?>" height="<?php echo $image ? $image[2] : 220?>" data-src="<?php echo get_the_post_thumbnail_url($product->get_id()) ? get_the_post_thumbnail_url($product->get_id()) : esc_url( wc_placeholder_img_src( 'woocommerce_single' ))?>"  alt="product-image">
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
<?php
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;
    endif;

    $data = array(
        'output' => $output,
    );

    echo json_encode($data);
    die;
}

add_action('wp_ajax_loadMoreArtists', 'loadMoreArtists_handler');
add_action('wp_ajax_nopriv_loadMoreArtists', 'loadMoreArtists_handler');

function loadMoreArtists_handler() {

    $args = json_decode( stripslashes( $_POST['posts'] ), true );
    $args['paged'] = $_POST['current_page'] + 1;

    query_posts($args);
    $output = '';

    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ob_start();
            get_template_part('partials/artist-card');
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;
    endif;

    $data = array(
        'output' => $output,
    );

    echo json_encode($data);
    die;
}

add_action('wp_ajax_loadMorePosts', 'loadMorePosts_handler');
add_action('wp_ajax_nopriv_loadMorePosts', 'loadMorePosts_handler');

function loadMorePosts_handler() {

    $args = json_decode( stripslashes( $_POST['posts'] ), true );
    $args['paged'] = $_POST['current_page'] + 1;

    query_posts($args);
    $output = '';

    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ob_start();
            get_template_part('partials/post-card');
            $output .= ob_get_contents();
            ob_end_clean();
        endwhile;
    endif;

    $data = array(
        'output' => $output,
    );

    echo json_encode($data);
    die;
}




add_filter( 'woocommerce_checkout_fields', 'custom_remove_fields', 9999 );

function custom_remove_fields( $woo_checkout_fields_array ) {

    $woo_checkout_fields_array['billing']['billing_first_name']['placeholder'] = 'First Name';
    $woo_checkout_fields_array['billing']['billing_last_name']['placeholder'] = 'Last Name';
    $woo_checkout_fields_array['billing']['billing_email']['placeholder'] = 'Email';
    $woo_checkout_fields_array['billing']['billing_email']['priority'] = 30;
    $woo_checkout_fields_array['billing']['billing_phone']['placeholder'] = 'Phone';
    $woo_checkout_fields_array['billing']['billing_phone']['priority'] = 40;

    $woo_checkout_fields_array['billing']['billing_address_1']['priority'] = 50;
    $woo_checkout_fields_array['billing']['billing_address_2']['priority'] = 60;
    $woo_checkout_fields_array['billing']['billing_postcode']['priority'] = 70;
    $woo_checkout_fields_array['billing']['billing_postcode']['placeholder'] = 'Postal Code';
    $woo_checkout_fields_array['billing']['billing_city']['priority'] = 80;
    $woo_checkout_fields_array['billing']['billing_city']['placeholder'] = 'City';
    $woo_checkout_fields_array['billing']['billing_country']['priority'] = 90;

    $woo_checkout_fields_array['shipping']['shipping_address_1']['priority'] = 40;
    $woo_checkout_fields_array['shipping']['shipping_address_2']['priority'] = 50;
    $woo_checkout_fields_array['shipping']['shipping_postcode']['priority'] = 60;
    $woo_checkout_fields_array['shipping']['shipping_postcode']['placeholder'] = 'Postal Code';
    $woo_checkout_fields_array['shipping']['shipping_city']['priority'] = 70;
    $woo_checkout_fields_array['shipping']['shipping_city']['placeholder'] = 'City';
    $woo_checkout_fields_array['shipping']['shipping_country']['priority'] = 100;

    return $woo_checkout_fields_array;
}

use Automattic\Jetpack\Constants;

function custom_wc_cart_totals_coupon_html( $coupon ) {
    if ( is_string( $coupon ) ) {
        $coupon = new WC_Coupon( $coupon );
    }

    $discount_amount_html = '';

    $amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
    $discount_amount_html = '-' . wc_price( $amount );

    if ( $coupon->get_free_shipping() && empty( $amount ) ) {
        $discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
    }

    $discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
    $coupon_html          = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', rawurlencode( $coupon->get_code() ), Constants::is_defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '">-</a>';

    echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) );
}
// Disable Billing state validation
add_filter( 'woocommerce_default_address_fields' , 'custom_override_state_required' );
function custom_override_state_required( $address_fields ) {
  $wc = WC();
  $country = $wc->customer->get_country();
  $address_fields['postcode']['validate'] = false;
  if($country !== 'US'){
     $address_fields['state']['required'] = false;
  }
  return $address_fields;
}


function my_custom_product_filters( $post_type ) {
    global $wpdb;
    $custom_post_type = 'artists'; // define your custom post type slug here
    // A sql query to return all post titles
    $results = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish'", $custom_post_type ), ARRAY_A );
    // Return null if we found no results
    if ( ! $results ) return;
    if( $post_type == 'product' ) {
        // HTML for our select printing post titles as loop
        $output = '<select name="artist_filter" id="artist_filter">';
        $output .= '<option value="">Filter by Artist</option>';
        foreach( $results as $index => $post ) {
            if ($_GET['artist_filter'] == $post['ID']) {
                $output .= '<option value="' . $post['ID'] . '" selected>' . $post['post_title'] . '</option>';
            } else {
                $output .= '<option value="' . $post['ID'] . '">' . $post['post_title'] . '</option>';
            }
        }

        $output .= '</select>'; // end of select element
    }
    // get the html
    echo $output;
}

add_action( 'restrict_manage_posts', 'my_custom_product_filters' );

function apply_my_custom_product_filters( $query ) {

    global $pagenow;

    // Ensure it is an edit.php admin page, the filter exists and has a value, and that it's the products page
    if ( $query->is_admin && $pagenow == 'edit.php' && isset( $_GET['artist_filter'] ) && $_GET['artist_filter'] != '' && $_GET['post_type'] == 'product' ) {

    // Create meta query array and add to WP_Query
        $meta_key_query = array(
            array(
            'key'     => 'artist',
            'value'   => esc_attr( $_GET['artist_filter'] ),
            )
        );
        $query->set( 'meta_query', $meta_key_query );

    }

}

add_action( 'pre_get_posts', 'apply_my_custom_product_filters' );


//Styling login form
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
    // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


/**
 * Chnage admin logo image
 */

function am_login_logo(){  ?>
    <style type="text/css">
        body.login div#login h1 a {
			width: 60px;
			height: 100px;
			display: block;
			cursor: pointer;
			text-indent: -9999em;
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.png) no-repeat;
            background-size: 100% auto;
            margin: 0 auto 35px;
            outline: none;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'am_login_logo' );

//coupon
add_action('gform_after_submission_3', 'after_submission_3', 10, 2);
function after_submission_3( $entry, $form ) {
	$coupon_code = createDiscountCouponForNewSubscriber(); //get coupon code from coupon
	$to = $_POST["input_2"]; //get email input
	$subject = 'New Artist';
	$body = 'The email body content';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	
	$message = "";
	if($entry[1] == "Artist")
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      p {
        margin: 0;
      }
    </style>
  </head>
  <body style="margin: 0; padding: 0">
    <table
      align="center"
      role="presentation"
      border="0"
      cellpadding="0"
      cellspacing="0"
      width="600px"
      style="border-collapse: collapse"
    >
      <tr bgcolor="#282561">
        <td style="padding: 20px">
          <table width="100%">
            <tr>
              <td width="50%">
                <a href="http://st-artamsterdam.com/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/logo.png" alt="logo" />
                </a>
              </td>
              <td width="50%" align="right">
                <a style="margin: 0 5px" href="https://www.instagram.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_1.png" alt="icon_social_1" />
                </a>
                <a style="margin: 0 5px" href="https://www.facebook.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_2.png" alt="icon_social_2" />
                </a>
                <a style="margin: 0 5px" href="https://www.pinterest.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_3.png" alt="icon_social_3" />
                </a>
                <a style="margin: 0 5px" href="https://www.youtube.com/channel/UCp6IhBXPvasX4WxTEJFvmPw">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_4.png" alt="icon_social_4" />
                </a>
                <a style="margin: 0 5px" href="https://twitter.com/startamsterdam">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_5.png" alt="icon_social_5" />
                </a>
                <a style="margin: 0 5px" href="https://www.linkedin.com/company/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_6.png" alt="icon_social_6" />
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding: 40px 0 27px 0; color: #060708">
          <h3 style="font: 600 23px/20px \'Archia\', sans-serif">
            Welcome to st-Art!
          </h3>
        </td>
      </tr>
      <tr>
        <td style="border-bottom: 1px solid #eaebec; padding-bottom: 40px">
          <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/curve_bicycle.png" alt="curve_bicycle" />
        </td>
      </tr>
      <tr>
        <td style="padding: 0 40.5px">
          <table>
            <tr>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/gallery/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Gallery</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/artists/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Artists</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/calendar/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Calendar</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/workshops/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Workshops</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/stories/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Stories</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/about/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >About</a
                >
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <img
            style="display: block"
            width="100%"
            src="http://pstart.staging.wpengine.com/wp-content/uploads/email/email-banner.jpg"
            alt=""
          />
        </td>
      </tr>
      <tr>
        <td style="padding: 0 0 25px" align="center">
          <h3
            style="font: 600 23px/27.6px \'Archia\', sans-serif; color: #060708"
          >
            Want to be part of st-Art?<br />
            Get started now
          </h3>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 25px">
          <p style="font: 400 14px/22px \'Archia\', sans-serif; color: #060708">
            Our team of curators/mentors will analyze in-depth the artworks,
            discuss the artist\'s background, explore ambitions, and propose a
            path forward. We’re fully dedicated in discovering young and/or
            contemporary emerging artists worldwide.
          </p>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding: 25px 0">
          <a
            style="display: inline-block;
              padding: 19px;
              background-color: #3a56a5;
              font: 600 18px/22px \'Archia\', sans-serif;
              text-align: center;
              text-transform: uppercase;
              text-decoration: none;
              color: #fff;"
            href="https://st-artamsterdam.com/workshops/"
            >Apply now</a
          >
          <a
            style="display: inline-block;
              padding: 19px;
              background-color: #3a56a5;
              font: 600 18px/22px \'Archia\', sans-serif;
              text-align: center;
              text-transform: uppercase;
              text-decoration: none;
              color: #fff;
              margin-left: 25px;"
            href="https://st-artamsterdam.com/workshops/"
            >Submit your artwork</a
          >
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 50px">
          <a
            style="display: inline-block;
              padding: 19px;
              background-color: #3a56a5;
              font: 600 18px/22px \'Archia\', sans-serif;
              text-align: center;
              text-transform: uppercase;
              text-decoration: none;
              color: #fff;"
            href="https://st-artamsterdam.com/workshops/"
            >Book A workshop</a
          >
        </td>
      </tr>
      <tr>
        <td bgcolor="#282561" style="padding: 24px" align="center">
          <table>
            <tr>
              <td align="center">
                <a style="margin: 0 5px" href="https://www.instagram.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_1.png" alt="icon_social_1" />
                </a>
                <a style="margin: 0 5px" href="https://www.facebook.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_2.png" alt="icon_social_2" />
                </a>
                <a style="margin: 0 5px" href="https://www.pinterest.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_3.png" alt="icon_social_3" />
                </a>
                <a style="margin: 0 5px" href="https://www.youtube.com/channel/UCp6IhBXPvasX4WxTEJFvmPw">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_4.png" alt="icon_social_4" />
                </a>
                <a style="margin: 0 5px" href="https://twitter.com/startamsterdam">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_5.png" alt="icon_social_5" />
                </a>
                <a style="margin: 0 5px" href="https://www.linkedin.com/company/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_6.png" alt="icon_social_6" />
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding-top: 25px" align="center">
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Copyright © 2021, All rights reserved.
                </p>
                <br />
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Van Oldenbarneldtstraat 32, Amsterdam 1052KB
                </p>
                <br />
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Want to change how you receive these emails?<br />
                  Update your email preferences or unsubscribe here.
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>';
	else
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      p {
        margin: 0;
      }
    </style>
  </head>
  <body style="margin: 0; padding: 0">
    <table
      align="center"
      role="presentation"
      border="0"
      cellpadding="0"
      cellspacing="0"
      width="600px"
      style="border-collapse: collapse"
    >
      <tr bgcolor="#282561">
        <td style="padding: 20px">
          <table width="100%">
            <tr>
              <td width="50%">
                <a href="http://st-artamsterdam.com/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/logo.png" alt="logo" />
                </a>
              </td>
              <td width="50%" align="right">
                <a style="margin: 0 5px" href="https://www.instagram.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_1.png" alt="icon_social_1" />
                </a>
                <a style="margin: 0 5px" href="https://www.facebook.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_2.png" alt="icon_social_2" />
                </a>
                <a style="margin: 0 5px" href="https://www.pinterest.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_3.png" alt="icon_social_3" />
                </a>
                <a style="margin: 0 5px" href="https://www.youtube.com/channel/UCp6IhBXPvasX4WxTEJFvmPw">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_4.png" alt="icon_social_4" />
                </a>
                <a style="margin: 0 5px" href="https://twitter.com/startamsterdam">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_5.png" alt="icon_social_5" />
                </a>
                <a style="margin: 0 5px" href="https://www.linkedin.com/company/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_6.png" alt="icon_social_6" />
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding: 40px 0 27px 0; color: #060708">
          <h3 style="font: 600 23px/20px \'Archia\', sans-serif">
            Welcome to st-Art!
          </h3>
        </td>
      </tr>
      <tr>
        <td style="border-bottom: 1px solid #eaebec; padding-bottom: 40px">
          <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/curve_bicycle.png" alt="curve_bicycle" />
        </td>
      </tr>
      <tr>
        <td style="padding: 0 40.5px">
          <table>
            <tr>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/gallery/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Gallery</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/artists/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Artists</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/calendar/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Calendar</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/workshops/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Workshops</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/stories/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >Stories</a
                >
              </td>
              <td style="padding: 17px 13.5px">
                <a
                  href="https://st-artamsterdam.com/about/"
                  style="
                    font: normal 15px/18px \'Archia\', sans-serif;
                    color: #060708;
                    text-decoration: none;
                  "
                  >About</a
                >
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <img
            style="display: block"
            width="100%"
            src="http://pstart.staging.wpengine.com/wp-content/uploads/email/email-banner.jpg"
            alt=""
          />
        </td>
      </tr>
      <tr>
        <td style="padding: 0 0 25px" align="center">
          <h3
            style="font: 600 23px/27.6px \'Archia\', sans-serif; color: #060708"
          >
            Contact us for all your Art needs
          </h3>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 25px">
          <p style="font: 400 14px/22px \'Archia\', sans-serif; color: #060708">
            Whether you are looking for that unique art piece or just in need of art advisory, st-Art is here to guide you.
          </p>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom: 50px">
          <a
            style="
              display: inline-block;
              padding: 19px;
              background-color: #3a56a5;
              font: 600 18px/22px \'Archia\', sans-serif;
              text-align: center;
              text-transform: uppercase;
              text-decoration: none;
              color: #fff;
            "
            href="https://st-artamsterdam.com/about/"
            >Contact us</a
          >
        </td>
      </tr>
      <tr>
        <td bgcolor="#282561" style="padding: 24px" align="center">
          <table>
            <tr>
              <td align="center">
                <a style="margin: 0 5px" href="https://www.instagram.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_1.png" alt="icon_social_1" />
                </a>
                <a style="margin: 0 5px" href="https://www.facebook.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_2.png" alt="icon_social_2" />
                </a>
                <a style="margin: 0 5px" href="https://www.pinterest.com/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_3.png" alt="icon_social_3" />
                </a>
                <a style="margin: 0 5px" href="https://www.youtube.com/channel/UCp6IhBXPvasX4WxTEJFvmPw">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_4.png" alt="icon_social_4" />
                </a>
                <a style="margin: 0 5px" href="https://twitter.com/startamsterdam">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_5.png" alt="icon_social_5" />
                </a>
                <a style="margin: 0 5px" href="https://www.linkedin.com/company/startamsterdam/">
                  <img src="http://pstart.staging.wpengine.com/wp-content/uploads/email/icon_social_6.png" alt="icon_social_6" />
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding-top: 25px" align="center">
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Copyright © 2021, All rights reserved.
                </p>
                <br />
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Van Oldenbarneldtstraat 32, Amsterdam 1052KB
                </p>
                <br />
                <p
                  style="font: 400 12px/17px \'Archia\', sans-serif; color: white"
                >
                  Want to change how you receive these emails?<br />
                  Update your email preferences or unsubscribe here.
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>';
	
	wp_mail($to, $subject, $message, $headers );
}

add_action('gform_after_submission_1', 'after_submission_3', 10, 2);

add_filter (  'wp_mail_from_name' ,  'vortal_wp_mail_from_name'  ) ; 
function vortal_wp_mail_from_name (  $email_from  ) { 
	return  'Welcome to st-Art' ; 
} 

// this function creates the coupon, for the newly registered user
function createDiscountCouponForNewSubscriber()
{
	$characters = "ABCDEFGHJKMNPQRSTUVWXYZ23456789";
	$char_length = "8";
	$coupon_code = substr( str_shuffle( $characters ),  0, $char_length ); // Code created using the random string snippet.
	$amount = '10'; // Amount
	$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product

	$coupon = array(
	'post_title' => $coupon_code,
	'post_content' => '',
	'post_status' => 'publish',
	'post_author' => 1,
	'post_type' => 'shop_coupon'
	);

	$new_coupon_id = wp_insert_post( $coupon );

	// Add meta
	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
	update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
	update_post_meta( $new_coupon_id, 'product_ids', '' );
	update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', 1 );
	update_post_meta( $new_coupon_id, 'expiry_date', '' );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
	
	return $coupon_code;
}

function cta_link_func ( $atts ) {
	$a = shortcode_atts( array(
		'href' => '#',
		'title' => '',
	), $atts );
	return '<a href="' . $a['href'] . '" class="st-button">' . $a['title'] . '</a>';
}
add_shortcode( 'cta_link', 'cta_link_func' );
?>