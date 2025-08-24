<?php
/*
 * Template Name: Страница избранного
 * Description: Это моя кастомная страница избранного
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
        <section class="selected mb-m">
				<div class="container">
				<div class="selected__container">
					<div class="selected__score">0 <?= __('товара' , 'mebelka') ?></div>
                    <div id="wishlist-container">
                        <div class="selected__items">
                            <img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/selected-loading.svg" alt="Завантаження товару">
                            <img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/selected-loading.svg" alt="Завантаження товару">
                            <img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/selected-loading.svg" alt="Завантаження товару">
                            <img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/selected-loading.svg" alt="Завантаження товару">
                        </div>
                    </div>
				</div>
				</div>
			</section>
   </div>
</main>

<?php get_footer(); ?>
