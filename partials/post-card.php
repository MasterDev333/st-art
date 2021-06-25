<div class="post-card">
    <div class="post-card__image">
        <a href="<?php echo get_the_permalink() ?>">
            <picture>
                <img src="<?php echo get_the_post_thumbnail_url('','medium_large') ? get_the_post_thumbnail_url('','medium_large') : ' ' ?>">
            </picture>
        </a>
    </div>
    <div class="post-card__info">
        <p class="post-card__category">
        <?php ?>
        <?php foreach (get_the_category() as $category) : ?>
            <span>
                <?php echo $category->name ?>
            </span>
        <?php endforeach; ?>
        </p>
        <h3 class="h4 h4--bold post-card__title"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
        <p class="post-card__excerpt"><?php echo get_the_excerpt() ?></p>
    </div>
</div>