<?php 

add_action('after_setup_theme', function() {
    add_theme_support('woocommerce');
});

/**
 * Up single meta to top 
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 4 );

/**
 * Remove on sale
 */

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_sale_flash', 10 );


/**
 * Remove Quatity from single product
 */

function remove_quantity_from_single_product( $is_sold_individually ) {
    if ( is_product() ) {
        return true; 
    }
    return $is_sold_individually;
}
add_filter( 'woocommerce_is_sold_individually', 'remove_quantity_from_single_product' );



/**
 * Remove default avaliable product
 */
add_filter( 'woocommerce_get_availability', 'remove_default_stock_message', 10, 2 );

function remove_default_stock_message( $availability, $product ) {
    if ( ! $product->is_in_stock() ) {
        return '';
    }
    
    return $availability;
}


/**
 * Check avaliable product
 */
if(!function_exists('custom_product_availability')) {
add_action('woocommerce_single_product_summary', 'custom_product_availability', 35);

function custom_product_availability() {
    global $product;

    if ($product->is_in_stock() && $product->get_stock_status() !== 'onbackorder') {
        echo '<span class="staff__availability">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
                    <g clip-path="url(#clip0_406_7105)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4204 1.70711C10.8109 1.31658 10.8109 0.683417 10.4204 0.292893C10.0299 -0.0976311 9.39671 -0.0976309 9.00619 0.292893L4.04314 5.25594L1.70915 2.92194C1.31816 2.53095 0.684233 2.53095 0.293243 2.92194C-0.097748 3.31293 -0.0977474 3.94685 0.293243 4.33784L3.33236 7.37696C3.70837 7.75297 4.30905 7.76737 4.70227 7.42018C4.7238 7.40201 4.74473 7.38278 4.76501 7.36249L10.4204 1.70711Z" fill="#27B4A0"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_406_7105">
                    <rect width="11" height="8" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
                ' . __( 'Товар в наличии', 'mebelka' ) . '
            </span>';
    } else if($product->get_stock_status() === 'onbackorder') {
        echo '';
    } else {
        echo '<span class="staff__availability stock out-of-stock">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
                    <g clip-path="url(#clip0_406_7105)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4204 1.70711C10.8109 1.31658 10.8109 0.683417 10.4204 0.292893C10.0299 -0.0976311 9.39671 -0.0976309 9.00619 0.292893L4.04314 5.25594L1.70915 2.92194C1.31816 2.53095 0.684233 2.53095 0.293243 2.92194C-0.097748 3.31293 -0.0977474 3.94685 0.293243 4.33784L3.33236 7.37696C3.70837 7.75297 4.30905 7.76737 4.70227 7.42018C4.7238 7.40201 4.74473 7.38278 4.76501 7.36249L10.4204 1.70711Z" fill="#FF3B3B"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_406_7105">
                    <rect width="11" height="8" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
                ' . __( 'Товара нет в наличии', 'mebelka' ) . '
            </span>';
    }
}
}

/**
 * Change default button to cart
 */
add_action( 'woocommerce_single_product_summary', 'custom_add_to_cart_button', 30 );

