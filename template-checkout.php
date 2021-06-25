<?php /* Template Name: Checkout Page */ ?>

<?php get_header(); ?>

<main class="main">
    <?php get_template_part('partials/back-link') ?>
    <section class="checkout-page">
        <div class="container container--padding">
            <div class="checkout-page__inner">
                <h1 class="h3 checkout-page__title"><?php echo get_the_title() ?></h1>
                <?php the_content() ?>
            </div>
            <div class="checkout-page__select-dropdown"></div>
        </div>
    </section>
</main>

<?php get_footer(); ?>