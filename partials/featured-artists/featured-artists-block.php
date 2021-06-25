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
$id = 'featured-artists-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'featured-artists';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$subtitle = get_field('featured_artists_subtitle') ?: null;
$title = get_field('featured_artists_title') ?: null;
?>
<section class="featured-artists-section">
  <div class="container container--padding">
    <div id="<?php echo esc_attr($id); ?>" class="
      <?php echo esc_attr($className); ?>">
      <?php if ($title): ?>
        <h3 class="h3 featured-artists__title"><?php echo $title ?></h3>
      <?php endif; ?>
      <?php if ($subtitle): ?>
        <p class="featured-artists__subtitle"><?php echo $subtitle ?></p>
      <?php endif; ?>

      <?php
      $featured_posts = get_field('featured_artists_block');
      if ($featured_posts): ?>
        <ul class="featured-artists__block">
          <?php foreach($featured_posts as $post) : ?>
            <?php
            $artist_ID = $post->ID;
            $query = new Wp_Query([
              'post_type' => 'product',
              'post_status' => 'publish',
              'posts_per_page' => '1',
              'meta_key' => 'artist',
              'meta_value' => $artist_ID,
              'meta_compare' => '===',
            ]);
            $image = ' ';
            if ($query->have_posts()) :
              $query->the_post();
              $image = get_the_post_thumbnail_url('','medium_large');
            endif;
            wp_reset_postdata();?>

            <li class="artist-card">
              <div class="artist-card__image">
                <a href="<?php echo get_the_permalink($artist_ID) ?>">
                  <picture>
                    <img src="<?php echo $image ?>">
                  </picture>
                </a>
              </div>
              <div class="artist-card__info">
                <h4 class="h4 h4--bold artist-card__title"><a href="<?php echo get_the_permalink($artist_ID) ?>"><?php echo get_the_title($artist_ID) ?></a></h4>
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