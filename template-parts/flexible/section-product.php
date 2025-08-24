<?php 
    $product_title = get_sub_field('product_title');
    $product_count = get_sub_field('product_count');
    $product_shop = get_sub_field('product_shop');
    $product_shop_category = get_sub_field('product_shop_category');
?>
<section class="products">
    <div class="products__container">
        <?php if($product_title) : ?>
            <h2><?= $product_title ?></h2>
        <?php endif; ?>
        <div class="products__wrap">
            <?php if($product_shop_category) : ?>
            <div class="products__links">
                <?php
                $terms = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                ]);

                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $link = get_term_link($term);
                        $name = $term->name;
                        echo '<a href="' . esc_url($link) . '" class="btn">' . esc_html($name) . '</a>';
                    }
                }
                ?>
            </div>
                <?php endif; ?>

                <div class="product__items">
				<?php
                    $args = [
                        'post_type'      => 'product',
                        'posts_per_page' => $product_count ? $product_count : 9,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    ];


					$query = new WP_Query($args);

					if ($query->have_posts()) :
						while ($query->have_posts()) : $query->the_post();
							wc_get_template_part( 'content', 'mebelproduct' );
						endwhile;
						wp_reset_postdata(); 
					else :
						echo 'Товары не найдены.';
					endif;
					?>
					</div>
                
            <?php if($product_shop) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn green"><?= __('Посмотреть больше' , 'mebelka') ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>