<?php
/**
 * The template for displaying the footer
 *
 *
 */

?>

  <footer class="footer">
      <div class="container container--padding">
        <div class="footer__inner">
            <div class="footer__links">
                <h3 class="footer__title"><?php echo get_field('first_menu_title', 'options') ?: 'Discover' ?></h3>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer-first-menu',
                        'container_class' => 'footer__menu',
                    ]
                ) ?>
                <div class="footer__copyright">
                    <span class="date"><?php echo Date('Y').' © ' ?> </span><?php echo get_field('copyright','options') ?>
                </div>
            </div>
            <div class="footer__links">
                <h3 class="footer__title"><?php echo get_field('second_menu_title', 'options') ?: 'Legal' ?></h3>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer-second-menu',
                        'container_class' => 'footer__menu',
                    ]
                ) ?>
                <div class="footer__socials">
                    <?php if(have_rows('socials', 'options')): ?>
                        <?php while(have_rows('socials', 'options')): the_row(); ?>
                            <a class="social-link" href="<?php echo get_sub_field('link') ?>"><?php get_template_part('partials/svg/'.get_sub_field('type')) ?></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer__subscribe">
                <?php echo do_shortcode('[gravityform id="1" title="true" description="true" ajax="true" tabindex="49" ]') ?>

                <div class="footer__socials footer__socials--mobile">
                    <?php if(have_rows('socials', 'options')): ?>
                        <?php while(have_rows('socials', 'options')): the_row(); ?>
                            <a class="social-link" href="<?php echo get_sub_field('link') ?>"><?php get_template_part('partials/svg/'.get_sub_field('type')) ?></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="footer__copyright footer__copyright--mobile">
                    <span class="date"><?php echo Date('Y').' © ' ?> </span><?php echo get_field('copyright','options') ?>
                </div>
            </div>
        </div>
      </div>
  </footer>

 <?php if (have_rows('subscription_popup', 'options')) : 
  while (have_rows('subscription_popup', 'options')) : the_row(); 
  $image = get_sub_field('image');
  $title = get_sub_field('title');
  $desc = get_sub_field('description');
  $form = get_sub_field('form');
  ?>
  <div class="popup" id="subscribe_popup">
      <div class="popup-content">
         
         <button class="popup-close">
            <img src="<?php echo get_template_directory_uri() . '/img/icons/icon_close.svg'; ?>" alt="">
         </button>
         <?php if ($image) : ?>
            <div class="popup-image" style="background-image: url(<?php echo $image['url']; ?>)"></div>
        <?php endif; ?>
         <div class="popup-body">
             <?php if ($title) : ?>
            <h2 class="popup-title"><?php echo $title; ?></h2>
            <?php endif; 
            if ($desc) : ?>
            <div class="popup-desc">
                <?php echo $desc; ?>
            </div>
            <?php endif; 
            if ($form) : 
                echo do_shortcode($form);
            endif;
            ?>
        </div>
     </div>
  </div>
    <?php endwhile; 
  endif; ?>     

  <?php wp_footer(); ?>

  
  </body>
</html>