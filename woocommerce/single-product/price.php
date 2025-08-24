<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$regular_price = floatval($product->get_regular_price()); 
$sale_price = floatval($product->get_sale_price()); 

if ($regular_price > 0 && $sale_price < $regular_price) {
    $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
} else {
    $percentage = 0;
}
?>

<?php if ($product->is_on_sale()) : ?>
    <div class="staff__price">
        <div class="staff__price__sale">
            <span class="staff__downPrice"><?= number_format($regular_price, 0, ',', ' ') ?> <?= get_woocommerce_currency_symbol(); ?></span>
            <span class="staff-sale">-<?= $percentage ?>%</span>
        </div>
        <span class="staff-price"><?= number_format($sale_price, 0, ',', ' ') ?> <?= get_woocommerce_currency_symbol(); ?></span>
    </div>
<?php else : ?>
    <div class="staff__price">
        <span class="staff-price"><?= number_format($regular_price, 0, ',', ' ') ?> <?= get_woocommerce_currency_symbol(); ?></span>
    </div>
<?php endif; ?>
