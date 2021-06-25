<?php get_header(); 
?>

    <main class="main">
        <?php get_template_part('partials/back-link', '', ['link' => home_url('/artists')]) ?>
        <section class="artist-page">
            <div class="container container--padding">
                <div class="artist-page__inner">
                    <div class="artist-page__info">
                        <div>
                            <div class="artist-page__image">
                                <picture>
                                    <img src="<?php echo get_the_post_thumbnail_url('','medium_large') ? get_the_post_thumbnail_url('','medium_large') : ' ' ?>">
                                </picture>
                            </div>
                            <?php if(have_rows('social_links')) : ?>
                            <div class="artist-page__socials">
                                <?php while(have_rows('social_links')): the_row(); ?>
                                    <a class="artist-page__socials-item" href="<?php echo get_sub_field('link') ?>"><?php get_template_part('partials/svg/'.get_sub_field('type')) ?></a>
                                <?php endwhile; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h1 class="h3 artist-page__title"><?php echo get_the_title() ?></h1>
                            <div class="artist-page__image artist-page__image--mobile">
                                <picture>
                                    <img src="<?php echo get_the_post_thumbnail_url('','medium_large') ? get_the_post_thumbnail_url('','medium_large') : ' ' ?>">
                                </picture>
                            </div>
                            <p class="h4 h4--bold artist-page__country"><?php echo get_field('country') ?></p>
                            <div class="artist-page__information">
                                <?php echo get_field('information') ?>
                            </div>
                            <?php if(have_rows('social_links')) : ?>
                                <div class="artist-page__socials artist-page__socials--mobile">
                                    <?php while(have_rows('social_links')): the_row(); ?>
                                        <a class="artist-page__socials-item" href="<?php echo get_sub_field('link') ?>"><?php get_template_part('partials/svg/'.get_sub_field('type')) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $query = new Wp_Query([
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => '-1',
                        'meta_key' => 'artist',
                        'meta_value' => get_the_ID(),
                        'meta_compare' => '===',
                    ]);
                    if ($query->have_posts()) : ?>
                    <div class="artist-page__gallery">
                        <h2 class="h3 artist-page__gallery-title">Gallery</h2>
                        <div class="artist-page__gallery-list">
                        <?php
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <a href="<?php echo get_the_permalink(get_the_ID())  ?>">
                            <picture>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>">
                            </picture>
                            </a>
                            <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
		<?php 
	  $subtitle = get_field('video_tutorials_subtitle') ?: null;
	  $title = get_field('video_tutorials_title') ?: null; 
	?>
	<?php if (count(get_field('video_tutorials_videos')) > 0) : ?>
	<section class="video-tutorials-section">
	  <div class="container container--padding">
		<div id="<?php echo esc_attr($id); ?>" class="video-tutorials">
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
	</section>
	<?php endif; ?>
        <?php
        $term_obj_list = get_the_terms( $post->ID, 'artist_cat' );
        $term_slugs = wp_list_pluck($term_obj_list, 'slug');
        $exclude_ids = array($post->ID);
        $query = new WP_Query([
            'post_type' => 'artists',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'post__not_in' => $exclude_ids,
            'tax_query' => array(
                array(
                    'taxonomy' => 'artist_cat',
                    'field' => 'slug',
                    'terms' => $term_slugs
                )
            )
        ]);
        if ($query->have_posts()) {
            get_template_part('partials/related-posts', '', 
                [
                    'title' => 'Related Artists', 
                    'posts' => $query,
                    'type' => 'artists'
                ]
            );
			wp_reset_postdata(); 
        };
        ?>
    </main>

<?php get_footer(); ?>