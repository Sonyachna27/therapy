<?php

/**
 * Start Settings
 */
if ( ! function_exists( 'main_setup' ) ) :
    function main_setup() {
      /**
       * Enable support for Post Thumbnails on posts and pages.
       * @link //developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
       */
      add_theme_support( 'post-thumbnails' );
    }
    endif;
    add_action( 'after_setup_theme', 'main_setup' );

   


    /**
     * Add svg uploads
     */
  function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
  }

  add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

  function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
      $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    }
    else {
      $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
    }

    if( $dosvg ){

      // разрешим
      if( current_user_can('manage_options') ){

        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
      }
      // запретим
      else {
        $data['ext']  = false;
        $data['type'] = false;
      }

    }

    return $data;
  }

      add_filter( 'upload_mimes', 'svg_upload_allow' );

  /**
   * Register Menus
   */
 function register_my_menus() {
    register_nav_menus(
    array(
     'header-menu' => ( 'Header Menu' ),
     'technical-menu' => ( 'Technical Menu' ),
     'burger-menu' => ( 'Burger Menu' ),
     'aside-menu' => ( 'Aside Menu' ),
     'footer-menu' => ( 'Footer Menu' ),
     )
     );
    }
    add_action( 'init', 'register_my_menus' );

  
 /**
  * Create Additional Settings
  */

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
      'page_title' => 'Дополнительные настройки',
      'menu_title' => 'Дополнительные настройки',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false,
  ));

}

/**
 * Remove p and br from content
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );


/**
 * Save json acf
 */

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

    if(!function_exists('get_url_template')) {
      function get_url_template($template) {
        $page_query = new WP_Query(array(
          'post_type' => 'page', 
          'meta_key' => '_wp_page_template', 
          'meta_value' => $template, 
        ));
      
        if ($page_query->have_posts()) {
          $page_query->the_post();
          $permalink = get_permalink();
          wp_reset_postdata();
          return $permalink;
        }
        
        return '';
      }
    }
    

    /**
     * Add Class to menu
     */
    function add_menu_item_class( $classes, $item, $args ) {
      if ( isset( $args->item_class ) ) {
          $classes[] = $args->item_class;
      }
      return $classes;
  }
  add_filter( 'nav_menu_css_class', 'add_menu_item_class', 10, 3 );



/**
 * ACF Builder output in content()
 */

if(!function_exists('my_the_content_filter')) {
 add_filter('the_content', 'my_the_content_filter', 0);

function my_the_content_filter($content)
{
    if (is_page() || is_single()) {
        ob_start();
        ?>
        <?php
        if (have_rows('flexible')):
            while (have_rows('flexible')):
                the_row();
                get_template_part('template-parts/flexible/'. get_row_layout() , null );
            endwhile;
        endif;
        ?>
        <?php
        $content .= ob_get_clean();
    }
    
    return $content;
}
}

