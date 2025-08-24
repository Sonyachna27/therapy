<?php 

/**
 * Whish Products
 */
add_action('wp_ajax_load_wishlist', 'load_wishlist_products');
add_action('wp_ajax_nopriv_load_wishlist', 'load_wishlist_products');

function load_wishlist_products() {

    $ids = explode(",", sanitize_text_field($_POST['ids']));

    $query = new WP_Query([
        'post_type'      => ['product', 'product_variation'],
        'post__in'       => $ids,
        'posts_per_page' => -1,
        'orderby'        => 'post__in', 
    ]);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_the_title();
            wc_get_template_part('content', 'mebelproduct'); 
        }
        wp_reset_postdata();
    } else {
        echo '
        <div class="selected__null">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M23.9814 2.25244C11.9909 2.25244 2.25684 11.9866 2.25684 23.977C2.25684 35.9675 11.9909 45.7016 23.9814 45.7016C35.9719 45.7016 45.706 35.9675 45.706 23.977C45.706 11.9866 35.9719 2.25244 23.9814 2.25244ZM23.9814 3.75069C35.1449 3.75069 44.2078 12.8135 44.2078 23.977C44.2078 35.1405 35.1449 44.2034 23.9814 44.2034C12.8179 44.2034 3.75508 35.1405 3.75508 23.977C3.75508 12.8135 12.8179 3.75069 23.9814 3.75069ZM16.282 37.3084C16.282 37.3084 17.8425 32.9679 23.9814 32.9665C30.1204 32.9651 31.6808 37.3084 31.6808 37.3084C31.7454 37.4963 31.8818 37.6508 32.0603 37.7381C32.2387 37.8253 32.4445 37.8381 32.6324 37.7737C32.8202 37.7089 32.9746 37.5723 33.0618 37.3937C33.149 37.2152 33.1618 37.0094 33.0975 36.8214C33.0975 36.8214 31.3236 31.4668 23.9814 31.4683C16.6392 31.4697 14.8654 36.8214 14.8654 36.8214C14.801 37.0093 14.8138 37.215 14.9008 37.3935C14.9878 37.572 15.1421 37.7087 15.3297 37.7737C15.5177 37.8382 15.7236 37.8254 15.9022 37.7381C16.0807 37.6509 16.2173 37.4963 16.282 37.3084ZM28.8672 23.9964C28.8066 23.0143 29.1631 21.9986 29.9287 21.2329C31.304 19.8584 33.496 19.7983 34.822 21.1236C35.5494 21.851 35.8595 22.8435 35.7628 23.8152C35.7436 24.0129 35.8035 24.2101 35.9295 24.3636C36.0555 24.5171 36.2372 24.6143 36.4348 24.6339C36.5327 24.6437 36.6315 24.634 36.7256 24.6056C36.8197 24.5771 36.9073 24.5304 36.9833 24.468C37.0594 24.4057 37.1224 24.329 37.1688 24.2423C37.2152 24.1557 37.244 24.0607 37.2537 23.9628C37.3937 22.5545 36.936 21.1191 35.8813 20.0644C33.9821 18.1653 30.8397 18.2035 28.8695 20.1737C27.7855 21.2577 27.285 22.699 27.372 24.0901C27.3892 24.2847 27.4817 24.4649 27.6299 24.5923C27.7781 24.7197 27.9701 24.7842 28.1651 24.772C28.3601 24.7598 28.5427 24.6719 28.6738 24.5271C28.805 24.3822 28.8743 24.1917 28.8672 23.9964ZM11.4403 23.9964C11.379 23.0143 11.7362 21.9986 12.5019 21.2329C13.8764 19.8584 16.0692 19.7983 17.3945 21.1236C18.1225 21.851 18.4318 22.8435 18.3359 23.8152C18.3262 23.9131 18.3359 24.0119 18.3644 24.106C18.3929 24.2001 18.4396 24.2876 18.5019 24.3637C18.5643 24.4397 18.641 24.5027 18.7277 24.5491C18.8144 24.5954 18.9094 24.6243 19.0072 24.6339C19.1051 24.6437 19.204 24.6342 19.2982 24.6057C19.3923 24.5773 19.48 24.5306 19.5561 24.4683C19.6322 24.4059 19.6953 24.3292 19.7418 24.2425C19.7882 24.1558 19.8171 24.0607 19.8268 23.9628C19.9661 22.5545 19.5092 21.1191 18.4537 20.0644C16.5545 18.1653 13.4128 18.2035 11.4425 20.1737C10.3579 21.2577 9.85827 22.699 9.94493 24.0901C9.96213 24.2847 10.0547 24.4649 10.2028 24.5923C10.351 24.7197 10.5431 24.7842 10.7381 24.772C10.9331 24.7598 11.1156 24.6719 11.2468 24.5271C11.3779 24.3822 11.4473 24.1919 11.4401 23.9966L11.4403 23.9964Z" fill="#003944"/>
							</svg>
						<div>'. __("Товар отсутствует... Похоже вы не добавили товар который вам нравится" , "mebelka") .'</div>
                        <a href="'. esc_url(get_permalink(wc_get_page_id("shop"))) .'" class="btn green">В каталог</a>
					</div>
        ';
    }

    wp_die();
}

