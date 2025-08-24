<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
$product_id = $product->get_id();
$price = $product->get_price();
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$percent = $regular_price && $sale_price ? round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) : 0;

$main_image_url = get_the_post_thumbnail_url( $product_id, 'full' );
$gallery_image_ids = $product->get_gallery_image_ids();

$rating = $product->get_average_rating();
$reviews_count = $product->get_review_count();
?>


	
	<div class="product__item">
    <div class="wishlist-button" data-id="<?php echo esc_attr( $product_id ); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
			<path d="M16.5222 1C20.3967 1 23 4.53875 23 7.84C23 14.5256 12.1956 20 12 20C11.8044 20 1 14.5256 1 7.84C1 4.53875 3.60333 1 7.47778 1C9.70222 1 11.1567 2.08063 12 3.03063C12.8433 2.08063 14.2978 1 16.5222 1Z" stroke="#003944" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg>
    </div>

    <div class="product__slider">
        <div class="swiper productSlider">
            <div class="swiper-wrapper">
                <?php if ( $main_image_url ) : ?>
                    <a href="<?= get_the_permalink(); ?>" class="swiper-slide product__slide">
                        <img src="<?php echo esc_url( $main_image_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                <?php endif; ?>
                <?php foreach ( $gallery_image_ids as $image_id ) :
                    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                    if ( ! $image_url ) continue;
                ?>
                    <a href="<?= get_the_permalink(); ?>" class="swiper-slide product__slide">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="product-pagination swiper-pagination"></div>
        </div>
    </div>

    <div class="product__info">
        <div class="product__price">
            <?php if ( $regular_price && $sale_price ) : ?>
                <div class="product__price__sale">
                    <span class="price__sale"><?php echo wc_price( $regular_price ); ?></span>
                    <span class="sale">-<?php echo $percent; ?>%</span>
                </div>
                <span class="price"><?php echo wc_price( $sale_price ); ?></span>
            <?php else : ?>
                <span class="price"><?php echo wc_price( $price ); ?></span>
            <?php endif; ?>
        </div>

        <div class="product__descr">
            <a href="<?php the_permalink(); ?>" class="product__name"><?php the_title(); ?></a>

            <?php if ( $reviews_count >= 0 ) : ?>
                <div class="product__reviews">
                    <a href="<?php the_permalink(); ?>#reviews" class="rating-link">
                        <div class="stars">
                            <?php
                            $full_stars = floor( $rating );
                            $half_star = ( $rating - $full_stars ) >= 0.5;
                            for ( $i = 0; $i < 5; $i++ ) {
                                if ( $i < $full_stars ) {
                                    echo '<svg width="16" height="16" fill="#ffc107"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
                                } elseif ( $i === $full_stars && $half_star ) {
                                    echo '<svg width="16" height="16" fill="#ffc107"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77V.25z"/><path fill="#e4e4e4" d="M8 .25v13.52l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
                                } else {
                                    echo '<svg width="16" height="16" fill="#e4e4e4"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
                                }
                            }
                            ?>
                        </div>
                        <span class="reviews-count">(<?php echo $reviews_count; ?>)</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <button class="btn product__btn add-to-cart-button add_to_cart_button quick-add-to-cart" data-product_id="<?php echo esc_attr( $product_id ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                <path d="M19.8827 0.61142C19.8373 0.531325 19.7761 0.461328 19.7027 0.405706C19.6218 0.344953 19.5279 0.303869 19.4284 0.285706L0.571289 0.285706V1.65713H2.78272L6.13415 10.8714C6.32003 11.3925 6.66103 11.8442 7.11129 12.1657C7.56302 12.4835 8.10183 12.6541 8.65415 12.6543H16.9341V11.3H8.65415C8.38158 11.2981 8.11585 11.2145 7.89129 11.06C7.67584 10.9008 7.51431 10.6794 7.42843 10.4257L6.80272 8.65999H16.5313C16.8963 8.65632 17.2507 8.5362 17.5427 8.31713C17.8311 8.10474 18.0419 7.80364 18.1427 7.45999L19.9427 1.14285C19.9637 1.04973 19.9637 0.953108 19.9427 0.859991C19.9368 0.774348 19.9166 0.690311 19.8827 0.61142ZM16.7456 7.29713H6.27986L4.22272 1.65713H18.3484L16.7456 7.29713ZM9.58843 14.6428C9.36557 14.4235 9.06541 14.3006 8.75272 14.3006C8.44003 14.3006 8.13987 14.4235 7.917 14.6428C7.69459 14.8725 7.57144 15.1803 7.57415 15.5C7.57042 15.6586 7.59888 15.8163 7.65781 15.9637C7.71674 16.111 7.80491 16.2448 7.917 16.3571C8.14195 16.5725 8.44132 16.6926 8.75272 16.6926C9.06411 16.6926 9.36349 16.5725 9.58843 16.3571C9.70052 16.2448 9.7887 16.111 9.84762 15.9637C9.90655 15.8163 9.93501 15.6586 9.93129 15.5C9.93399 15.1803 9.81084 14.8725 9.58843 14.6428ZM15.5884 14.6428C15.4761 14.5308 15.3423 14.4426 15.195 14.3837C15.0476 14.3247 14.8899 14.2963 14.7313 14.3C14.5756 14.2989 14.4213 14.3287 14.2773 14.3877C14.1333 14.4467 14.0024 14.5338 13.8923 14.6439C13.7823 14.754 13.6952 14.8848 13.6361 15.0288C13.5771 15.1729 13.5473 15.3272 13.5484 15.4828C13.5447 15.6415 13.5732 15.7992 13.6321 15.9465C13.691 16.0938 13.7792 16.2277 13.8913 16.34C14.1182 16.5515 14.4168 16.6691 14.727 16.6691C15.0372 16.6691 15.3358 16.5515 15.5627 16.34C15.6748 16.2277 15.763 16.0938 15.8219 15.9465C15.8808 15.7992 15.9093 15.6415 15.9056 15.4828C15.9108 15.1727 15.7973 14.8722 15.5884 14.6428Z" fill="#003944"/>
            </svg>
            <span><?= __('В корзину' , 'mebelka') ?></span>
        </button>

    </div>
</div>