remove_filter('the_content', 'wpautop');
remove_filter('acf_the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('widget_text_content', 'wpautop');

function custom_wpautop($content) {
    if (trim($content) === '') {
        return '<p></p>';
    }

    $content_lines = explode("\n", $content);
    $new_content = '';
    $in_html_tag = false;

    foreach ($content_lines as $line) {
        if (preg_match('/<[^>]*>/', $line)) {
            $new_content .= $line;
            $in_html_tag = substr_count($line, '<') > substr_count($line, '>');
            continue;
        }

        if (!$in_html_tag && trim($line) !== '' && strip_tags($line) === $line) {
            $new_content .= '<p>' . trim($line) . '</p>';
        } else {
            $new_content .= $line;
        }
    }

    return $new_content;
}

add_filter('the_content', 'custom_wpautop');
add_filter('acf_the_content', 'custom_wpautop');
add_filter('the_excerpt', 'custom_wpautop');
add_filter('widget_text_content', 'custom_wpautop');

if(!function_exists('get_wpml_lang_prefix')) {
function get_wpml_lang_prefix() {
  if (function_exists('icl_get_languages')) {
      $current_lang = apply_filters('wpml_current_language', null);
      $default_lang = apply_filters('wpml_default_language', null);

      if ($current_lang !== $default_lang) {
          return '/' . $current_lang;
      }
  }

  return '/';
}
}


/**
 * Name model
 */
if(!function_exists('mebelka_get_model_word')) {
  function mebelka_get_model_word( $number ) {
    $number = (int)$number;
    $lastDigit = $number % 10;
    $lastTwoDigits = $number % 100;

    if ($lastTwoDigits >= 11 && $lastTwoDigits <= 19) {
        return __('моделей', 'mebelka');
    }

    switch ($lastDigit) {
        case 1: return __('модель', 'mebelka');
        case 2:
        case 3:
        case 4: return __('модели', 'mebelka');
        default: return __('моделей', 'mebelka');
    }
}

}

/**
 * Leave a commentar
 */
if ( ! function_exists( 'new_comment_function' ) ) {
  function new_comment_function() {
    if (
      ! isset($_POST['review_nonce']) ||
      ! wp_verify_nonce($_POST['review_nonce'], 'submit_review')
    ) {
      wp_send_json_error('Nonce verification failed', 403);
    }

    $comment_name    = sanitize_text_field($_POST['comment_name'] ?? '');
    $comment_email   = sanitize_email($_POST['comment_email'] ?? '');
    $comment_product = sanitize_text_field($_POST['comment_product'] ?? '');
    $comment_message = sanitize_textarea_field($_POST['comment_text'] ?? '');
    $comment_rating  = intval($_POST['rating'] ?? 0);
    $comment_post_ID = absint($_POST['commentPost'] ?? 0);

    if (empty($comment_name) || empty($comment_email) || empty($comment_message) || !$comment_post_ID) {
      wp_send_json_error('Missing required fields', 400);
    }

    $comment_data = [
      'comment_post_ID'      => $comment_post_ID,
      'comment_author'       => $comment_name,
      'comment_author_email' => $comment_email,
      'comment_content'      => $comment_message,
      'comment_approved'     => 0,
    ];

    $comment_id = wp_insert_comment($comment_data);

    if (!is_wp_error($comment_id)) {
      if ($comment_rating) {
        add_comment_meta($comment_id, 'comment_rating', $comment_rating);
      }
      if ($comment_product) {
        add_comment_meta($comment_id, 'comment_product', $comment_product);
      }
      if ($comment_name) {
        add_comment_meta($comment_id, 'comment_name', $comment_name);
      }
      if ($comment_message) {
        add_comment_meta($comment_id, 'comment_message', $comment_message);
      }

      wp_send_json_success('Комментарий успешно добавлен');
    } else {
      wp_send_json_error('Ошибка добавления комментария', 500);
    }
  }
}

add_action('wp_ajax_new_comment_function', 'new_comment_function');
add_action('wp_ajax_nopriv_new_comment_function', 'new_comment_function');

if (!function_exists('mebelka_reviews')) {
  function mebelka_reviews($comment, $args, $depth) {
      $comment_name    = $comment->comment_author;
      $comment_product = get_comment_meta($comment->comment_ID, 'comment_product', true);
      $comment_message = $comment->comment_content;
      $comment_rating  = get_comment_meta($comment->comment_ID, 'comment_rating', true);

      $comment_name = $comment_name ? esc_html($comment_name) : 'Неизвестный пользователь';
      $comment_product = $comment_product ? esc_html($comment_product) : 'Не указан';
      $comment_message = $comment_message ? esc_html($comment_message) : 'Отзыв не содержится';
      $comment_rating = intval($comment_rating) ? intval($comment_rating) : 0; 

      ?>
      <div class="swiper-slide reviews__slide reviews__item">
          <div class="reviews__top">
              <div class="reviews__top__wrap">
                  <span class="reviews__name"><?= $comment_name ?></span>
                  <span class="reviews__date"><?= get_comment_date() ?></span>
              </div>
              <div class="reviews__rating">
                  <?php
                  for ($i = 0; $i < 5; $i++) {
                      if ($i < $comment_rating) {
                          echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                          <path d="M7.86652 3.26086C8.24008 2.18619 9.75992 2.18619 10.1335 3.26087L10.8419 5.2988C11.0067 5.77288 11.4491 6.09433 11.9509 6.10455L14.108 6.14851C15.2455 6.17169 15.7151 7.61715 14.8085 8.30451L13.0892 9.60798C12.6893 9.91121 12.5203 10.4313 12.6656 10.9117L13.2904 12.9768C13.6198 14.0658 12.3903 14.9592 11.4564 14.3093L9.68542 13.077C9.27344 12.7903 8.72656 12.7903 8.31458 13.077L6.54362 14.3093C5.60973 14.9592 4.38016 14.0658 4.70962 12.9768L5.33439 10.9117C5.47973 10.4313 5.31074 9.91121 4.91078 9.60798L3.19149 8.30451C2.28486 7.61714 2.75451 6.17169 3.89202 6.14851L6.04911 6.10455C6.55092 6.09433 6.99335 5.77288 7.15814 5.2988L7.86652 3.26086Z" fill="#D7B47E"/>
                          <path d="M8.05544 2.71739C8.36673 1.82183 9.63327 1.82183 9.94456 2.71739L10.8876 5.43025C11.0249 5.82532 11.3936 6.09319 11.8117 6.10172L14.6832 6.16023C15.6312 6.17955 16.0225 7.3841 15.267 7.9569L12.9783 9.69206C12.645 9.94475 12.5042 10.3782 12.6253 10.7785L13.457 13.5275C13.7315 14.435 12.7069 15.1795 11.9287 14.6379L9.57118 12.9975C9.22786 12.7586 8.77214 12.7586 8.42882 12.9975L6.07134 14.6379C5.2931 15.1795 4.26845 14.435 4.54301 13.5275L5.37469 10.7785C5.49581 10.3782 5.35498 9.94475 5.02168 9.69206L2.73299 7.9569C1.97746 7.38409 2.36884 6.17955 3.31677 6.16023L6.18826 6.10172C6.60643 6.09319 6.97512 5.82532 7.11245 5.43025L8.05544 2.71739Z" fill="#D7B47E"/>
                          </svg>';
                      } else {
                          echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                          <path d="M7.86652 3.26086C8.24008 2.18619 9.75992 2.18619 10.1335 3.26087L10.8419 5.2988C11.0067 5.77288 11.4491 6.09433 11.9509 6.10455L14.108 6.14851C15.2455 6.17169 15.7151 7.61715 14.8085 8.30451L13.0892 9.60798C12.6893 9.91121 12.5203 10.4313 12.6656 10.9117L13.2904 12.9768C13.6198 14.0658 12.3903 14.9592 11.4564 14.3093L9.68542 13.077C9.27344 12.7903 8.72656 12.7903 8.31458 13.077L6.54362 14.3093C5.60973 14.9592 4.38016 14.0658 4.70962 12.9768L5.33439 10.9117C5.47973 10.4313 5.31074 9.91121 4.91078 9.60798L3.19149 8.30451C2.28486 7.61714 2.75451 6.17169 3.89202 6.14851L6.04911 6.10455C6.55092 6.09433 6.99335 5.77288 7.15814 5.2988L7.86652 3.26086Z" fill="grey"/>
                          <path d="M8.05544 2.71739C8.36673 1.82183 9.63327 1.82183 9.94456 2.71739L10.8876 5.43025C11.0249 5.82532 11.3936 6.09319 11.8117 6.10172L14.6832 6.16023C15.6312 6.17955 16.0225 7.3841 15.267 7.9569L12.9783 9.69206C12.645 9.94475 12.5042 10.3782 12.6253 10.7785L13.457 13.5275C13.7315 14.435 12.7069 15.1795 11.9287 14.6379L9.57118 12.9975C9.22786 12.7586 8.77214 12.7586 8.42882 12.9975L6.07134 14.6379C5.2931 15.1795 4.26845 14.435 4.54301 13.5275L5.37469 10.7785C5.49581 10.3782 5.35498 9.94475 5.02168 9.69206L2.73299 7.9569C1.97746 7.38409 2.36884 6.17955 3.31677 6.16023L6.18826 6.10172C6.60643 6.09319 6.97512 5.82532 7.11245 5.43025L8.05544 2.71739Z" fill="grey"/>
                          </svg>';
                      }
                  }
                  ?>
              </div>
          </div>
          <hr />
          <div class="reviews__bottom">
              <div class="reviews__product__name"><?= $comment_product ?></div>
              <p><?= $comment_message ?></p>
          </div>
      </div>
      <?php
  }
}