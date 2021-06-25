<section class="related-posts">
    <div class="container container--padding">
        <div class="related-posts__inner">
            <h2 class="h3 related-posts__title"><?php echo $args['title'] ?></h2>
            <?php if($args['type'] === 'artists') : ?>
            <div class="related-posts__list related-posts__list--artists">
                <?php while ($args['posts']->have_posts()) : $args['posts']->the_post(); ?>
                    <?php get_template_part('partials/artist-card'); ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
            <?php if($args['type'] === 'artworks') : ?>
                <div class="related-posts__list related-posts__list--artworks">
                    <?php 
					while ($args['posts']->have_posts()) : $args['posts']->the_post(); ?>
                        <?php get_template_part('woocommerce/content-product'); ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>