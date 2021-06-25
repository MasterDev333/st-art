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
$id = 'discover-our-media-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'discover-our-media';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$title = get_field('discover_our_media_title') ?: null;
?>
<section class="discover-our-media-section">
  <div class="container container--padding">
    <div id="<?php echo esc_attr($id); ?>" class="
      <?php echo esc_attr($className); ?>">
      <?php if ($title): ?>
        <h3 class="h3 discover-our-media__title"><?php echo $title ?></h3>
      <?php endif; ?>
      <?php if (have_rows('discover_our_media_categories')): ?>
        <div class="discover-our-media__block">
          <?php while (have_rows('discover_our_media_categories')) : the_row(); ?>
            <?php
              $image = get_sub_field('image');
              $title = get_sub_field('title');
              $link = get_sub_field('link');
            ?>
            <a class="discover-our-media__card" href="<?php echo get_home_url(); ?><?php echo $link; ?>">
              <div class="discover-our-media__image">
                <?php if ($title): ?>
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                <?php endif; ?>
              </div>
              <?php if ($title): ?>
                <span class="discover-our-media__card-title"><?php echo $title; ?></span>
              <?php endif; ?>
            </a>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>