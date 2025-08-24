<?php $popular_title = get_sub_field('popular_title'); ?>
<section class="popular mb-m">
    <div class="popular__container">
        <?php if ($popular_title) : ?>
        <div class="popular__title justify-title">
            <h2><?= $popular_title ?></h2>
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"><?= __('Смотреть весь каталог' , '') ;?></a>
        </div>
        <?php endif; ?>
        <div class="popular__catalog">
            <?php
            $args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => true,
                'number'     => 5,
                'parent'     => 0
            );
            $product_categories = get_terms($args);

            foreach ($product_categories as $category) {
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
                <div class="popular__catalog__item">
                    <a href="<?php echo esc_url($link); ?>" class="popular__catalog__item__cat">
                        <h3><?php echo esc_html($category->name); ?></h3>
                        <span><?php echo $count; ?> <?php echo mebelka_get_model_word($count); ?></span>
                    </a>
                    <div class="popular__catalog__item__info">
                        <a href="<?php echo esc_url($link); ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        </a>
                        <a href="<?php echo esc_url($link); ?>" class="popular__catalog__item__price">
                            <?= __('от' , 'mebelka') ?> <span><?php echo $min_price; ?></span>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
