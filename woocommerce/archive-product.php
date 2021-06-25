<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>

<main class="main">
    <div class="products-section">
        <div class="container container--padding">
            <div class="products-section__inner">
                <div class="products-section__info">
                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        <h1 class="products-section__title h3"><?php woocommerce_page_title(); ?></h1>
                    <?php endif; ?>
                    <div class="products-section__description">
                        <?php echo get_field('page_description', woocommerce_get_page_id( 'shop' )) ?>
                    </div>
                </div>
                <div class="products-section__filtering">
                    <h4 class="h4 h4--bold">Filter by</h4>
                    <div class="clear-filter">
                    	<a class="clear-filter__btn">Clear Filters</a>
                    </div>
                    <div class="products-section__filtering-block">
                        <select class="products-section__select category">
                            <option value="all">Category</option>
                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'product_cat',
                                'hide_empty' => false,
                                'parent' => 0,
                            ] );
                            foreach ($terms as $term) :?>
                                <option value="<?php echo $term->slug ?>" <?php if($_GET['cat'] == $term->slug): echo 'selected="selected"'; endif; ?>><?php echo $term->name ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <select class="products-section__select technique">
                            <option value="all">Technique</option>
                            <?php
                            $terms = get_terms( 'pa_technique', [
                                'hide_empty' => false,
                            ] );
                            foreach ($terms as $term) :?>
                                <option value="<?php echo $term->slug ?>" <?php if($_GET['tech'] == $term->slug): echo 'selected="selected"'; endif; ?>><?php echo $term->name ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="products-section__style-filter">
                            <p class="products-section__style-title" data-default="Style">Style</p>
                            <?php get_template_part('partials/svg/link-arrow') ?>
                            <div class="products-section__dropdown style-dropdown">
                                <?php
                                $terms = get_terms( [
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => 0,
                                ] );
                                foreach ($terms as $term) :?>
                                    <div class="style-dropdown__style-name"><?php echo $term->name ?></div>
                                    <div class="style-dropdown__styles">
                                <?php
                                    $subs =  get_terms( [
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => false,
                                        'parent' => $term->term_id,
                                    ] );
                                    foreach ($subs as $sub) : ?>
                                        <input type="radio" name="filter-style" id="filter-style-<?php echo $sub->slug ?>" value="<?php echo $sub->slug ?>" data-parent="<?php echo $term->slug ?>" <?php if($_GET['style'] == $sub->slug): echo 'checked'; endif; ?>><label for="filter-style-<?php echo $sub->slug ?>"><?php echo $sub->name ?></label>
                                    <?php endforeach;?>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="products-section__filtering-block">
                        <select class="products-section__select format">
                            <option value="all">Orientation</option>
                            <?php
                            $terms = get_terms( 'pa_format', [
                                'hide_empty' => false,
                            ] );
                            foreach ($terms as $term) :?>
                                <option value="<?php echo $term->slug ?>" <?php if($_GET['format'] == $term->slug): echo 'selected="selected"'; endif; ?>><?php echo $term->name ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <select class="products-section__select size">
                            <option value="all">Size</option>
                            <?php
                            $terms = get_terms( 'pa_size', [
                                'hide_empty' => false,
                            ] );
                            foreach ($terms as $term) :?>
                                <option value="<?php echo $term->slug ?>" <?php if($_GET['size'] == $term->slug): echo 'selected="selected"'; endif; ?>><?php echo $term->name ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="products-section__price-filter">
                            <p class="products-section__price-title">Price</p>
                            <?php get_template_part('partials/svg/link-arrow') ?>
                            <div class="products-section__dropdown"
                            data-min-price="<?php
//                             $args = [];
//                             $args['post_type'] = 'product';
//                             $args['post_status'] = 'publish';
//                             $args['orderby'] = 'meta_value_num';
//                             $args['order'] = 'ASC';
//                             $args['meta_key'] = '_price';

//                             $query = new Wp_Query($args);
//                             if ($query->have_posts()) :
//                                 $query->the_post();
//                                 global $product;
//                                 $shopMinPrice = $product->get_price();
//                                 echo $shopMinPrice;
//                             endif;
                            echo 100;
                            ?>"
                            data-max-price="<?php
//                             $args = [];
//                             $args['post_type'] = 'product';
//                             $args['post_status'] = 'publish';
//                             $args['orderby'] = 'meta_value_num';
//                             $args['order'] = 'DESC';
//                             $args['meta_key'] = '_price';

//                             $query = new Wp_Query($args);
//                             if ($query->have_posts()) :
//                                 $query->the_post();
//                                 global $product;
//                                 $shopMaxPrice = $product->get_price();
//                                 echo $shopMaxPrice;
//                             endif;
                            echo 100000
                            ?>">
                                <div class="inputs-wrapper">
                                    <div class="input-wrapper"><input type="text" id="priceRangeMin"><label for="priceRangeMin">€</label></div>
                                    <div class="input-wrapper"><input type="text" id="priceRangeMax"><label for="priceRangeMax">€</label></div>
                                </div>
                                <div id="price-range" class="slider"></div>
                            </div>
                        </div>
                        <div class="products-section__select-dropdown"></div>
                    </div>
                </div>
                <div class="products-section__list-wrapper">
                    <?php
                    woocommerce_product_loop_start();
                    ?>
                    <div class="loader-section"><div class="loader"></div></div>
                    <?php
                    woocommerce_product_loop_end();
                    ?>
                </div>
                <p class="products-section__loadMore">
                    <a href="#">
                        Load more
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle r="10.3235" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 10.3269 10.3234)" fill="#EAEBEC"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7406 8.6888C13.4718 8.42003 13.036 8.42003 12.7673 8.6888L9.61115 11.8449C9.34238 12.1137 9.34238 12.5494 9.61115 12.8182C9.87992 13.087 10.3157 13.087 10.5845 12.8182L13.7406 9.66212C14.0093 9.39334 14.0093 8.95758 13.7406 8.6888Z" fill="#3A56A5"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45573 8.6888C6.7245 8.42003 7.16027 8.42003 7.42904 8.6888L10.5851 11.8449C10.8539 12.1137 10.8539 12.5494 10.5851 12.8182C10.3164 13.087 9.8806 13.087 9.61183 12.8182L6.45573 9.66212C6.18695 9.39334 6.18695 8.95758 6.45573 8.6888Z" fill="#3A56A5"/>
                        </svg>

                    </a>
                </p>
            </div>
        </div>
    </div>
</main>

<?php
get_footer( 'shop' );
?>