/**
 * Search Header
 */

if (!function_exists('mebelka_search')) {

    function mebelka_search() {
        $search_word = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';

        $product_args = array(
            'post_type'      => ['product', 'product_variation'],
            's'              => $search_word,
            'posts_per_page' => 8,
            'orderby'        => 'title',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );

        $product_query = new WP_Query($product_args);
        $response = '';

        if ($product_query->have_posts()) {
            while ($product_query->have_posts()) : $product_query->the_post();
                $permalink = get_permalink();
                $title = get_the_title();
                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
                $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

                $price_html = '';
                if ($sale_price && $sale_price < $regular_price) {
                    $price_html = '<span class="product-price"><del>' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . '</ins></span>';
                } else {
                    $price_html = '<span class="product-price">' . wc_price($regular_price) . '</span>';
                }

                $response .= '
                <a href="' . esc_url($permalink) . '" class="search-product">
                    <div class="product-thumb">
                        <img src="' . esc_url($thumbnail_url ? $thumbnail_url : MEBELKA_THEME_DIRECTORY . 'assets/images/popular-cat.png') . '" alt="' . esc_attr($title) . '">
                    </div>
                    <div class="product-content">
                        <span>' . esc_html($title) . '</span>
                        '. $price_html .'
                    </div>
                </a>';
            endwhile;
            wp_reset_postdata();
        } else {
            $response .= '
            <div class="search__error">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.4879 1.50146C8.49429 1.50146 2.00488 7.99087 2.00488 15.9845C2.00488 23.9782 8.49429 30.4676 16.4879 30.4676C24.4816 30.4676 30.971 23.9782 30.971 15.9845C30.971 7.99087 24.4816 1.50146 16.4879 1.50146ZM16.4879 2.5003C23.9303 2.5003 29.9722 8.54218 29.9722 15.9845C29.9722 23.4269 23.9303 29.4687 16.4879 29.4687C9.0456 29.4687 3.00371 23.4269 3.00371 15.9845C3.00371 8.54218 9.0456 2.5003 16.4879 2.5003ZM11.355 24.8721C11.355 24.8721 12.3953 21.9785 16.4879 21.9775C20.5806 21.9766 21.6209 24.8721 21.6209 24.8721C21.6639 24.9974 21.7549 25.1004 21.8738 25.1586C21.9928 25.2167 22.13 25.2253 22.2553 25.1823C22.3805 25.1391 22.4834 25.048 22.5416 24.929C22.5997 24.81 22.6082 24.6728 22.5653 24.5475C22.5653 24.5475 21.3827 20.9777 16.4879 20.9787C11.5931 20.9796 10.4106 24.5475 10.4106 24.5475C10.3677 24.6727 10.3762 24.8098 10.4342 24.9288C10.4922 25.0478 10.595 25.139 10.7201 25.1823C10.8455 25.2253 10.9827 25.2168 11.1018 25.1586C11.2208 25.1004 11.3119 24.9974 11.355 24.8721ZM19.7451 15.9975C19.7047 15.3427 19.9424 14.6656 20.4528 14.1551C21.3697 13.2388 22.831 13.1987 23.715 14.0823C24.1999 14.5672 24.4067 15.2289 24.3422 15.8767C24.3294 16.0084 24.3693 16.1399 24.4533 16.2422C24.5373 16.3445 24.6585 16.4094 24.7902 16.4225C24.8554 16.4289 24.9213 16.4225 24.984 16.4035C25.0468 16.3846 25.1052 16.3534 25.1559 16.3119C25.2066 16.2703 25.2486 16.2192 25.2795 16.1614C25.3104 16.1036 25.3297 16.0403 25.3361 15.9751C25.4295 15.0361 25.1243 14.0793 24.4212 13.3761C23.1551 12.11 21.0601 12.1355 19.7467 13.449C19.024 14.1717 18.6903 15.1325 18.7483 16.0599C18.7598 16.1897 18.8215 16.3098 18.9203 16.3947C19.019 16.4796 19.1471 16.5226 19.2771 16.5145C19.4071 16.5064 19.5288 16.4478 19.6162 16.3512C19.7036 16.2546 19.7499 16.1276 19.7451 15.9975ZM8.12719 15.9975C8.08632 15.3427 8.32446 14.6656 8.83491 14.1551C9.75128 13.2388 11.2131 13.1987 12.0966 14.0823C12.582 14.5672 12.7882 15.2289 12.7243 15.8767C12.7178 15.9419 12.7243 16.0077 12.7432 16.0705C12.7622 16.1332 12.7934 16.1916 12.835 16.2423C12.8765 16.293 12.9277 16.335 12.9855 16.3659C13.0433 16.3968 13.1066 16.416 13.1718 16.4225C13.2371 16.429 13.303 16.4226 13.3658 16.4037C13.4286 16.3847 13.487 16.3536 13.5377 16.312C13.5885 16.2705 13.6305 16.2193 13.6615 16.1615C13.6925 16.1037 13.7117 16.0403 13.7182 15.9751C13.8111 15.0361 13.5064 14.0793 12.8028 13.3761C11.5367 12.11 9.44219 12.1355 8.12863 13.449C7.40557 14.1717 7.07251 15.1325 7.13028 16.0599C7.14175 16.1897 7.20345 16.3098 7.30222 16.3947C7.401 16.4796 7.52904 16.5226 7.65904 16.5145C7.78905 16.5064 7.91074 16.4478 7.99817 16.3512C8.0856 16.2546 8.13185 16.1278 8.12707 15.9976L8.12719 15.9975Z" fill="#003944"/>
                    </svg>
                </span>
                <span>' . __('По вашему запросу ничего не найдено.', 'mebelka') . '</span>
            </div>';
        }

        echo $response;
        wp_die(); 
    }

    add_action('wp_ajax_mebelka_search', 'mebelka_search');
    add_action('wp_ajax_nopriv_mebelka_search', 'mebelka_search');
}


