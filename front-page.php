<?php get_header(); ?>
<main>
	<div class="container">
		<div class="page-main">
			<?= get_sidebar() ?>
			<div class="main-content">
				<?= the_content(); ?>
			</div>
	</div>
</main>
<?php get_footer(); ?>