<?php

/**
 * Hero Home Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-gallery-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-gallery';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

if( !empty(get_field('type')) ) {
    $className .= ' '.get_field('type');
}

$images = get_field('gallery') ?: null;
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php foreach($images as $image) : ?>
        <picture>
            <img src="<?php echo $image['sizes']['medium_large'] ?>">
        </picture>
    <?php endforeach; ?>
</div>