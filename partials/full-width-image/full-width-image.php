<?php

/**
 * Full width image Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'full-width-image-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'full-width-image';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

$image = get_field('image');
$image_mobile = get_field('image_mobile');

?>

<?php if($image): ?>
    <div id="<?php echo esc_attr($id); ?>" class=" <?php echo esc_attr($className); ?>">
        <picture>
            <source srcset="<?php echo $image['url']; ?>" media="(min-width: 768px)">
            <?php if ($image_mobile): ?>
                <img src="<?php echo $image_mobile['url']; ?>" alt="<?php echo $image_mobile['title']; ?>">
            <?php else: ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
            <?php endif; ?>
        </picture>
    </div>
<?php endif; ?>