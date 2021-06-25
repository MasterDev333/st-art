<?php get_header(); ?>

    <main class="main">
        <section class="blog-page">
            <div class="container container--padding">
                <div class="blog-page__inner">
                    <h1 class="h3 blog-page__title"><?php echo get_field('title', get_page_by_path('artists-page')) ?></h1>
                    <p class="blog-page__description"><?php echo get_field('description', get_page_by_path('artists-page')) ?></p>
                    <div class="blog-page__filter">
                    <h2 class="h4 h4--bold blog-page__menu-title"><?php echo get_field('menu_title', get_page_by_path('artists-page')) ?></h2>
                    <div class="clear-filter">
                    <a class="clear-filter__btn">Clear Filter</a>
                    </div>
                    <div class="blog-page__filtering">
                        <?php
                            $terms = get_terms( [
                                'taxonomy' => 'artist_cat',
                                'hide_empty' => false,
                                'parent' => 0,
                            ] );
                            if($terms):
                        ?>
                            <?php foreach ($terms as $term) : ?>
                                <div class="filtering-item">
                                    <a href="#" data-item="<?php echo $term->slug ?>"><?php echo $term->name ?></a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    </div>
                    <div class="blog-page__post-list artists">
                        <div class="loader-section"><div class="loader"></div></div>
                    </div>
                    <p class="blog-page__loadMore">
                        <a href="#">
                            Load more
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle r="10.3235" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 10.3269 10.3234)" fill="#EAEBEC"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7406 8.6888C13.4718 8.42003 13.036 8.42003 12.7673 8.6888L9.61115 11.8449C9.34238 12.1137 9.34238 12.5494 9.61115 12.8182C9.87992 13.087 10.3157 13.087 10.5845 12.8182L13.7406 9.66212C14.0093 9.39334 14.0093 8.95758 13.7406 8.6888Z" fill="#3A56A5"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45573 8.6888C6.7245 8.42003 7.16027 8.42003 7.42904 8.6888L10.5851 11.8449C10.8539 12.1137 10.8539 12.5494 10.5851 12.8182C10.3164 13.087 9.8806 13.087 9.61183 12.8182L6.45573 9.66212C6.18695 9.39334 6.18695 8.95758 6.45573 8.6888Z" fill="#3A56A5"/>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>