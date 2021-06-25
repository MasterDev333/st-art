<?php

/**
 * Two Columns Content Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'two-columns-content-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-columns-content';
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
  <div class="container">
    <?php if( have_rows('columns') ): ?>
        <div class="two-columns-content-columns">
            <?php while( have_rows('columns') ): the_row(); 
              $title = get_sub_field('title');
              $text = get_sub_field('text');
              $image = get_sub_field('image');
              $link = get_sub_field('link');
              $file = get_sub_field('file');
              $link_title = get_sub_field('link_title');

            ?>
                <div class="two-columns-content__column">
                    <?php if ($image): ?>
                        <div class="two-columns-content__image" style="background-image: url(<?php echo $image; ?>)"></div>
                    <?php endif; ?>
                    <?php if ($title): ?>
                        <p class="two-columns-content__title"><?php echo $title; ?></p>
                    <?php endif; ?>
                        
                    <div class="two-columns-content__description">
                        <?php echo $text; ?>
                    </div>
                    
                    <?php if ($link || $file): ?>
                        <div class="two-columns-content__link-wrap">
                            <a target="<?php if($file): echo '_blank'; else: echo $link['target']; endif; ?>"
                               href="<?php echo $link['url'] ? $link['url'] : $file; ?>" class="two-columns-content__link">
                                <span>
                                    Learn more
                                </span>
                                <svg class="two-columns-content__link-icon" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle r="10.3235" transform="matrix(-1 0 0 1 10.3269 10.3235)" fill="#EAEBEC"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68978 6.91007C8.42101 7.17885 8.42101 7.61461 8.68978 7.88338L11.8459 11.0395C12.1147 11.3083 12.5504 11.3083 12.8192 11.0395C13.088 10.7707 13.088 10.3349 12.8192 10.0662L9.66309 6.91007C9.39432 6.6413 8.95855 6.6413 8.68978 6.91007Z" fill="#3A56A5"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68978 14.1956C8.42101 13.9269 8.42101 13.4911 8.68978 13.2223L11.8459 10.0662C12.1147 9.79746 12.5504 9.79746 12.8192 10.0662C13.088 10.335 13.088 10.7708 12.8192 11.0395L9.66309 14.1956C9.39432 14.4644 8.95855 14.4644 8.68978 14.1956Z" fill="#3A56A5"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>


    </div>
</div>