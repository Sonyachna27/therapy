<?php
defined( 'ABSPATH' ) || exit;
global $product;

$attachment_ids = $product->get_gallery_image_ids();
$post_thumbnail_id = $product->get_image_id();
?>

<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper staffSlider2">
    <div class="swiper-wrapper">
        <?php if ( $post_thumbnail_id ) : ?>
            <div class="swiper-slide staff__slide">
            <a href="<?= wp_get_attachment_image_url( $post_thumbnail_id  , 'full') ?>" data-fancybox="gallery" data-caption="<?= get_the_title(); ?>">
                <img src="<?= wp_get_attachment_image_url( $post_thumbnail_id  , 'full') ?>" />
            </a>
            </div>
        <?php endif; ?>
        <?php foreach ( $attachment_ids as $attachment_id ) : ?>
            <div class="swiper-slide staff__slide">
            <a href="<?= wp_get_attachment_url( $attachment_id, 'full' ) ?>" data-fancybox="gallery" data-caption="<?= get_the_title(); ?>">
                <img src="<?= wp_get_attachment_url( $attachment_id, 'full' ) ?>" />
            </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="staff-button-prev slider-arrow slider-prev">
		<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
			<g clip-path="url(#clip0_406_1560)">
			<path d="M8.03613 10.5L4.54315 7.18109C3.59462 6.27983 3.61222 4.76238 4.5814 3.88336L8.03613 0.75" stroke="#003944" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
			</g>
			<defs>
			<clipPath id="clip0_406_1560">
			<rect width="12" height="12" fill="white" transform="translate(12) rotate(90)"></rect>
			</clipPath>
			</defs>
		</svg>
    </div>
    <div class="staff-button-next slider-arrow slider-next">
		<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
			<g clip-path="url(#clip0_406_1564)">
			<path d="M3.96387 1.5L7.45684 4.81891C8.40538 5.72017 8.38778 7.23761 7.4186 8.11664L3.96387 11.25" stroke="#003944" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
			</g>
			<defs>
			<clipPath id="clip0_406_1564">
			<rect width="12" height="12" fill="white" transform="translate(0 12) rotate(-90)"></rect>
			</clipPath>
			</defs>
		</svg>
    </div>
</div>

<div thumbsSlider="" class="swiper staffSlider">
    <div class="swiper-wrapper">
        <?php if ( $post_thumbnail_id ) : ?>
            <div class="swiper-slide staff__slide">
                <?= wp_get_attachment_image( $post_thumbnail_id, 'full' ); ?>
            </div>
        <?php endif; ?>
        <?php foreach ( $attachment_ids as $attachment_id ) : ?>
            <div class="swiper-slide staff__slide">
                <?= wp_get_attachment_image( $attachment_id, 'full' ); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="staff-pagination slider-pagination"></div>
</div>
