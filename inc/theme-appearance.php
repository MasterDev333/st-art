<?php
/**
* Customise the log-in page and admin dashboard area logo 
*/

function my_login_logo() { /*?>
  <style type="text/css">
   #login h1 a, .login h1 a {
    background-image: url(<?php echo get_template_directory_uri().'/img/Logo.svg' ?>);
    height:auto;
    width:320px;
    background-size: contain;
    background-repeat: no-repeat;
    padding-bottom: 50px;
  }
  body.login {
    background: #f4f3ee;
  }
  body.login form {
    background: linear-gradient(180deg, #fbd66e, #eb7449);
    box-shadow: 0 5px 30px 0 rgba(255, 255, 255, 0.17);
  }

  body.login form label {
    color: #333333;
  }

  body.login form input[type="text"],
  body.login form input[type="password"],
  body.login form input[type="checkbox"] {
    background: #f4f3ee !important;
  }
  body.login form input[type="submit"] {
    background: #fbd66e !important;
    border-color: #333333 !important;
    transition: all 0.4s ease !important;
    text-shadow: none !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    color: #333333 !important;
  }

  body.login form input[type="submit"]:hover {
    background: #80be95 !important;
    color: #333333 !important;
    text-shadow: none !important;
  }

  .login #backtoblog a, .login #nav a {
    color: #333333 !important;
    transition: color 0.4s ease;
  }

  .login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover {
    color: #a04b86 !important;
  }

  </style>
<?php */}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function wpb_custom_logo() {
/*
echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
background-image: url(' . get_bloginfo('stylesheet_directory') . '/img/mini-logo.png) !important;
background-position: 0 0;
color:rgba(0, 0, 0, 0);
}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
background-position: 0 0;
}
</style>
';

*/
}
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');

?>