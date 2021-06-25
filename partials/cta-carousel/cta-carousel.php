<?php

/**
 * CTA Carousel Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-carousel-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cta-carousel';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

if (!empty(get_field('type'))) {
  $className .= ' ' . get_field('type');
}

?>

<div id="<?php echo esc_attr($id); ?>" class=" <?php echo esc_attr($className); ?>">
    <?php if( have_rows('slides') ): ?>
        <div class="cta-carousel-slides">
            <?php while( have_rows('slides') ): the_row(); 
                $image = get_sub_field('image');
                $mobile_image = get_sub_field('mobile_image');
                $title = get_sub_field('title');
                $button = get_sub_field('button_link');
                $button_target = $button['target'] ? $button['target'] : '_self';
                $title_color = get_sub_field('title_color');
            ?>
            <div class="cta-carousel__slide">
                <?php if ($image): ?>
                    <picture class="cta-carousel__image">
                        <source srcset="<?php echo $image['url']; ?>" media="(min-width: 768px)">
                        <?php if ($mobile_image): ?>
                            <img src="<?php echo $mobile_image['url']; ?>" alt="<?php echo $title; ?>">
                        <?php else: ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $title; ?>">
                        <?php endif; ?>
                    </picture>
                <?php endif; ?>
                <div class="cta-carousel__slide-content">
                    <?php if ($title): ?>
                        <h2 class="h1 cta-carousel__title color-<?php echo $title_color; ?>"><?php echo $title ?></h2>
                    <?php endif; ?>

                    <?php if ($button): ?>
                        <a href="<?php echo $button['url']; ?>" target="<?php echo $button_target; ?>" class="cta-carousel__button st-button"><?php echo $button['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>