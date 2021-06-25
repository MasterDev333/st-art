<?php

/**
 * Latest news Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'latest-news-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'latest-news';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$subtitle = get_field('latest_news_subtitle') ?: null;
$title = get_field('latest_news_title') ?: null;
?>
<section class="about-st-art">
  <div class="container container--padding">
    <div id="<?php echo esc_attr($id); ?>" class="
      <?php echo esc_attr($className); ?>">
      <?php if ($title): ?>
        <h3 class="h3 latest-news__title"><?php echo $title ?></h3>
      <?php endif; ?>
      <?php if ($subtitle): ?>
        <p class="latest-news__subtitle"><?php echo $subtitle ?></p>
      <?php endif; ?>

      <div class="latest-news__block">
        <?php
        $postArgs = array(
          'post_type' => 'post',
          'posts_per_page' => 3,
        );
        $latestNews = new WP_Query($postArgs);
        ?>
        <?php if ($latestNews->have_posts()) : ?>
          <?php while ($latestNews->have_posts()) : $latestNews->the_post(); ?>
            <?php get_template_part('partials/post-card'); ?>
          <?php endwhile; ?>
        <?php endif; wp_reset_query(); ?>
      </div>
    </div>
  </div>
</section>