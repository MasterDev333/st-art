<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input class="search-form__input" type="text" placeholder="Search artworks, artists, events" value="<?php echo get_search_query() ?>" name="s" id="s" />
    <button class="search-form__button" type="submit" id="searchsubmit">
        <?php get_template_part('partials/svg/search-svg') ?>
    </button>
</form>