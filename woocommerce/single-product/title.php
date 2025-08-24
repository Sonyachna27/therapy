<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;

$rating = $product->get_average_rating();
$reviews_count = $product->get_review_count();

the_title( '<h1 class="">', '</h1>' );

 if ( $reviews_count >= 0 ) : ?>
	<div class="product__reviews">
		<a href="<?php the_permalink(); ?>#reviews" class="rating-link staff__reviews__count">
			<div class="stars">
				<?php
				$full_stars = floor( $rating );
				$half_star = ( $rating - $full_stars ) >= 0.5;
				for ( $i = 0; $i < 5; $i++ ) {
					if ( $i < $full_stars ) {
						echo '<svg width="16" height="16" fill="#ffc107"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
					} elseif ( $i === $full_stars && $half_star ) {
						echo '<svg width="16" height="16" fill="#ffc107"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77V.25z"/><path fill="#e4e4e4" d="M8 .25v13.52l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
					} else {
						echo '<svg width="16" height="16" fill="#e4e4e4"><path d="M8 .25l2.47 5.01L16 6.17l-4 3.91.95 5.55L8 13.77l-4.95 2.86L4 10.08 0 6.17l5.53-.91L8 .25z"/></svg>';
					}
				}
				?>
			</div>
			<span class="reviews-count"> | </span>
			<span class="reviews-count"><?php echo $reviews_count; ?></span>
		</a>
	</div>
<?php endif; ?>