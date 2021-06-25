<?php /* Template Name: Calendar Page */ ?>

<?php get_header(); ?>

<main class="main">
    <section class="blog-page">
        <div class="container container--padding">
            <div class="blog-page__inner">
                <h1 class="h3 blog-page__title"><?php echo get_the_title() ?></h1>
                <p class="blog-page__description"><?php the_field('description') ?></p>
                <?php
                $view = $_GET['view'] ?: 'month';
                $cat = ($_GET['cat'] == 'all') ? '' : $_GET['cat'];
				$location = ($_GET['location'] == '') ? 'all' : $_GET['location'];
                ?>
                <div class="blog-page__calendar-filters">
                    <h2 class="h5 h5--bold">Filters</h2>
					<div class="blog-page__calendar-filter">
						<h3 class="h5">Location</h3>
                        <div class="radio-input">
                            <input type="radio" name="location-filter" id="location-filter-1" value="online" <?php if($location == 'online'): echo 'checked'; endif; ?>><label for="location-filter-1">Online</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter" id="location-filter-2" value="amsterdam" <?php if($location == 'amsterdam'): echo 'checked'; endif; ?>><label for="location-filter-2">Amsterdam</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter" id="location-filter-3" value="milan" <?php if($location == 'milan'): echo 'checked'; endif; ?>><label for="location-filter-3">Milan</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter" id="location-filter-4" value="paris" <?php if($location == 'paris'): echo 'checked'; endif; ?>><label for="location-filter-4">Paris</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter" id="location-filter-5" value="saint moritz" <?php if($location == 'saint moritz'): echo 'checked'; endif; ?>><label for="location-filter-5">Saint Moritz</label>
                        </div>
					</div>
                    <div class="blog-page__calendar-filter">
                        <h3 class="h5">Category</h3>
                        <?php
                        $terms = get_terms( [
                            'taxonomy' => 'tribe_events_cat',
                            'hide_empty' => false,
                            'parent' => 0,
                        ] );
                        foreach ($terms as $term) :?>
                        <div class="radio-input">
                            <input type="radio" name="category-filter" id="category-filter-<?php echo $term->slug ?>" value="<?php echo $term->slug ?>" <?php if($cat == $term->slug): echo 'checked'; endif; ?>><label for="category-filter-<?php echo $term->slug ?>"><?php echo $term->name ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="blog-page__calendar-filter">
                        <h3 class="h5">View</h3>
                        <div class="radio-input">
                            <input type="radio" name="view-filter" id="view-filter-1" value="month" <?php if($view == 'month'): echo 'checked'; endif; ?>><label for="view-filter-1">Monthly</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="view-filter" id="view-filter-2" value="week" <?php if($view == 'week'): echo 'checked'; endif; ?>><label for="view-filter-2">Weekly</label>
                        </div>
                    </div>
                </div>
                <div class="blog-page__calendar-filters-mobile">
                    <div class="blog-page__calendar-filters-mobile__icon filters">
                        <?php get_template_part('partials/svg/filters') ?>
                    </div>
                    <div class="blog-page__calendar-filters-mobile__icon view">
                        <?php get_template_part('partials/svg/view') ?>
                    </div>
                    <div class="blog-page__calendar-filters-mobile__dropdown filters-dropdown">
                        <?php get_template_part('partials/svg/link-arrow') ?>
                        <h3 class="h5 h5--bold">Filter by</h3>

						<h3 class="h5">Location</h3>
                        <div class="radio-input">
                            <input type="radio" name="location-filter-mobile" id="location-filter-mobile-1" value="online" <?php if($location == 'online'): echo 'checked'; endif; ?>><label for="location-filter-mobile-1">Online</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter-mobile" id="location-filter-mobile-2" value="amsterdam" <?php if($location == 'amsterdam'): echo 'checked'; endif; ?>><label for="location-filter-mobile-2">Amsterdam</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter-mobile" id="location-filter-mobile-3" value="milan" <?php if($location == 'milan'): echo 'checked'; endif; ?>><label for="location-filter-mobile-3">Milan</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter-mobile" id="location-filter-mobile-4" value="paris" <?php if($location == 'paris'): echo 'checked'; endif; ?>><label for="location-filter-mobile-4">Paris</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="location-filter-mobile" id="location-filter-5" value="saint moritz" <?php if($location == 'saint moritz'): echo 'checked'; endif; ?>><label for="location-filter-mobile-5">Saint Moritz</label>
                        </div>
                        <h4 class="h5">Category</h4>
                        <?php
                        $terms = get_terms( [
                            'taxonomy' => 'tribe_events_cat',
                            'hide_empty' => false,
                            'parent' => 0,
                        ] );
                        foreach ($terms as $term) :?>
                            <div class="radio-input">
                                <input type="radio" name="category-filter-mobile" id="category-filter-mobile-<?php echo $term->slug ?>" value="<?php echo $term->slug ?>" <?php if($cat == $term->slug): echo 'checked'; endif; ?>><label for="category-filter-mobile-<?php echo $term->slug ?>"><?php echo $term->name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="blog-page__calendar-filters-mobile__dropdown view-dropdown">
                        <?php get_template_part('partials/svg/link-arrow') ?>
                        <h3 class="h5 h5--bold">View by</h3>
                        <div class="radio-input">
                            <input type="radio" name="view-filter-mobile" id="view-filter-mobile-1" value="month" <?php if($view == 'month'): echo 'checked'; endif; ?>><label for="view-filter-mobile-1">Monthly</label>
                        </div>
                        <div class="radio-input">
                            <input type="radio" name="view-filter-mobile" id="view-filter-mobile-2" value="week" <?php if($view == 'week'): echo 'checked'; endif; ?>><label for="view-filter-mobile-2">Weekly</label>
                        </div>
                    </div>
                </div>
                <div class="blog-page__calendar">
                    <?php if($location === 'all') :
                    echo do_shortcode('[tribe_events view="'.$view.'" category="'.$cat.'" ]');
                    elseif ($location === 'online') :
                    	echo do_shortcode('[tribe_events view="'.$view.'" category="'.$cat.'" featured="true" ]');
					else:
                    	echo do_shortcode('[tribe_events view="'.$view.'" category="'.$cat.'" featured="false" keyword="' . $location . '" ]');
                    endif;
                    ?>
                    <?php if($_GET['type'] === 'offline'): //?>
                        <style>
                            .tribe-events-calendar-month__calendar-event--featured {
                                display: none !important;
                            }

                            .tribe-events-calendar-month-mobile-events__mobile-event--featured {
                                display: none !important;
                            }

                            .tribe-events-pro-week-grid__event--featured {
                                display: none !important;
                            }

                            .tribe-events-pro-week-mobile-events__event--featured {
                                display: none !important;
                            }
                        </style>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>