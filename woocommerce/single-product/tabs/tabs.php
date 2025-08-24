<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<div class="staff__botom mb-m">
	<div class="target__wrap staff__wrap">
		<ul class="staff__list target__list" id="reviews">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="staff__list-item target__list-item <?php echo esc_attr( $key ); ?>_tab" data-name="target-<?= esc_attr( $key ) ?>" id="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
		<div class="staff__content target__content woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="target-<?= $key ?>">
			<div class="staff__content__wrap">
				<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
				?>
			</div>
		</div>
		<?php endforeach; ?>
		
	</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_product_after_tabs' ); ?>
