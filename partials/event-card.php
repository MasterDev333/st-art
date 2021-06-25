<div class="event-card">
    <div class="event-card__image">
        <a href="<?php echo get_the_permalink() ?>">
            <picture>
                <img src="<?php echo get_the_post_thumbnail_url('','medium_large') ? get_the_post_thumbnail_url('','medium_large') : ' ' ?>">
            </picture>
        </a>
    </div>
    <div class="event-card__info">
        <h3 class="h4 h4--bold event-card__title"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
        <?php echo tribe_events_event_schedule_details( $post->ID, '<p class="event-card__date">', '</p>' ); ?>
    </div>
</div>