function handle_add_to_cart() {
    $product_id = absint( $_POST['product_id'] );
    $quantity = absint( $_POST['quantity'] );

    WC()->cart->add_to_cart( $product_id, $quantity );

    $fragments = ob_get_clean();

    echo json_encode(array(
        'fragments' => $fragments,
        'cart_hash' => WC()->cart->get_cart_hash()
    ));

    wp_die();
}

add_action( 'wp_ajax_add_to_cart', 'handle_add_to_cart' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'handle_add_to_cart' );


 /**
 * Update count cart
 */
add_action('wp_ajax_get_cart_count', 'get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count');

function get_cart_count() {
    wp_send_json_success(['cart_count' => WC()->cart->get_cart_contents_count()]);
}

/**
 * Aply Coupon
 */

 /**
 * Logic Coupon
 */
add_action('wp_ajax_apply_custom_coupon', 'apply_custom_coupon');
add_action('wp_ajax_nopriv_apply_custom_coupon', 'apply_custom_coupon');

function apply_custom_coupon() {
    if (!isset($_POST['coupon_code'])) {
        wp_send_json_error(['message' => __('Код купона не предоставляется.', 'woocommerce')]);
    }

    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    $applied = WC()->cart->apply_coupon($coupon_code);

    if ($applied) {
        WC()->cart->calculate_totals(); 
        wp_send_json_success(['message' => __('Купон успешно применен!', 'woocommerce')]);
    } else {
        wp_send_json_error(['message' => __('Неверный код купона или не выполненные условия.', 'woocommerce')]);
    }

    wp_die();
}

