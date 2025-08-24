<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */


defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form basket__items" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$quantity = $cart_item['quantity'];

				$regular_price = $_product->get_regular_price();
				$sale_price = $_product->get_price();

				$total_regular = $regular_price * $quantity;
				$total_sale = $sale_price * $quantity;

				$discount = 0;
				if ( $regular_price > $sale_price ) {
					$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
				}
				/**
				 * Filter the product name.
				 *
				 * @since 2.1.0
				 * @param string $product_name Name of the product in the cart.
				 * @param array $cart_item The product in the cart.
				 * @param string $cart_item_key Key for the product in the cart.
				 */
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


						<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<div class="basket__item__info">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( $product_name . '&nbsp;' );
							} else {
								/**
								 * This filter is documented above.
								 *
								 * @since 2.1.0
								 */
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}


							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>
						</div>
						<div class="basket__item__arts">
							<?php if ( wc_product_sku_enabled() && isset( $cart_item['data'] ) ) :
							$product = $cart_item['data'];
							$sku = $product->get_sku();
							?>
							<span class="basket__item__info__art"><?= __('Артикул' , 'mebelka') ?>: <span><?php echo $sku ? '#' . $sku : esc_html__( 'N / A', 'woocommerce' ); ?></span></span>
							<?php endif; ?>
						</div>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<div class="basket__item__counter">
						<?php
						if ( $_product->is_sold_individually() ) {
							$min_quantity = 1;
							$max_quantity = 1;
						} else {
							$min_quantity = 0;
							$max_quantity = $_product->get_max_purchase_quantity();
						}

						$product_quantity = woocommerce_quantity_input(
							array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $max_quantity,
								'min_value'    => $min_quantity,
								'product_name' => $product_name,
							),
							$_product,
							false
						);
						?>
						<div class="counter">
							<button type="button" class="counter__button counter__button--decrease">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M9.60761 6.71786H2.55573V5.71045H9.60761V6.71786Z" fill="#121212"></path>
								</svg>
							</button>
							<?php echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok. ?>
							<button type="button" class="counter__button counter__button--increase">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M10.1118 6.57005H7.08959V9.59229H6.08217V6.57005H3.05994V5.56264H6.08217V2.54041H7.08959V5.56264H10.1118V6.57005Z" fill="#1F1D1D"></path>
								</svg>
							</button>
						</div>
						</div>
					</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
						<div class="basket__item__price">
							<div class="price"><?php echo wc_price( $total_sale ); ?></div>
							
							<?php if ( $discount > 0 ) : ?>
								<div>
									<span class="old-price"><?php echo wc_price( $total_regular ); ?></span>
									<span class="sale">-<?php echo $discount; ?>%</span>
								</div>
							<?php endif; ?>
						</div>
						</td>
						<td class="product-remove">
							<div class="basket__item__remove">
								<button class="remove-item" data-cart-item="<?php echo esc_attr($cart_item_key); ?>">
									<svg class="remove-item" data-cart-item="<?php echo esc_attr($cart_item_key); ?>" xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 20 23" fill="none">
										<path d="M12.9511 19.1322H7.04609C6.5736 19.1321 6.11853 18.9438 5.77185 18.6048C5.42517 18.2657 5.21241 17.8011 5.17609 17.3036L4.37109 6.25781H15.6261L14.8211 17.3045C14.785 17.802 14.5723 18.2668 14.2255 18.6059C13.8788 18.9449 13.4236 19.1323 12.9511 19.1322Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
										<path d="M16.6673 6.25781H3.32812" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
										<path d="M7.65318 3.28604H12.3423C12.8607 3.28604 13.2807 3.72956 13.2807 4.27604V6.2578H6.71484V4.2778C6.71484 3.73044 7.13401 3.28692 7.65234 3.28692L7.65318 3.28604Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
								</button>
							</div>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr class="cart_item_actions">
				<td colspan="6" class="actions">

					<button type="submit" class="hushladies-button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