function custom_add_to_cart_button() {
    global $product;
    $product_id = $product->get_id();
    $in_stock = $product->is_in_stock();

    if ($in_stock && $product->get_stock_status() !== 'onbackorder') : ?>
            <div class="staff__btns">
            <button class="btn staff__btn add-to-cart add-to-cart-button add_to_cart_button quick-add-to-cart" data-product_id="<?= $product->get_id(); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                    <path d="M19.8827 0.61142C19.8373 0.531325 19.7761 0.461328 19.7027 0.405706C19.6218 0.344953 19.5279 0.303869 19.4284 0.285706L0.571289 0.285706V1.65713H2.78272L6.13415 10.8714C6.32003 11.3925 6.66103 11.8442 7.11129 12.1657C7.56302 12.4835 8.10183 12.6541 8.65415 12.6543H16.9341V11.3H8.65415C8.38158 11.2981 8.11585 11.2145 7.89129 11.06C7.67584 10.9008 7.51431 10.6794 7.42843 10.4257L6.80272 8.65999H16.5313C16.8963 8.65632 17.2507 8.5362 17.5427 8.31713C17.8311 8.10474 18.0419 7.80364 18.1427 7.45999L19.9427 1.14285C19.9637 1.04973 19.9637 0.953108 19.9427 0.859991C19.9368 0.774348 19.9166 0.690311 19.8827 0.61142ZM16.7456 7.29713H6.27986L4.22272 1.65713H18.3484L16.7456 7.29713ZM9.58843 14.6428C9.36557 14.4235 9.06541 14.3006 8.75272 14.3006C8.44003 14.3006 8.13987 14.4235 7.917 14.6428C7.69459 14.8725 7.57144 15.1803 7.57415 15.5C7.57042 15.6586 7.59888 15.8163 7.65781 15.9637C7.71674 16.111 7.80491 16.2448 7.917 16.3571C8.14195 16.5725 8.44132 16.6926 8.75272 16.6926C9.06411 16.6926 9.36349 16.5725 9.58843 16.3571C9.70052 16.2448 9.7887 16.111 9.84762 15.9637C9.90655 15.8163 9.93501 15.6586 9.93129 15.5C9.93399 15.1803 9.81084 14.8725 9.58843 14.6428ZM15.5884 14.6428C15.4761 14.5308 15.3423 14.4426 15.195 14.3837C15.0476 14.3247 14.8899 14.2963 14.7313 14.3C14.5756 14.2989 14.4213 14.3287 14.2773 14.3877C14.1333 14.4467 14.0024 14.5338 13.8923 14.6439C13.7823 14.754 13.6952 14.8848 13.6361 15.0288C13.5771 15.1729 13.5473 15.3272 13.5484 15.4828C13.5447 15.6415 13.5732 15.7992 13.6321 15.9465C13.691 16.0938 13.7792 16.2277 13.8913 16.34C14.1182 16.5515 14.4168 16.6691 14.727 16.6691C15.0372 16.6691 15.3358 16.5515 15.5627 16.34C15.6748 16.2277 15.763 16.0938 15.8219 15.9465C15.8808 15.7992 15.9093 15.6415 15.9056 15.4828C15.9108 15.1727 15.7973 14.8722 15.5884 14.6428Z" fill="#003944"></path>
                </svg>
                <?php _e( 'В корзину', 'mebelka' ); ?>
            </button>
            <div class="wishlist-button" data-id="<?= $product->get_id() ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
                    <g clip-path="url(#clip0_406_7111)">
                    <path d="M16.4392 1.46655C20.2432 1.46655 22.7992 5.01772 22.7992 8.33055C22.7992 15.0396 12.1912 20.5332 11.9992 20.5332C11.8072 20.5332 1.19922 15.0396 1.19922 8.33055C1.19922 5.01772 3.75522 1.46655 7.55922 1.46655C9.74322 1.46655 11.1712 2.55097 11.9992 3.5043C12.8272 2.55097 14.2552 1.46655 16.4392 1.46655Z" stroke="white" stroke-width="1.95" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_406_7111">
                    <rect width="24" height="22" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
        <?php elseif ( $product->get_stock_status() === 'onbackorder' ) : ?>
            <div class="staff__btns onback-popup">
            <button class="btn staff__btn" style="width:100%;margin:10px 0 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                    <path d="M19.8827 0.61142C19.8373 0.531325 19.7761 0.461328 19.7027 0.405706C19.6218 0.344953 19.5279 0.303869 19.4284 0.285706L0.571289 0.285706V1.65713H2.78272L6.13415 10.8714C6.32003 11.3925 6.66103 11.8442 7.11129 12.1657C7.56302 12.4835 8.10183 12.6541 8.65415 12.6543H16.9341V11.3H8.65415C8.38158 11.2981 8.11585 11.2145 7.89129 11.06C7.67584 10.9008 7.51431 10.6794 7.42843 10.4257L6.80272 8.65999H16.5313C16.8963 8.65632 17.2507 8.5362 17.5427 8.31713C17.8311 8.10474 18.0419 7.80364 18.1427 7.45999L19.9427 1.14285C19.9637 1.04973 19.9637 0.953108 19.9427 0.859991C19.9368 0.774348 19.9166 0.690311 19.8827 0.61142ZM16.7456 7.29713H6.27986L4.22272 1.65713H18.3484L16.7456 7.29713ZM9.58843 14.6428C9.36557 14.4235 9.06541 14.3006 8.75272 14.3006C8.44003 14.3006 8.13987 14.4235 7.917 14.6428C7.69459 14.8725 7.57144 15.1803 7.57415 15.5C7.57042 15.6586 7.59888 15.8163 7.65781 15.9637C7.71674 16.111 7.80491 16.2448 7.917 16.3571C8.14195 16.5725 8.44132 16.6926 8.75272 16.6926C9.06411 16.6926 9.36349 16.5725 9.58843 16.3571C9.70052 16.2448 9.7887 16.111 9.84762 15.9637C9.90655 15.8163 9.93501 15.6586 9.93129 15.5C9.93399 15.1803 9.81084 14.8725 9.58843 14.6428ZM15.5884 14.6428C15.4761 14.5308 15.3423 14.4426 15.195 14.3837C15.0476 14.3247 14.8899 14.2963 14.7313 14.3C14.5756 14.2989 14.4213 14.3287 14.2773 14.3877C14.1333 14.4467 14.0024 14.5338 13.8923 14.6439C13.7823 14.754 13.6952 14.8848 13.6361 15.0288C13.5771 15.1729 13.5473 15.3272 13.5484 15.4828C13.5447 15.6415 13.5732 15.7992 13.6321 15.9465C13.691 16.0938 13.7792 16.2277 13.8913 16.34C14.1182 16.5515 14.4168 16.6691 14.727 16.6691C15.0372 16.6691 15.3358 16.5515 15.5627 16.34C15.6748 16.2277 15.763 16.0938 15.8219 15.9465C15.8808 15.7992 15.9093 15.6415 15.9056 15.4828C15.9108 15.1727 15.7973 14.8722 15.5884 14.6428Z" fill="#003944"></path>
                </svg>
                <?php _e( 'Предзаказ', 'mebelka' ); ?>
            </button>
        </div>
        <?php else : ?>
        <div class="staff__btns">
            <button class="btn staff__btn disabled" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                    <path d="M19.8827 0.61142C19.8373 0.531325 19.7761 0.461328 19.7027 0.405706C19.6218 0.344953 19.5279 0.303869 19.4284 0.285706L0.571289 0.285706V1.65713H2.78272L6.13415 10.8714C6.32003 11.3925 6.66103 11.8442 7.11129 12.1657C7.56302 12.4835 8.10183 12.6541 8.65415 12.6543H16.9341V11.3H8.65415C8.38158 11.2981 8.11585 11.2145 7.89129 11.06C7.67584 10.9008 7.51431 10.6794 7.42843 10.4257L6.80272 8.65999H16.5313C16.8963 8.65632 17.2507 8.5362 17.5427 8.31713C17.8311 8.10474 18.0419 7.80364 18.1427 7.45999L19.9427 1.14285C19.9637 1.04973 19.9637 0.953108 19.9427 0.859991C19.9368 0.774348 19.9166 0.690311 19.8827 0.61142ZM16.7456 7.29713H6.27986L4.22272 1.65713H18.3484L16.7456 7.29713ZM9.58843 14.6428C9.36557 14.4235 9.06541 14.3006 8.75272 14.3006C8.44003 14.3006 8.13987 14.4235 7.917 14.6428C7.69459 14.8725 7.57144 15.1803 7.57415 15.5C7.57042 15.6586 7.59888 15.8163 7.65781 15.9637C7.71674 16.111 7.80491 16.2448 7.917 16.3571C8.14195 16.5725 8.44132 16.6926 8.75272 16.6926C9.06411 16.6926 9.36349 16.5725 9.58843 16.3571C9.70052 16.2448 9.7887 16.111 9.84762 15.9637C9.90655 15.8163 9.93501 15.6586 9.93129 15.5C9.93399 15.1803 9.81084 14.8725 9.58843 14.6428ZM15.5884 14.6428C15.4761 14.5308 15.3423 14.4426 15.195 14.3837C15.0476 14.3247 14.8899 14.2963 14.7313 14.3C14.5756 14.2989 14.4213 14.3287 14.2773 14.3877C14.1333 14.4467 14.0024 14.5338 13.8923 14.6439C13.7823 14.754 13.6952 14.8848 13.6361 15.0288C13.5771 15.1729 13.5473 15.3272 13.5484 15.4828C13.5447 15.6415 13.5732 15.7992 13.6321 15.9465C13.691 16.0938 13.7792 16.2277 13.8913 16.34C14.1182 16.5515 14.4168 16.6691 14.727 16.6691C15.0372 16.6691 15.3358 16.5515 15.5627 16.34C15.6748 16.2277 15.763 16.0938 15.8219 15.9465C15.8808 15.7992 15.9093 15.6415 15.9056 15.4828C15.9108 15.1727 15.7973 14.8722 15.5884 14.6428Z" fill="#003944"></path>
                </svg>
                <?php _e( 'Нет в наличии', 'mebelka' ); ?>
            </button>
            <div class="wishlist-button" data-id="<?= $product->get_id() ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
                    <g clip-path="url(#clip0_406_7111)">
                    <path d="M16.4392 1.46655C20.2432 1.46655 22.7992 5.01772 22.7992 8.33055C22.7992 15.0396 12.1912 20.5332 11.9992 20.5332C11.8072 20.5332 1.19922 15.0396 1.19922 8.33055C1.19922 5.01772 3.75522 1.46655 7.55922 1.46655C9.74322 1.46655 11.1712 2.55097 11.9992 3.5043C12.8272 2.55097 14.2552 1.46655 16.4392 1.46655Z" stroke="white" stroke-width="1.95" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                    <defs>
                    <clipPath id="clip0_406_7111">
                    <rect width="24" height="22" fill="white"></rect>
                    </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
    <?php endif;
}

