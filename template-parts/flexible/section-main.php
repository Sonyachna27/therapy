<section class="hero">
        <div class="hero__container">
        <?php if( have_rows('main_banner') ): ?>
            <div class="hero__slider">
                <div class="swiper heroSlider">
                    <div class="swiper-wrapper hero__slider__wrap">
                        <?php while( have_rows('main_banner') ): the_row(); 
                            $main_banner_image = get_sub_field('main_banner_image');?>
                            <?php if($main_banner_image) : ?>
                                <div class="swiper-slide hero__slide">
                                    <img src="<?= $main_banner_image ?>" alt="<?= $main_banner_image ?>">
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="hero-pagination"></div>
                    <div class="slider-arrows hero-arrows">
                
                        <div class="hero-button-prev slider-arrow slider-prev">
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
                        <div class="hero-button-next slider-arrow slider-next">
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
            </div>
            <?php endif; ?>
            <?php if( have_rows('main_advantages') ): ?>            
            <div class="hero__advantages">
                <?php while( have_rows('main_advantages') ): the_row(); 
                    $main_advantages_icon = get_sub_field('main_advantages_icon');
                    $main_advantages_title = get_sub_field('main_advantages_title');
                    $main_advantages_description = get_sub_field('main_advantages_description');
                    ?>
                    <div class="hero__advantages__item">
                        <?php if($main_advantages_icon) : ?>
                            <img src="<?= $main_advantages_icon ?>" alt="<?= $main_advantages_title ? $main_advantages_title : get_the_title(); ?>">
                        <?php endif; ?>
                        <div class="hero__advantages__item__content">
                            <?php if($main_advantages_title) : ?>
                                <span><?= $main_advantages_title ?></span>
                            <?php endif; ?>
                            <?php if($main_advantages_description) : ?>
                                <p><?= $main_advantages_description ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                
            </div>
            <?php endif; ?>

        </div>
</section>