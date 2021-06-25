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
$id = 'custom-info-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-info';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$image = get_field('info_image') ?: null;
$title = get_field('info_title') ?: null;
$subtitle = get_field('info_subtitle') ?: null;
$learnmore = get_field('info_learn_more') ?: null;
$frontReverse = get_field_object('front_reverse') ?: null;
?>

<div id="<?php echo esc_attr($id); ?>" class="
<?php echo esc_attr($className); ?>
<?php if($frontReverse['value'] == 'reverse'): ?> custom-info--reverse<?php endif; ?>">
  <div class="custom-info__image">
    <?php if ($image): ?>
      <img src="<?php echo $image['url'] ?>">
    <?php endif; ?>
  </div>
  <div class="custom-info__text-box">
    <?php if ($title): ?>
      <h3 class="h3 custom-info__title"><?php echo $title ?></h3>
    <?php endif; ?>

    <?php if ($subtitle): ?>
      <div class="custom-info__desc"><?php echo $subtitle ?></div>
    <?php endif; ?>

    <?php if ($learnmore): ?>
      <a href="<?php echo $learnmore['url'] ?>" class="custom-info__learn-more st-button"><?php echo $learnmore['title'] ?></a>
    <?php endif; ?>
  </div>
</div>