/**
 * Remove Default button to cart
 */
add_filter( 'woocommerce_is_purchasable', 'remove_add_to_cart_button_if_out_of_stock', 10, 2 );
function remove_add_to_cart_button_if_out_of_stock( $purchasable, $product ) {
    if ( ! $product->is_in_stock() ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
    return $purchasable;
}

/**
 * Remove excerpt from single product
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

/**
 * Change default tab excerpt
 */

add_filter('woocommerce_product_tabs', 'custom_product_tabs_with_excerpt');
function custom_product_tabs_with_excerpt($tabs) {
	global $product;

	$excerpt = $product->get_short_description();

	if (!empty($excerpt)) {
		$tabs['additional_information'] = array(
			'title'    => __('Характеристики', 'woocommerce'),
			'priority' => 20,
			'callback' => 'custom_additional_information_tab_content'
		);
	} elseif ($product->has_attributes()) {
		$tabs['additional_information']['callback'] = 'custom_additional_information_tab_content';
	}

	return $tabs;
}

function custom_additional_information_tab_content() {
	global $product;
	$excerpt = $product->get_short_description();

	if (!empty($excerpt)) {
		echo '<div class="custom-excerpt">' . wpautop($excerpt) . '</div>';
	} else {
		wc_display_product_attributes($product);
	}
}

/**
 * Remove title from description tab
 */
add_filter('woocommerce_product_description_heading', '__return_empty_string');


/**
 * Remove delivery from cart
 */


add_filter('woocommerce_cart_needs_shipping', 'remove_shipping_on_cart_page');

function remove_shipping_on_cart_page($needs_shipping) {
    if (is_cart()) {
        return false; 
    }
    return $needs_shipping; 
}

/**
 * Remove mesasge from cart
 */

add_action('template_redirect', function() {
	if (is_cart()) {
		remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
	}
});


/**
 * Remove inputs from checkout page
 */

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function custom_override_checkout_fields($fields) {
    // Оставляем только нужные поля
    $fields['billing'] = [
        'billing_first_name' => $fields['billing']['billing_first_name'],
        'billing_last_name'  => $fields['billing']['billing_last_name'],
        'billing_phone'      => $fields['billing']['billing_phone'],
        'billing_email'      => $fields['billing']['billing_email'],
    ];

    unset($fields['shipping']);

    return $fields;
}

/**
 * Remove privacy policy from chekout page
 */
remove_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_privacy_policy_text', 20 );
remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );

/**
 * Change title from archive page
 */
add_filter( 'woocommerce_page_title', '__return_empty_string' );

/**
 * Remove before shop lopp
 */

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


add_action( 'woocommerce_before_shop_loop', function() {
	?>
	<div class="category__filters mb-m">
		<button class="category__filters__btn btn green" data-open="openFilter">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 18" fill="none">
				<g clip-path="url(#clip0_406_6057)">
					<path d="M7 4.625C7 6.35089 5.60089 7.75 3.875 7.75C2.14911 7.75 0.75 6.35089 0.75 4.625C0.75 2.89911 2.14911 1.5 3.875 1.5C5.60089 1.5 7 2.89911 7 4.625ZM7 4.625H23.25M17 13.375C17 15.1009 18.3991 16.5 20.125 16.5C21.8509 16.5 23.25 15.1009 23.25 13.375C23.25 11.6491 21.8509 10.25 20.125 10.25C18.3991 10.25 17 11.6491 17 13.375ZM17 13.375H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</g>
				<defs>
					<clipPath id="clip0_406_6057">
						<rect width="24" height="18" fill="white"/>
					</clipPath>
				</defs>
			</svg>
			<?= __('Все фильтры' , 'mebelka') ?>
		</button>
		<div class="category__filters__sort woocommerce-ordering__dropdown">
			<select name="sort-dropdown" id="sort-dropdown">
				<option data-value="all" value="Все"><?= __('Сортировка') ?></option>
				<option data-value="best_selling" value="Самые популярные"><?= __('Топ Продаж' , 'mebelka') ?></option>
				<option data-value="price_asc" value="Самые дешевые"><?= __('От дешёвых к дорогим' , 'mebelka') ?></option>
				<option data-value="price_desc" value="Самые дорогие"><?= __('От дорогих к дешёвым' , 'mebelka') ?></option>
			</select>
		</div>
	</div>
	<?php
}, 20 );