/**
 * Remove produt from list cart
 */

add_action('wp_ajax_remove_cart_item', 'remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item');

function remove_cart_item() {
    if (!isset($_POST['cart_item_key'])) {
        wp_send_json_error(['message' => 'Некорректный запрос']);
    }

    $cart = WC()->cart;
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    if ($cart->remove_cart_item($cart_item_key)) {
        $cart->calculate_totals(); 
        WC()->cart->set_session(); 
        WC()->cart->maybe_set_cart_cookies();

        wp_send_json_success([
            'cart_count' => $cart->get_cart_contents_count(), 
        ]);
    } else {
        wp_send_json_error(['message' => 'Не удалось удалить товар']);
    }
}


/**
 * Sorting product
 */

add_action('wp_ajax_handle_custom_product_sort', 'handle_custom_product_sort');
add_action('wp_ajax_nopriv_handle_custom_product_sort', 'handle_custom_product_sort');

function handle_custom_product_sort() {
    $sort = $_POST['sort'] ?? 'all';
    $price_min = intval($_POST['price_min'] ?? 0);
    $price_max = intval($_POST['price_max'] ?? 0);
    $categories = $_POST['categories'] ?? [];
    $colors = $_POST['colors'] ?? [];
    $length_min = intval($_POST['length_min'] ?? 0);
    $length_max = intval($_POST['length_max'] ?? 0);
    $width_min = intval($_POST['width_min'] ?? 0);
    $width_max = intval($_POST['width_max'] ?? 0);
    $height_min = intval($_POST['height_min'] ?? 0);
    $height_max = intval($_POST['height_max'] ?? 0);
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => [],
        'meta_query' => ['relation' => 'AND'],
    ];

    if (!empty($categories)) {
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $categories,
            'operator' => 'IN',
        ];
    }

    if (!empty($colors)) {
        $args['tax_query'][] = [
            'taxonomy' => 'pa_color',
            'field' => 'slug',
            'terms' => $colors,
            'operator' => 'IN',
        ];
    }

    if ($price_min || $price_max) {
        $price_query = ['key' => '_price', 'type' => 'NUMERIC'];
        if ($price_min) $price_query['value'][] = $price_min;
        if ($price_max) $price_query['value'][] = $price_max;
        $price_query['compare'] = ($price_min && $price_max) ? 'BETWEEN' : ($price_min ? '>=' : '<=');
        $args['meta_query'][] = $price_query;
    }

    if ($length_min || $length_max) {
        $length_query = ['key' => '_length', 'type' => 'NUMERIC'];
        if ($length_min) $length_query['value'][] = $length_min;
        if ($length_max) $length_query['value'][] = $length_max;
        $length_query['compare'] = ($length_min && $length_max) ? 'BETWEEN' : ($length_min ? '>=' : '<=');
        $args['meta_query'][] = $length_query;
    }

    if ($width_min || $width_max) {
        $width_query = ['key' => '_width', 'type' => 'NUMERIC'];
        if ($width_min) $width_query['value'][] = $width_min;
        if ($width_max) $width_query['value'][] = $width_max;
        $width_query['compare'] = ($width_min && $width_max) ? 'BETWEEN' : ($width_min ? '>=' : '<=');
        $args['meta_query'][] = $width_query;
    }

    if ($height_min || $height_max) {
        $height_query = ['key' => '_height', 'type' => 'NUMERIC'];
        if ($height_min) $height_query['value'][] = $height_min;
        if ($height_max) $height_query['value'][] = $height_max;
        $height_query['compare'] = ($height_min && $height_max) ? 'BETWEEN' : ($height_min ? '>=' : '<=');
        $args['meta_query'][] = $height_query;
    }

    switch ($sort) {
        case 'best_selling':
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'price_asc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price_desc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'all':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $count = $query->found_posts;
        echo '<div class="filtered-count" data-count="' . esc_attr($count) . '"></div>';
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'mebelproduct');
            
        }
    } else {
        echo '<p>' . __('Ничего не найдено', 'mebelka') . '</p>';
    }

    wp_die();
}
