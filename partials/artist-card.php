<?php
$artist_ID = get_the_ID();
$query = new Wp_Query([
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => '1',
    'meta_key' => 'artist',
    'meta_value' => get_the_ID(),
    'meta_compare' => '===',
]);
$image = ' ';
if ($query->have_posts()) :
    $query->the_post();
    $image = get_the_post_thumbnail_url('','medium_large');
endif;
wp_reset_postdata();?>
<div class="artist-card">
    <div class="artist-card__image">
        <a href="<?php echo get_the_permalink($artist_ID) ?>">
            <picture>
                <img data-src="<?php echo $image ?>">
            </picture>
        </a>
    </div>
    <div class="artist-card__info">
        <h4 class="h4 h4--bold artist-card__title"><a href="<?php echo get_the_permalink($artist_ID) ?>"><?php echo get_the_title($artist_ID) ?></a></h4>
        <p class="artist-card__categories">
            <?php
            $terms = get_the_terms($artist_ID, 'artist_cat');
            if(!empty($terms)):
            foreach ($terms as $key => $category) :
                if($key === 0) {
                    echo $category->name;
                } else {
                    echo ', '.$category->name;
                }
            endforeach;
            endif;?>
        </p>
    </div>
</div>