add_action('woocommerce_after_main_content', 'custom_output_after_main_content');
function custom_output_after_main_content() { 
global $wpdb;

$term_id = 0;
if (is_tax('product_cat')) {
    $term = get_queried_object();
    $term_id = $term->term_id;
}

if ($term_id) {
    $meta_sql = "
        SELECT MIN(pm.meta_value+0) as min_price, MAX(pm.meta_value+0) as max_price
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        WHERE pm.meta_key = '_price'
        AND p.post_type = 'product'
        AND p.post_status = 'publish'
        AND tr.term_taxonomy_id = %d
    ";
    $prices = $wpdb->get_row($wpdb->prepare($meta_sql, $term_id));
} else {
    $prices = $wpdb->get_row("
        SELECT MIN(meta_value+0) as min_price, MAX(meta_value+0) as max_price
        FROM {$wpdb->postmeta}
        WHERE meta_key = '_price'
    ");
}

$fields = ['_length', '_width', '_height'];
$results = [];

foreach ($fields as $field) {
    if ($term_id) {
        $sql = "
            SELECT MIN(pm.meta_value+0) as min_val, MAX(pm.meta_value+0) as max_val
            FROM {$wpdb->posts} p
            INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
            INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
            WHERE pm.meta_key = %s
            AND p.post_type = 'product'
            AND p.post_status = 'publish'
            AND tr.term_taxonomy_id = %d
        ";
        $row = $wpdb->get_row($wpdb->prepare($sql, $field, $term_id));
    } else {
        $sql = "
            SELECT MIN(meta_value+0) as min_val, MAX(meta_value+0) as max_val
            FROM {$wpdb->postmeta}
            WHERE meta_key = %s
        ";
        $row = $wpdb->get_row($wpdb->prepare($sql, $field));
    }

    $results[$field] = [
        'min' => isset($row->min_val) ? floor($row->min_val) : 0,
        'max' => isset($row->max_val) ? ceil($row->max_val) : 0,
    ];
}

$min_length = $results['_length']['min'];
$max_length = $results['_length']['max'];

$min_width = $results['_width']['min'];
$max_width = $results['_width']['max'];

$min_height = $results['_height']['min'];
$max_height = $results['_height']['max'];

$min_price = $prices->min_price ? floor($prices->min_price) : 0;
$max_price = $prices->max_price ? ceil($prices->max_price) : 0;
?>
<section class="filters">
        <div class="filters__bg" data-close="closeFilter"></div>
            <div class="filters__wrap">
                <div class="filters__top">
                    <span><?= __('Фильтр' , 'mebelka') ?></span>
                    <button class="filter__btn" data-close="closeFilter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <g opacity="0.8">
                            <circle cx="20" cy="20" r="19.5" stroke="#003944"></circle>
                            <path d="M26.7919 13.2081C26.7261 13.1421 26.6479 13.0898 26.5618 13.0541C26.4757 13.0184 26.3834 13 26.2902 13C26.197 13 26.1048 13.0184 26.0187 13.0541C25.9326 13.0898 25.8544 13.1421 25.7886 13.2081L19.9963 19.001L14.2111 13.2152C14.0781 13.0822 13.8976 13.0074 13.7095 13.0074C13.5213 13.0074 13.3408 13.0822 13.2078 13.2152C13.0747 13.3483 13 13.5288 13 13.717C13 13.9051 13.0747 14.0856 13.2078 14.2187L18.993 20.0044L13.2078 25.7902C13.1085 25.8896 13.041 26.0162 13.0138 26.1541C12.9866 26.2919 13.001 26.4347 13.0551 26.5644C13.1093 26.694 13.2007 26.8046 13.3179 26.8822C13.435 26.9598 13.5725 27.0008 13.713 27C13.898 27 14.0759 26.9288 14.2182 26.7936L19.9963 21.0079L25.7815 26.7936C25.9238 26.9359 26.1017 27 26.2867 27C26.4717 27 26.6496 26.9288 26.7919 26.7936C26.8579 26.7278 26.9102 26.6496 26.9459 26.5635C26.9816 26.4774 27 26.3851 27 26.2919C27 26.1987 26.9816 26.1064 26.9459 26.0203C26.9102 25.9342 26.8579 25.856 26.7919 25.7902L20.9996 20.0044L26.7848 14.2187C27.0694 13.9411 27.0694 13.4857 26.7919 13.2081Z" fill="#003944"></path>
                            </g>
                            </svg>
                    </button>
                </div>

                <?php if (!is_tax('product_cat')): ?>
                <div class="filters__color filter__item accord-item">
                    <div class="filter__item__top accord-item-top">
                        <span><?= __('Категории' , 'mebelka') ?></span>
                    </div>
                    <div class="filter__item__bottom accord-item-bottom">
                        <div class="filter__item__column">
                            <?php
                                $terms = get_terms([
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                ]);

                                if (!empty($terms) && !is_wp_error($terms)) {
                                foreach ($terms as $term) {
                                    echo '<label>';
                                    echo '<input type="checkbox" name="product_cat[]" value="' . esc_attr($term->slug) . '">';
                                    echo esc_html($term->name);
                                    echo '</label>';
                                }
                                }
                            ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="filters__size filter__item accord-item">
                    <div class="filter__item__top accord-item-top">
                        <span><?= __('Размеры' , 'mebelka') ?></span>
                    </div>
                    <div class="filter__item__bottom accord-item-bottom">
                        <div class="filter" data-filter="length">
                            <label for="length"><?= __('Длина, см' , 'mebelka') ?></label>
                            <div class="filter-range">
                                
                                <div class="filter-range__number"> 
                                    <span><?= __('От' , 'mebelka') ?></span>
                                    <input type="number" id="minLength" data-default="<?= $min_length ?>" value="<?= $min_length ?>" min="<?= $min_length ?>" max="<?= $max_length ?>">
                                    
                                </div>
                                <div class="filter-range__number">
                                <span><?= __('до' , 'mebelka') ?></span>
                                    <input type="number" id="maxLength" data-default="<?= $max_length ?>" value="<?= $max_length ?>" min="<?= $min_length ?>" max="<?= $max_length ?>">
                                </div>
                                </div>
                            <div class="filter-range__container" style="--min: 0%; --max: 100%;">
                                <div class="filter-price__active-line"></div>
                                    <input type="range" id="rangeMinLength" min="<?= $min_length ?>" max="<?= $max_length ?>" value="<?= $min_length ?>" step="1">
                                    <input type="range" id="rangeMaxLength" min="<?= $min_length ?>" max="<?= $max_length ?>" value="<?= $max_length ?>" step="1">
                            </div>
                        </div>
                        <div class="filter" data-filter="Width">
                            <label for="Width"><?= __('Ширина, см' , 'mebelka') ?></label>
                            <div class="filter-range">
                                
                                <div class="filter-range__number"> 
                                    <span><?= __('От' , 'mebelka') ?></span>
                                    <input type="number" data-default="<?= $min_width ?>" id="minWidth" value="<?= $min_width ?>" min="<?= $min_width ?>" max="<?= $max_width ?>">
                                    
                                </div>
                                <div class="filter-range__number">
                                <span><?= __('до' , 'mebelka') ?></span>
                                    <input type="number" id="maxWidth" data-default="<?= $max_width ?>" value="<?= $max_width ?>" min="<?= $min_width ?>" max="<?= $max_width ?>">
                                </div>
                                </div>
                            <div class="filter-range__container" style="--min: 0%; --max: 100%;">
                                <div class="filter-price__active-line"></div>
                                    <input type="range" id="rangeMinWidth" min="<?= $min_width ?>" max="<?= $max_width ?>" value="<?= $min_width ?>" step="1">
                                    <input type="range" id="rangeMaxWidth" min="<?= $min_width ?>" max="<?= $max_width ?>" value="<?= $max_width ?>" step="1">
                            </div>
                        </div>
                        <div class="filter" data-filter="Height">
                            <label for="Height"><?= __('Высота, см' , 'mebelka') ?></label>
                            <div class="filter-range">
                                
                                <div class="filter-range__number"> 
                                    <span><?= __('От' , 'mebelka') ?></span>
                                    <input type="number" id="minHeight" data-default="<?= $min_height ?>" value="<?= $min_height ?>" min="<?= $min_height ?>" max="<?= $max_height ?>">
                                    
                                </div>
                                <div class="filter-range__number">
                                <span><?= __('до' , 'mebelka') ?></span>
                                    <input type="number" id="maxHeight" data-default="<?= $max_height ?>" value="<?= $max_height ?>" min="<?= $min_height ?>" max="<?= $max_height ?>">
                                </div>
                                </div>
                            <div class="filter-range__container" style="--min: 0%; --max: 100%;">
                                <div class="filter-price__active-line"></div>
                                    <input type="range" id="rangeMinHeight" min="<?= $min_height ?>" max="<?= $max_height ?>" value="<?= $min_height ?>" step="1">
                                    <input type="range" id="rangeMaxHeight" min="<?= $min_height ?>" max="<?= $max_height ?>" value="<?= $max_height ?>" step="1">
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            $terms = get_terms([
                                'taxonomy' => 'pa_color',
                                'hide_empty' => true,
                            ]);
                            
                            if (!empty($terms) && !is_tax('pa_color')) { ?>
                <div class="filters__color filter__item accord-item">
                    <div class="filter__item__top accord-item-top">
                        <span><?= __('Цвет' , 'mebelka') ?></span>
                    </div>
                    <div class="filter__item__bottom accord-item-bottom">
                                <?php 
                                echo '<div class="filter__item__column">';
                                foreach ($terms as $term) {
                                    echo '<label class="filter__radio__wrap">';
                                    echo '<input type="checkbox" name="color[]" value="' . esc_attr($term->slug) . '">';
                                    echo esc_html($term->name);
                                    echo '</label>';
                                }
                                echo '</div>';
                          
                            
                            ?>
            
                    </div>
                </div>
                <?php } ?>
                <div class="filters__size filter__item accord-item">
                    <div class="filter__item__top accord-item-top">
                        <span><?= __('Цена' , 'mebelka') ?></span>
                    </div>
                    <div class="filter__item__bottom accord-item-bottom">
                        <div class="filter" data-filter="Price">
                            <label for="Price"><?= __('Цена' , 'mebelka') ?></label>
                            <div class="filter-range">
                                
                                <div class="filter-range__number"> 
                                    <span><?= __('От' , 'mebelka') ?></span>
                                    <input type="number" name="price_min" id="minPrice" data-default="<?= $min_price ?>" value="0" min="<?= $min_price ?>" max="<?= $max_price ?>">
                                    
                                </div>
                                <div class="filter-range__number">
                                <span><?=  __('до' , 'mebelka') ?></span>
                                    <input type="number" name="price_max" id="maxPrice" data-default="<?= $max_price ?>" value="<?= $max_price ?>" min="<?= $min_price ?>" max="<?= $max_price ?>">
                                </div>
                                </div>
                            <div class="filter-range__container" style="--min: 0%; --max: 100%;">
                                <div class="filter-price__active-line"></div>
                                    <input type="range" id="rangeMaxPrice" min="<?= $min_price ?>" max="<?= $max_price ?>" value="<?= $max_price ?>" step="1">
                                    <input type="range" id="rangeMinPrice" min="<?= $min_price ?>" max="<?= $max_price ?>" value="0" step="1">
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="filters__wrap__btns">
                    <button class="filterApply"><?= __('Применить' , 'mebelka') ?></button>
                    <button class="filterReset"><?= __('Сбросить фильтр' , 'mebelka') ?></button></div>
            </div>
    </section>
    <?php
}


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

add_action('woocommerce_single_product_summary', 'custom_product_add_links', 35);

function custom_product_add_links() {
    $kaspi = get_field('kaspi'); 
    $halykmarket = get_field('halykmarket');

    if ($kaspi || $halykmarket) {
        echo '<div class="custom-product-links">';

        if ($kaspi) {
            echo '<a href="' . esc_url($kaspi) . '" class="custom-link-1" target="_blank" rel="noopener">
                <svg width="40" height="40" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><defs><style>.a{fill:none;stroke:red;stroke-linecap:round;stroke-linejoin:round;}</style></defs><circle class="a" cx="24" cy="24" r="21.5"/><path class="a" d="M14.6467,43.3634c-.5346-4.02-.3663-8.8149.8533-9.0672s1.7205,6.9922,1.7434,10.12"/><path class="a" d="M10.8371,41.0006c1.6769-6.9147-.3838-12.0876-.5521-13.4334s1.59-4.9622,1.472-7.6962c-.1682-3.9113,2.9439-5.7617,2.9439-7.2337s-.0841-6.014,3.4066-5.8878-.8029,4.542-.8641,5.8458,2.5884,1.7663,3.85,5.7616,1.9345,4.9206,5.1308,4.4159,5.5514-1.85,5.257-3.3645-1.43-5.3411,2.4393-6.0981-.1683,4.8365,0,5.7617,2.1869,1.472,3.9953-1.0094,3.028-4.4579,4.0794-3.1962-1.7243,4.7944-3.4065,6.35a6.4033,6.4033,0,0,0-2.3552,6.4766c.715,3.9533,1.7562,7.317,4.0323,10.3664"/><path class="a" d="M21.39,45.3425c-1.0532-4.6958-1.5578-13.3173-.6746-16.4715s3.2383-4.458,6.5607-1.9767,3.2582,17.5941,3.2582,17.5941"/><path class="a" d="M34.6,42.709c-1.5919-2.9323-1.6467-7.3193-.2589-7.9922s3.1621,6.0138,3.1621,6.0138"/></svg>
            </a>';
        }

        if ($halykmarket) {
            echo '<a href="' . esc_url($halykmarket) . '" class="custom-link-2" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="-10 30 140 60" fill="none" style="&#10;    /* width: 500px; */&#10;    /* width: 40px; */&#10;    /* height: 40px; */&#10;">
                <path d="M23.2606 40.5347L53.8274 17.6977L84.3941 40.5347L107.655 40.5347L53.8274 5.98692e-08L4.62616e-08 40.5347L23.2606 40.5347Z" fill="#F89734"/>
                <path d="M93.5754 21.2672L93.5754 1.95812e-08L75.9717 0L75.9717 8.01724L93.5754 21.2672Z" fill="#16B568"/>
                <path d="M24.9451 48.6247L11.5004 48.5895C5.74756 48.5895 3.83837 52.3271 3.83838 55.0266C3.83839 59.8024 7.66518 62.6056 15.1077 62.211C17.8307 75.9406 20.5627 88.0964 23.2729 101.851L84.6365 101.851C88.28 83.5614 91.627 67.0201 95.2449 48.7181C83.0049 48.5891 71.0425 48.5891 61.7376 48.5891L61.3583 48.5891C55.6055 48.5891 53.6994 52.7509 53.6879 55.13C53.6764 57.509 55.6055 62.2671 61.3583 62.2671L80.0574 62.2671C78.2549 71.3994 76.4395 80.5254 74.6114 89.6452L33.018 89.6452C30.3206 76.0028 27.6297 62.3294 24.9451 48.6247Z" fill="#16B568"/>
                <path d="M30.9522 119.604C35.1885 119.604 38.6226 116.257 38.6226 112.129C38.6226 108 35.1885 104.654 30.9522 104.654C26.7159 104.654 23.2817 108 23.2817 112.129C23.2817 116.257 26.7159 119.604 30.9522 119.604Z" fill="#16B568"/>
                <path d="M76.7029 119.604C80.9392 119.604 84.3734 116.257 84.3734 112.129C84.3734 108 80.9392 104.654 76.7029 104.654C72.4667 104.654 69.0325 108 69.0325 112.129C69.0325 116.257 72.4667 119.604 76.7029 119.604Z" fill="#16B568"/>
            </svg>
            </a>';
        }

        echo '</div>';
    }
}


add_action('woocommerce_single_product_summary', 'add_share_product', 40);

function add_share_product() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    echo '<div class="state__share">
        <span>' . __('Поделиться', 'mebelka') . '</span>
        <div class="state__share__links contact-links">
            <a href="https://t.me/share/url?url=' . $url . '&text=' . $title . '" target="_blank" rel="nofollow">
            <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.499172 7.2935C0.542805 7.2713 0.586459 7.25021 0.629001 7.23023C1.36858 6.88169 2.11798 6.55535 2.86629 6.22902C2.90665 6.22902 2.97427 6.18129 3.01245 6.16575C3.07026 6.14022 3.12808 6.1158 3.1859 6.09027L3.5186 5.94486C3.74113 5.84829 3.96256 5.75172 4.18509 5.65515C4.62905 5.46201 5.07302 5.26887 5.51698 5.07462C6.40492 4.68834 7.29396 4.30095 8.1819 3.91467C9.06983 3.52839 9.95885 3.14101 10.8468 2.75473C11.7347 2.36845 12.6237 1.98106 13.5117 1.59478C14.3996 1.2085 15.2886 0.821113 16.1766 0.434834C16.374 0.348255 16.5878 0.219495 16.7994 0.181755C16.9772 0.149565 17.1507 0.087406 17.3296 0.0529962C17.6688 -0.0124936 18.043 -0.0391336 18.368 0.104056C18.4804 0.154006 18.584 0.223935 18.6702 0.311625C19.0825 0.726763 19.0247 1.4083 18.9374 1.99216C18.3299 6.06141 17.7223 10.1318 17.1136 14.201C17.0307 14.7593 16.9172 15.3721 16.4842 15.725C16.1177 16.0236 15.5962 16.0569 15.1435 15.9304C14.6909 15.8027 14.2916 15.5352 13.9 15.2722C12.2758 14.1777 10.6504 13.0832 9.0262 11.9888C8.64004 11.729 8.21026 11.3894 8.21463 10.9176C8.21681 10.6335 8.38369 10.3804 8.55386 10.1551C9.96539 8.2814 12.002 6.9938 13.5171 5.20671C13.7309 4.95474 13.8989 4.49964 13.6055 4.35423C13.431 4.26765 13.2302 4.38531 13.071 4.49742C11.0682 5.91267 9.06656 7.32902 7.0638 8.74427C6.41039 9.20603 5.72535 9.68111 4.93777 9.79432C4.2331 9.89644 3.52406 9.69665 2.8423 9.49241C2.2707 9.32147 1.70018 9.14609 1.13186 8.96516C0.829699 8.8697 0.51772 8.76647 0.284282 8.55002C0.050845 8.33357 -0.0833088 7.96949 0.0574081 7.68089C0.145765 7.49996 0.317028 7.38563 0.497015 7.29239L0.499172 7.2935Z" fill="#003944"/>
            </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" rel="nofollow">
            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.39703 17.9969V9.80091H9.16203L9.57303 6.59191H6.39703V4.54791C6.39703 3.62191 6.65503 2.98791 7.98403 2.98791H9.66803V0.127906C8.84803 0.0389058 8.02503 -0.00309421 7.20103 -9.42147e-05C4.75703 -9.42147e-05 3.07903 1.49191 3.07903 4.23091V6.58591H0.332031V9.79591H3.08503V17.9969H6.39703Z" fill="#003944"/>
            </svg>
            </a>
            <a href="https://vk.com/share.php?url=' . $url . '&title=' . $title . '" target="_blank" rel="nofollow">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.8777 17.3036C7.46669 17.3036 4.18269 13.5486 4.05469 7.30957H6.79469C6.88069 11.8926 8.96569 13.8376 10.5647 14.2346V7.30957H13.1917V11.2636C14.7337 11.0936 16.3467 9.29357 16.8897 7.30957H19.4737C19.0597 9.75057 17.3037 11.5496 16.0617 12.2926C17.3037 12.8926 19.3017 14.4626 20.0727 17.3026H17.2327C16.6327 15.4046 15.1627 13.9336 13.1927 13.7336V17.3036H12.8777Z" fill="#003944"/>
            </svg>
            </a>
        </div>
    </div>';
}
