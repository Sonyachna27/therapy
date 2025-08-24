<?php get_header(); ?>
<main>
	<section class="error">
		<div class="container">
			<div class="error__container">
				<img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/error-img.svg" alt="<?= __('404 - УПС, страницу уронили' , 'mebelka') ?>">
				<h1><?= __('404 - УПС, страницу уронили' , 'mebelka') ?></h1>
				<p><?= __('Извините, похоже, эта страница была удалена или поломана, не можем ее найти' , 'mebelka') ?></p>
				<a href="<?= get_home_url(); ?>" class="btn"><?= __('На главную' , 'mebelka') ?></a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>