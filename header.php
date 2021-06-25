<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and start of the <body> section
 *
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
	  <meta name="facebook-domain-verification" content="8fc9orte27mbhxwwvojk38li6seq8r" />
	  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M4VTB25');</script>
<!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
	  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4VTB25"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <header class="header">
        <div class="container container--padding">
            <div class="header__inner">
                <div class="header__mobile-button">
                    <div class="mobile-menu-button">
                        <?php get_template_part('partials/svg/mobile-menu-button') ?>
                    </div>
                    <div class="mobile-menu-close hidden">
                        <?php get_template_part('partials/svg/times') ?>
                    </div>
                </div>
                <div class="header__logo">
                    <?php the_custom_logo(); ?>
                </div>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'header-menu',
                        'container_class' => 'header__menu',
                    ]
                ) ?>
                <div class="header__right">
                    <div class="header__search">
                        <?php get_search_form() ?>
                    </div>
                    <a href="#" class="header__cart"><?php get_template_part('partials/svg/cart-svg') ?></a>
                </div>
                <div class="header__mobile-button">
                    <div class="mobile-search-button">
                        <?php get_template_part('partials/svg/search-svg-2') ?>
                    </div>
                    <a class="mobile-cart-button hidden">
                        <?php get_template_part('partials/svg/cart-svg') ?>
                    </a>
                    <div class="mobile-search-close hidden">
                        <?php get_template_part('partials/svg/times') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__mobile-menu">
            <?php wp_nav_menu(
                [
                    'theme_location' => 'header-menu',
                    'container_class' => 'mobile-menu',
                ]
            ) ?>
            <div class="socials">
                <?php if(have_rows('socials', 'options')): ?>
                    <?php while(have_rows('socials', 'options')): the_row(); ?>
                        <a class="social-link" href="<?php echo get_sub_field('link') ?>"><?php get_template_part('partials/svg/'.get_sub_field('type')) ?></a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="header__mobile-search">
            <?php get_search_form() ?>
        </div>
        <div class="cart-wrapper">
            <div class="widget_shopping_cart_content"></div>
        </div>
    </header>
