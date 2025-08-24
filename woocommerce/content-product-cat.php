<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные
$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
$image_url = wp_get_attachment_url($thumbnail_id);
$link = get_term_link($category);
$products = wc_get_products([
	'status'    => 'publish',
	'limit'     => -1,
	'category'  => [$category->slug],
	'orderby'   => 'price',
	'order'     => 'ASC',
]);
$count = count($products);
$min_price = $products ? wc_price($products[0]->get_price()) : '—';
?>

<li class="popular__catalog__item product-category product">
	<a href="<?php echo esc_url($link); ?>" class="popular__catalog__item__cat">
		<h3><?php echo esc_html($category->name); ?></h3>
		<span><?php echo $count; ?> <?php echo mebelka_get_model_word($count); ?></span>
	</a>
	<div class="popular__catalog__item__info">
		<a href="<?php echo esc_url($link); ?>">
			<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
		</a>
		<a href="<?php echo esc_url($link); ?>" class="popular__catalog__item__price">
			<?= __('от', 'mebelka') ?> <span><?php echo $min_price; ?></span>
		</a>
	</div>
</li>
