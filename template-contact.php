<?php /* Template Name: Contact Page */ ?>

<?php
$subtitle = get_field('contact_subtitle');
$contactDesc = get_field('contact_description');
$faqTitle = get_field('faq_title');
$faqSubtitle = get_field('faq_subtitle');
get_header();
?>

  <main class="main">
    <section class="contact-us">
      <div class="container container--padding">
        <div class="contact-us__inner">
          <h1 class="h3 contact-us__title"><?php echo the_title() ?></h1>
          <div class="contact-us__description"><?php echo $subtitle; ?></div>

          <div class="contact-gallery">
            <?php if (have_rows('contact_info')): ?>
              <?php while (have_rows('contact_info')) : the_row(); ?>
                <?php
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $desc = get_sub_field('description');
                $link = get_sub_field('link');
                ?>
                <div class="contact-gallery__card">
                  <div class="contact-gallery__image">
                    <?php if ($image): ?>
                      <img src="<?php echo($image['url']); ?>">
                    <?php endif; ?>
                  </div>

                  <?php if ($title): ?>
                    <span class="contact-gallery__title"><?php echo $title; ?></span>
                  <?php endif; ?>
                  <?php if ($desc): ?>
                    <p class="contact-gallery__desc"><?php echo $desc; ?></p>
                  <?php endif; ?>
                  <?php if ($link): ?>
                    <a class="contact-gallery__link" href="<?php echo $link['url']; ?>">
                      <?php echo $link['title']; ?>
                      <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle r="10.3235" transform="matrix(-1 0 0 1 10.3269 10.3235)" fill="#EAEBEC"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68978 6.91007C8.42101 7.17885 8.42101 7.61461 8.68978 7.88338L11.8459 11.0395C12.1147 11.3083 12.5504 11.3083 12.8192 11.0395C13.088 10.7707 13.088 10.3349 12.8192 10.0662L9.66309 6.91007C9.39432 6.6413 8.95855 6.6413 8.68978 6.91007Z" fill="#3A56A5"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.68978 14.1956C8.42101 13.9269 8.42101 13.4911 8.68978 13.2223L11.8459 10.0662C12.1147 9.79746 12.5504 9.79746 12.8192 10.0662C13.088 10.335 13.088 10.7708 12.8192 11.0395L9.66309 14.1956C9.39432 14.4644 8.95855 14.4644 8.68978 14.1956Z" fill="#3A56A5"/>
                      </svg>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </section>

    <section class="faq">
      <div class="container container--padding">
        <div class="faq__inner">
          <?php if ($faqTitle): ?>
            <h1 class="h3 faq__title"><?php echo $faqTitle; ?></h1>
          <?php endif; ?>
          <?php if ($faqSubtitle): ?>
            <p class="faq__description"><?php echo $faqSubtitle; ?></p>
          <?php endif; ?>

          <div class="faq-accordeon">
            <?php if (have_rows('faq')): ?>
              <?php while (have_rows('faq')) : the_row(); ?>
                <?php
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
                ?>
                <div class="faq-accordeon__card">

                  <?php if ($question): ?>
                    <span class="faq-accordeon__question">
                      <?php echo $question; ?>
                      <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle r="14" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 14 14)" fill="#EAEBEC"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.6287 11.781C18.2642 11.4165 17.6733 11.4165 17.3088 11.781L13.0287 16.0611C12.6642 16.4256 12.6642 17.0165 13.0287 17.381C13.3932 17.7455 13.9842 17.7455 14.3486 17.381L18.6287 13.1009C18.9932 12.7364 18.9932 12.1455 18.6287 11.781Z" fill="#3A56A5"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.74824 11.781C9.11273 11.4165 9.70368 11.4165 10.0682 11.781L14.3482 16.0611C14.7127 16.4256 14.7127 17.0165 14.3482 17.381C13.9837 17.7455 13.3928 17.7455 13.0283 17.381L8.74824 13.1009C8.38375 12.7364 8.38375 12.1455 8.74824 11.781Z" fill="#3A56A5"/>
                      </svg>
                    </span>
                  <?php endif; ?>
                  <?php if ($answer): ?>
                    <div class="faq-accordeon__answer"><?php echo $answer; ?></div>
                  <?php endif; ?>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </section>

    <section class="contact-form">
      <div class="container container--padding">
        <div class="contact-form__inner">

          <?php if ($contactDesc): ?>
            <p class="contact-form__description"><?php echo $contactDesc; ?></p>
          <?php endif; ?>

          <div class="contact-form__form">
            <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]') ?>
          </div>

        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>