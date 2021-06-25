<?php get_header(); ?>

<?php global $post; $author = get_user_by('id', $post->post_author)->display_name; ?>

<main class="main">
    <?php get_template_part('partials/back-link', '', ['link' => get_permalink( get_page_by_path('blog') )]) ?>
    <section class="post-page-header">
        <div class="container container--padding">
            <div class="post-page-header__inner">
                <div class="post-page-header__image">
                    <picture>
                        <img src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : ' ' ?>">
                    </picture>
                </div>
                <div class="post-page-header__info">
                    <p><?php echo get_the_date('j F Y') ?></p>
                    <p class="post-page-header__author">by <?php echo $author ?></p>
                    <div class="share-block">Share <?php echo do_shortcode('[addtoany]'); ?></div>
                </div>
            </div>
        </div>
    </section>
    <section class="post-page">
        <div class="container container--padding">
            <div class="post-page__inner">
                <h1 class="h3 post-page__title"><?php echo get_the_title() ?></h1>
                <div class="post-page__content">
                    <?php the_content() ?>
                </div>
                <div class="post-page__tags">
                    <p><span>Tags</span> <?php echo get_the_tag_list() ?></p>
                </div>
                <div class="post-page__share">
                    <div class="share-block">Share <?php echo do_shortcode('[addtoany]'); ?></div>
                </div>
            </div>
        </div>
        <section class="about-st-art">
            <div class="container container--padding">
                <div class="latest-news">
                    
                    <h3 class="h3 latest-news__title">Related Posts</h3>

                    <div class="latest-news__block">
                        <?php
                            $term_obj_list = get_the_terms( $post->ID, 'category' );
                            $term_slugs = wp_list_pluck($term_obj_list, 'slug');
                            $exclude_ids = array($post->ID);

                            $postArgs = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'post__not_in' => $exclude_ids,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'slug',
                                        'terms' => $term_slugs,
                                    )
                                )
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
    </section>

</main>

<?php get_footer(); ?>