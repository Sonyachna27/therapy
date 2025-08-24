<?php $partners_title = get_sub_field('partners_title'); ?>
<?php if( have_rows('partners') ): ?>
<section class="partners">
    <div class="partners__container">
        <div class="partners__title justify-title">
            <?php if($partners_title) : ?>
            <h2><?= $partners_title ?></h2>
            <?php endif; ?>
            <div class="slider-arrows">       
                <div class="partners-button-prev slider-arrow slider-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <g clip-path="url(#clip0_406_1560)">
                        <path d="M8.03613 10.5L4.54315 7.18109C3.59462 6.27983 3.61222 4.76238 4.5814 3.88336L8.03613 0.75" stroke="#003944" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_406_1560">
                        <rect width="12" height="12" fill="white" transform="translate(12) rotate(90)"/>
                        </clipPath>
                        </defs>
                        </svg>
                </div>
                <div class="partners-button-next slider-arrow slider-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <g clip-path="url(#clip0_406_1564)">
                        <path d="M3.96387 1.5L7.45684 4.81891C8.40538 5.72017 8.38778 7.23761 7.4186 8.11664L3.96387 11.25" stroke="#003944" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_406_1564">
                        <rect width="12" height="12" fill="white" transform="translate(0 12) rotate(-90)"/>
                        </clipPath>
                        </defs>
                        </svg>
                </div>
            </div>
        </div>
        
        <div class="partners__items">
            <div class="swiper partnersSlider slider-init">
                <div class="swiper-wrapper partners-wrapper ">
                    <?php while( have_rows('partners') ): the_row(); 
                        $partners_logo = get_sub_field('partners_logo');
                        ?>
                        <?php if($partners_logo) : ?>
                        <div class="swiper-slide partners__slide">
                            <img src="<?= $partners_logo ?>" alt="<?= get_the_title(); ?>">
                        </div>
                        <?php endif; ?>
                    <?php endwhile; ?>

                </div>
                <div class="partners-pagination slider-pagination"></div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>