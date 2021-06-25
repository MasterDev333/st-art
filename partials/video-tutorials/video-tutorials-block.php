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
$id = 'video-tutorials-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'video-tutorials';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$subtitle = get_field('video_tutorials_subtitle') ?: null;
$title = get_field('video_tutorials_title') ?: null;
?>
<section class="video-tutorials-section">
  <div class="container container--padding">
    <div id="<?php echo esc_attr($id); ?>" class="
      <?php echo esc_attr($className); ?>">
      <?php if ($title): ?>
        <h3 class="h3 video-tutorials__title"><?php echo $title ?></h3>
      <?php endif; ?>
      <?php if ($subtitle): ?>
        <p class="video-tutorials__subtitle"><?php echo $subtitle ?></p>
      <?php endif; ?>

      <?php if (have_rows('video_tutorials_videos')): ?>
        <div class="video-tutorials__block">
          <?php while (have_rows('video_tutorials_videos')) : the_row(); ?>
            <?php
            $image = get_sub_field('video_image');
            $link = get_sub_field('video_link');
            ?>
            <div class="video-tutorials__image" data-src="<?php echo $link; ?>">
              <?php if ($image): ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
              <?php else: ?>
                <iframe src="<?php echo $link; ?>" frameborder="0"
                allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>

  <div class="video-tutorials-popup">
    <span class="video-tutorials-popup__close">
      <svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M29.0002 2.12132L3.00023 28.1213L0.878906 26L26.8789 -6.27344e-07L29.0002 2.12132Z" fill="#fff"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.999773 2.24263L26.9998 28.2426L29.1211 26.1213L3.12109 0.121307L0.999773 2.24263Z" fill="#fff"/>
      </svg>
    </span>
    <div class="video-tutorials-popup__iframe">
      <iframe src="" frameborder="0"
              allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
    </div>
  </div>