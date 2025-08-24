<?php
/*
 * Template Name: Страница отзывов
 * Description: Это моя кастомная страница отзывов
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
?>
<?php get_header();
?>

<main class="main">
   <div class="container">
        <div class="breadcrumbs">
            <div class="container">
                <div class="breadcrumbs__links">
                    <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb();
                    } ?>
                </div>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <section class="reviewForm mb-m">
            <div class="reviewForm__wrap">
                <div>Оставьте отзывы о нашем товаре</div>
                <form id="reviewForm">
                <input type="text" name="review_name" placeholder="Имя" required>
                <input type="email" name="review_email" placeholder="Электронная почта" required>
                <input type="text" name="review_product" placeholder="Товар, который приобрели">
                <textarea name="review_text" placeholder="Ваш отзыв" required></textarea>

                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                </fieldset>

                <label>
                    <input type="checkbox" name="review_agree" required>
                    Соглашаясь с условиями, я принимаю политику конфиденциальности
                </label>

                <input type="hidden" name="commentPost" value="<?php echo get_the_ID(); ?>">
                <?php wp_nonce_field('submit_review', 'review_nonce'); ?>
                <input type="submit" value="Оставить отзыв">
                </form>

                <div id="review-response" style="margin-top:1em;color:green;"></div>
            </div>
            </section>

					<section class="reviews mb-m withoutSlider">
						<div class="reviews__container">
							<div class="reviews__title justify-title">
								<h2>Отзывы Mebelka</h2>
								<div class="reviews__btns">
									<a href="#">Смотреть все</a>
									<div class="slider-arrows">									
										<div class="reviews-button-prev slider-arrow slider-prev">
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
										<div class="reviews-button-next slider-arrow slider-next">
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
							<div class="reviews__slider">
								<div class="swiper reviewsSlider slider-init">
									<div class="swiper-wrapper reviews-wrapper ">
                                        <?php 
                                              $comments = get_comments(array(
                                                'post_id' =>  get_the_ID(),
                                                'status' => 'approve',
                                                'order' => 'DESC'
                                            ));
                                            
                                            wp_list_comments( array(
                                                'callback' => 'mebelka_reviews',
                                                'style'      => 'span',
                                                'max_depth' => 1
                                                
                                            ), $comments );
                                            ?>
                                     
									</div>
									<div class="reviews-pagination slider-pagination"></div>
								</div>
							</div>
						</div>
					</section>
</main>

<?php get_footer(); ?>
