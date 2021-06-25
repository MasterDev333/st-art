<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 */

get_header(); ?>

<main class="main">
	<div class="page-content">
		<h1 class="page-content__title h3"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
</main>

<?php
get_footer();
