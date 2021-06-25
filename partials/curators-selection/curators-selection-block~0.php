<?php

/**
 * Hero Home Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'curators-selection-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'curators-selection';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$subtitle = get_field('curators_selection_subtitle') ?: null;
$title = get_field('curators_selection_title') ?: null;
?>
<section class="curators-selection-section">
  <div class="container container--padding">
    <div id="<?php echo esc_attr($id); ?>" class="
      <?php echo esc_attr($className); ?>">
      <?php if ($title): ?>
        <h3 class="h3 curators-selection__title"><?php echo $title ?></h3>
      <?php endif; ?>
      <?php if ($subtitle): ?>
        <p class="curators-selection__subtitle"><?php echo $subtitle ?></p>
      <?php endif; ?>

      <?php
      $featured_posts = get_field('curators_selection_posts');
      if ($featured_posts): ?>
        <ul class="curators-selection__block">
          <?php foreach($featured_posts as $post) :
              $product = wc_get_product($post);
            ?>

            <li <?php wc_product_class( 'product-card', $product ); ?>>

              <div class="product-card__wrapper">
                <a class="product-card__image" href="<?php echo get_permalink()?>">
                  <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'large') ?>
                  <img width="<?php echo $image ? $image[1] : 220?>" height="<?php echo $image ? $image[2] : 220?>" src="<?php echo get_the_post_thumbnail_url($product->get_id()) ? get_the_post_thumbnail_url($product->get_id(), 'large') : esc_url( wc_placeholder_img_src( 'woocommerce_single' ))?>" alt="product-image">
                  <?php if(!$product->is_in_stock()) : ?>
                    <div class="product-card__image-label">Sold</div>
                  <?php endif; ?>
                </a>
              </div>
              <div class="product-card__content">
                <h4 class="h4 h4--bold product-card__title">
                  <a class="product-card__title-link" href="<?php echo get_permalink($product->get_id())?>">
                    <?php echo get_the_title($product->get_id()) ?>
                  </a>
                </h4>
                <p class="product-card__artist"><a class="product-card__artist-link" href="<?php echo get_the_permalink(get_field('artist', $product->get_id())->ID) ?>"><?php echo get_the_title(get_field('artist', $product->get_id())->ID)?></a></p>
                <p class="product-card__price"><?php echo $product->get_price_html(); ?></p>
              </div>
            </li>

          <?php endforeach; ?>
        </ul>
        <?php
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
</section>