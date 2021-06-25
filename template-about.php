<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>

  <main class="main">
    <section class="about-st-art">
      <div class="container container--padding">
        <div class="about-st-art__inner">
          <h1 class="h3 about-st-art__title"><?php echo get_field('about_title', get_page_by_path('about')) ?></h1>
          <div class="about-st-art__description"><?php echo get_field('about_subtitle', get_page_by_path('about')) ?></div>
        </div>
      </div>
      <?php echo the_content();  ?>
    </section>
    <section class="our-team">
      <div class="container container--padding">
        <div class="our-team__inner">
          <h3 class="h3 our-team__title"><?php echo get_field('our_team_title', get_page_by_path('about')) ?></h3>
          <div
              class="our-team__description"><?php echo get_field('our_team_subtitle', get_page_by_path('about')) ?></div>
          <?php
          $query = new Wp_Query([
            'post_type' => 'team',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'order' => 'ASC'
          ]);
          if ($query->have_posts()) :
            ?>
            <div class="our-team__gallery">
              <?php
              while ($query->have_posts()) :
                $query->the_post();
                ?>
                <div class="our-team-card">
                  <div class="our-team-card__image">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>">
                  </div>
                  <div class="our-team-card__title-wrap">
                    <span class="our-team-card__title"><?php echo the_title(); ?></span>
                    <span class="our-team-card__arrow">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle r="11" transform="matrix(-1 0 0 1 11 11)" fill="#EAEBEC"/>
                          <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.25927 7.36305C8.97288 7.64943 8.97288 8.11375 9.25927 8.40014L12.6222 11.763C12.9086 12.0494 13.3729 12.0494 13.6593 11.763C13.9457 11.4767 13.9457 11.0123 13.6593 10.726L10.2964 7.36305C10.01 7.07666 9.54565 7.07666 9.25927 7.36305Z"
                                fill="#3A56A5"/>
                          <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.25927 15.126C8.97288 14.8396 8.97288 14.3753 9.25927 14.0889L12.6222 10.726C12.9086 10.4396 13.3729 10.4396 13.6593 10.726C13.9457 11.0124 13.9457 11.4767 13.6593 11.7631L10.2964 15.126C10.01 15.4124 9.54565 15.4124 9.25927 15.126Z"
                                fill="#3A56A5"/>
                        </svg>
                      </span>
                  </div>
                  <span class="our-team-card__subtitle"><?php echo get_field('subtitle') ?></span>

                  <div class="teammate-popup-wrap">
                    <div class="teammate-popup">
                      <span class="teammate-popup__close teammate-popup__close-js">
                        <img src="<?php echo get_template_directory_uri() . '/img/icons/icon_close.svg'; ?>" alt="" />
                      </span>
                      <div class="teammate-popup__image">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>">
                      </div>
                      <div class="teammate-popup__info">
                        <h3 class="teammate-popup__title"><?php echo the_title(); ?></h3>
                        <span class="teammate-popup__subtitle"><?php echo get_field('subtitle') ?></span>
                        <p class="teammate-popup__desc"><?php echo get_field('description') ?></p>
                        <div class="teammate-popup__socials">
                           <?php if (have_rows('socials')): ?>
                              <?php while (have_rows('socials')) : the_row(); ?>
                                <?php
                                $link = get_sub_field('link');
                                if ($link) :
                                ?>
                                <a target="_blank" href="<?php echo $link['url']; ?>" class="teammate-popup__social">
                                
                                  <?php if($link['title'] == 'Instagram'): ?>
                                    <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M16.4251 25.0428C14.0949 25.0428 11.8177 25.0428 9.48748 25.0428C9.43452 25.0428 9.38156 25.0428 9.27564 25.0428C8.53421 25.0428 7.73983 24.99 6.9984 24.9372C6.36289 24.8843 5.72739 24.7259 5.14484 24.5146C3.34423 23.8808 2.12618 22.6661 1.38476 20.9231C1.01404 20.0252 0.855164 19.0217 0.802205 18.071C0.749246 17.4372 0.749251 16.8563 0.749251 16.2225C0.749251 16.064 0.749248 15.9056 0.696289 15.7471C0.696289 13.8457 0.696289 11.9443 0.696289 10.0429C0.696289 9.99013 0.696289 9.99013 0.696289 9.93731C0.696289 9.35633 0.749251 8.77535 0.749251 8.19437C0.749251 7.56057 0.802204 6.92678 0.908122 6.3458C1.067 5.60637 1.27884 4.91975 1.59659 4.23314C2.33802 2.8071 3.50312 1.8564 4.98597 1.27542C5.83331 0.958524 6.73361 0.800075 7.63392 0.747258C8.58718 0.694442 9.48747 0.694443 10.4407 0.694443C11.5529 0.694443 12.718 0.694443 13.8301 0.694443C15.0482 0.694443 16.2662 0.694442 17.4843 0.747258C18.1198 0.800075 18.7553 0.800074 19.3908 0.905707C20.1322 1.06416 20.8207 1.27542 21.5092 1.59232C22.9391 2.33175 23.8923 3.49371 24.4749 4.97257C24.7926 5.81763 24.9515 6.71551 25.0044 7.6662C25.0574 8.24719 25.0574 8.82817 25.0574 9.40915C25.0574 9.62041 25.0574 9.77886 25.0574 9.99013C25.0574 11.8915 25.0574 13.7929 25.0574 15.6943C25.0574 15.7471 25.0574 15.7999 25.0574 15.8527C25.0574 16.3809 25.0574 16.8563 25.0044 17.3844C25.0044 17.9126 24.9515 18.4408 24.8985 18.9689C24.7926 19.6027 24.6867 20.1837 24.4219 20.7647C23.8394 22.3492 22.7802 23.4583 21.2444 24.1977C20.2911 24.6203 19.3378 24.8315 18.2787 24.9372C17.6961 24.99 17.1136 24.99 16.4781 24.99C16.6369 25.0428 16.531 25.0428 16.4251 25.0428ZM12.9828 2.85991C11.9765 2.85991 11.0233 2.85991 10.0171 2.85991C9.11677 2.85991 8.1635 2.85991 7.2632 2.96555C6.73361 3.01836 6.20402 3.124 5.67443 3.33526C4.72117 3.70498 4.0327 4.33877 3.55607 5.23665C3.23832 5.81763 3.07944 6.45143 3.02648 7.08523C2.97352 7.56057 2.97352 8.03592 2.92056 8.51127C2.92056 9.46196 2.86761 10.4127 2.86761 11.4162C2.86761 12.8422 2.86761 14.2683 2.86761 15.7471C2.86761 16.645 2.86761 17.5957 2.97353 18.4936C3.02648 19.0217 3.1324 19.5499 3.34424 20.0781C3.71495 21.0288 4.35046 21.7154 5.30372 22.1907C5.88627 22.5076 6.52177 22.6661 7.15728 22.7189C7.63391 22.7717 8.11054 22.7717 8.58717 22.8245C9.54043 22.8245 10.4407 22.8773 11.394 22.8773C12.9298 22.8773 14.4656 22.8773 16.0014 22.8773C16.8488 22.8773 17.6961 22.8245 18.5435 22.7717C19.073 22.7189 19.6026 22.6132 20.0793 22.402C21.1385 21.9794 21.9328 21.24 22.3565 20.1837C22.6213 19.5499 22.7272 18.8633 22.7802 18.1239C22.8331 17.5957 22.8331 17.0675 22.8331 16.5922C22.8331 15.9056 22.8331 15.1661 22.8331 14.4795C22.8331 13.1591 22.8331 11.8387 22.8331 10.5183C22.8331 9.5676 22.8331 8.66972 22.7802 7.71902C22.7272 7.19086 22.6743 6.71551 22.5683 6.18735C22.3565 5.28947 21.8799 4.55004 21.1914 3.96906C20.7148 3.59934 20.1852 3.33526 19.5497 3.17681C18.9671 3.01836 18.3316 2.96555 17.7491 2.91273C16.8488 2.85991 15.9485 2.85991 15.1011 2.85991C14.4656 2.85991 13.7242 2.85991 12.9828 2.85991Z" fill="#060708"/>
                                      <path d="M12.9828 19.1275C9.48749 19.1275 6.68066 16.3282 6.68066 12.8423C6.68066 9.40926 9.54044 6.60999 12.9828 6.60999C16.4251 6.60999 19.2319 9.46207 19.2319 12.948C19.2319 16.3282 16.4251 19.1275 12.9828 19.1275ZM12.9828 8.77546C10.7055 8.77546 8.90494 10.5712 8.90494 12.8423C8.90494 15.0606 10.7055 16.9092 12.9828 16.9092C15.2071 16.9092 17.0606 15.1134 17.0606 12.8423C17.0606 10.624 15.2071 8.77546 12.9828 8.77546Z" fill="#060708"/>
                                      <path d="M19.4965 7.8246C18.7021 7.8246 18.0137 7.1908 18.0137 6.34574C18.0137 5.55349 18.6492 4.86688 19.4965 4.86688C20.2909 4.86688 20.9794 5.50068 20.9794 6.34574C20.9794 7.13799 20.2909 7.8246 19.4965 7.8246Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                  <?php if($link['title'] == 'Facebook'): ?>
                                    <svg width="13" height="25" viewBox="0 0 13 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M3.4677 25H8.33213V12.742H11.732L12.0981 8.63847H8.33213C8.33213 8.63847 8.33213 7.11279 8.33213 6.32365C8.33213 5.37668 8.54135 4.95581 9.43055 4.95581C10.1628 4.95581 12.0458 4.95581 12.0458 4.95581V0.694443C12.0458 0.694443 9.27363 0.694443 8.69827 0.694443C5.08918 0.694443 3.4677 2.27273 3.4677 5.37668C3.4677 8.05976 3.4677 8.63847 3.4677 8.63847H0.957031V12.7946H3.4677V25Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                  <?php if($link['title'] == 'Pinterest'): ?>
                                    <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M3.82465 14.8029C4.13412 14.9097 4.39203 14.8029 4.49519 14.4288C4.54677 14.1616 4.7015 13.5737 4.75308 13.3065C4.85624 12.9324 4.80466 12.8255 4.54677 12.5049C4.03098 11.8636 3.66992 11.0085 3.66992 9.7794C3.66992 6.2523 6.19729 3.09929 10.272 3.09929C13.8826 3.09929 15.8426 5.39725 15.8426 8.44338C15.8426 12.4515 14.1405 15.8717 11.5615 15.8717C10.1689 15.8717 9.08574 14.6425 9.44679 13.1996C9.85942 11.4361 10.6331 9.5122 10.6331 8.28306C10.6331 7.1608 10.0657 6.19886 8.82783 6.19886C7.38362 6.19886 6.24888 7.74865 6.24888 9.7794C6.24888 11.1154 6.6615 11.9705 6.6615 11.9705C6.6615 11.9705 5.16571 18.4368 4.90781 19.5591C4.39202 21.8036 4.80465 24.5826 4.85623 24.8498C4.85623 25.0101 5.06255 25.0635 5.16571 24.9032C5.32045 24.7429 7.02257 22.5518 7.58994 20.3607C7.74467 19.7194 8.51836 16.513 8.51836 16.513C8.98257 17.4215 10.3752 18.2231 11.8194 18.2231C16.1521 18.2231 19.0921 14.1616 19.0921 8.65715C19.0921 4.54219 15.7394 0.694443 10.5815 0.694443C4.18571 0.694443 0.987793 5.45069 0.987793 9.40532C1.09095 11.8636 1.9678 14.0012 3.82465 14.8029Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                  <?php if($link['title'] == 'Youtube'): ?>
                                    <svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M26.96 2.96961C26.6399 1.82826 25.7331 0.998187 24.6129 0.686909C22.5324 0.168113 14.2641 0.168113 14.2641 0.168113C14.2641 0.168113 5.94244 0.116233 3.86202 0.63503C2.7418 0.946307 1.83495 1.82826 1.51489 2.96961C0.981445 4.99292 0.981445 9.19517 0.981445 9.19517C0.981445 9.19517 0.981445 13.3974 1.51489 15.4207C1.83495 16.5621 2.7418 17.3922 3.86202 17.7034C5.94244 18.2222 14.2108 18.2222 14.2108 18.2222C14.2108 18.2222 22.5324 18.2222 24.5595 17.7034C25.6797 17.3922 26.5866 16.5102 26.9067 15.4207C27.4401 13.3974 27.4401 9.19517 27.4401 9.19517C27.4401 9.19517 27.4934 4.99292 26.96 2.96961ZM11.5436 13.0343V5.35608L18.4783 9.19517L11.5436 13.0343Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                  <?php if($link['title'] == 'Twitter'): ?>
                                    <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.331055 15.5286C2.29341 16.7912 4.62702 17.5278 7.11974 17.5278C15.3404 17.5278 20.0076 10.6359 19.6894 4.48064C20.538 3.84933 21.2805 3.1128 21.9169 2.21844C21.1214 2.58671 20.2728 2.79714 19.3712 2.90236C20.2728 2.37627 20.9623 1.48191 21.3335 0.482327C20.485 1.00842 19.5303 1.37669 18.5226 1.53452C17.7271 0.692765 16.5603 0.166672 15.2874 0.166672C12.4234 0.166672 10.3019 2.79714 10.9914 5.58544C7.33188 5.42761 4.04362 3.63889 1.86912 1.00842C0.702312 3.00758 1.28571 5.58544 3.24807 6.84807C2.50556 6.84807 1.81608 6.63763 1.23268 6.32197C1.17964 8.37374 2.66467 10.2677 4.78613 10.6886C4.14969 10.8464 3.46021 10.899 2.77074 10.7412C3.35414 12.4773 4.94524 13.7399 6.90759 13.7925C5.05131 15.1604 2.7177 15.7917 0.331055 15.5286Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                  <?php if($link['title'] == 'Linkedin'): ?>
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M5.36098 7.45483H1.17725V20.923H5.36098V7.45483Z" fill="#060708"/>
                                      <path d="M3.2957 5.65918C4.67263 5.65918 5.78477 4.55004 5.78477 3.17681C5.78477 1.80359 4.67263 0.694443 3.2957 0.694443C1.91877 0.694443 0.806641 1.80359 0.806641 3.17681C0.806641 4.55004 1.91877 5.65918 3.2957 5.65918Z" fill="#060708"/>
                                      <path d="M12.0869 13.8457C12.0869 11.9443 12.9872 10.8352 14.6289 10.8352C16.1647 10.8352 16.9062 11.9443 16.9062 13.8457C16.9062 15.7999 16.9062 20.9231 16.9062 20.9231H21.0899C21.0899 20.9231 21.0899 16.0112 21.0899 12.3669C21.0899 8.77535 19.0245 7.03241 16.1647 7.03241C13.305 7.03241 12.0869 9.2507 12.0869 9.2507V7.45494H8.06201V20.9231H12.0869C12.0869 20.9231 12.0869 15.9056 12.0869 13.8457Z" fill="#060708"/>
                                    </svg>
                                  <?php endif; ?>
                                </a>
                                <?php endif; ?>
                              <?php endwhile; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              endwhile;
              wp_reset_query();
              ?>
            </div>
          <?php
          endif; ?>
        </div>
      </div>
    </section>
	<?php 
	  $subtitle = get_field('video_tutorials_subtitle') ?: null;
	  $title = get_field('video_tutorials_title') ?: null; 
	?>
	<?php if (count(get_field('video_tutorials_videos')) > 0) : ?>
	<section class="video-tutorials-section">
	  <div class="container container--padding">
		<div id="<?php echo esc_attr($id); ?>" class="video-tutorials">
		  <?php if ($title): ?>
			<h3 class="h3 video-tutorials__title"><?php echo $title ?></h3>
		  <?php endif; ?>
		  <?php if ($subtitle): ?>
			<p class="video-tutorials__subtitle"><?php echo $subtitle ?></p>
		  <?php endif; ?>

		  <?php if (have_rows('video_tutorials_videos')): ?>
			<div class="video-tutorials__block">
			  <?php while (have_rows('video_tutorials_videos')) : the_row(); ?>
				<?php
				$image = get_sub_field('video_image');
				$link = get_sub_field('video_link');
				?>
				<div class="video-tutorials__image" data-src="<?php echo $link; ?>">
				  <?php if ($image): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
				  <?php else: ?>
					<iframe src="<?php echo $link; ?>" frameborder="0"
					allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
				  <?php endif; ?>
				</div>
			  <?php endwhile; ?>
			</div>
		  <?php endif; ?>
		  </div>
	  	</div>
	  <div class="video-tutorials-popup">
		<span class="video-tutorials-popup__close">
		  <svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M29.0002 2.12132L3.00023 28.1213L0.878906 26L26.8789 -6.27344e-07L29.0002 2.12132Z" fill="#fff"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0.999773 2.24263L26.9998 28.2426L29.1211 26.1213L3.12109 0.121307L0.999773 2.24263Z" fill="#fff"/>
		  </svg>
		</span>
		<div class="video-tutorials-popup__iframe">
		  <iframe src="" frameborder="0"
				  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
				  allowfullscreen></iframe>
		</div>
	  </div>
	</section>
	<?php endif; ?>
  </main>

<?php get_footer(); ?>