<?php

/**
 * Wp Enqueue styles and scripts
 */


 
add_action( 'wp_enqueue_scripts', 'enqueue_script_styles' );

function enqueue_script_styles() {


  wp_enqueue_style(  'swiper-css' , get_stylesheet_directory_uri(  ).'/assets/css/swiper.css');
  wp_enqueue_style( 'all-styles' , get_stylesheet_directory_uri(  ).'/assets/css/style.css');

  if(is_product()) {
    wp_enqueue_style( 'fancybox-css' , 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
    wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', '' , null, true );
  }
  wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper.js' , '' , null, true );
  wp_enqueue_script( 'newscript', get_template_directory_uri() . '/assets/js/script.js', '' , null, true );


  $current_category = get_queried_object();
  $current_category_slug = ($current_category && isset($current_category->slug)) ? $current_category->slug : '';

  wp_localize_script('newscript' , 'script_js', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'currentLang' => apply_filters('wpml_current_language', NULL),
    'current_category_slug' => $current_category_slug,
  ]);

}
