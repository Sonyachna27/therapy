<?php 
    $author_id = get_the_author_meta('ID'); 
    $author_image_id = get_user_meta($author_id, 'author_logo', true); 
    $author_name = get_the_author_meta('display_name', $author_id); 
    $author_description = get_the_author_meta('description', $author_id); 
    $author_link = get_author_posts_url($author_id);
?>
<?php get_header(); ?>
<main>
    <div class="container">
        <div class="page-main">
            <?= get_sidebar(); ?>
            <div class="main-content">
                <div class="breadcrumbs">
                    <div class="container">
                        <div class="breadcrumbs__links">
                            <?php if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb();
                            } ?>
                        </div>
                        <h1><?php echo esc_html($author_name); ?></h1>
                    </div>
                </div>

                <section class="autor mb-m">
                    <div class="state__autor">
                        <?php if ($author_image_id): ?>
                            <img src="<?php echo esc_url(wp_get_attachment_url($author_image_id)); ?>" alt="<?php echo esc_attr($author_name); ?>">
                        <?php endif; ?>
                        <div class="state__autor__info">
                            <span><?= __('Об авторе', 'mebelka') ?></span>
                            <div><?php echo esc_html($author_name); ?></div>
                            <p><?php echo esc_html($author_description); ?></p>
                        </div>
                    </div>
                </section>
                <section class="news mb-m withoutSlider">
                    <div class="news__container">
                        <div class="news__slider">
                            <div class="newsSlider slider-init">
                                <div class="news-wrapper">
                                    <?php
                                        $args = [
                                            'post_type' => 'post',
                                            'posts_per_page' => -1, 
                                            'orderby' => 'date',
                                            'order' => 'DESC',
                                            'post_status' => 'publish',
                                            'author' => $author_id 
                                        ];
                                        $query = new WP_Query($args);
                                        if ($query->have_posts()) :
                                            while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <div class="news__slide news__item">
                                        <a href="<?php the_permalink(); ?>" class="news__item__img">
                                            <?php
                                                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                if ($image_url) {
                                                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '">';
                                                } 
                                            ?>
                                        </a>
                                        <div class="news__info">
                                            <div class="news__info__bar">
                                                <div class="news__info__date">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                        <path d="M3.7129 1.03226V0.1H5.06129V1.03226V1.13226H5.16129H9.80645H9.90645V1.03226V0.1H11.2548V1.03226V1.13226H11.3548H13.5836C14.2928 1.13226 14.8677 1.70719 14.8677 2.41642V14.6158C14.8677 15.3251 14.2928 15.9 13.5836 15.9H1.38417C0.674932 15.9 0.1 15.3251 0.1 14.6158V2.41642C0.1 1.7072 0.674945 1.13226 1.38417 1.13226H3.6129H3.7129V1.03226ZM3.7129 2.58065V2.48065H3.6129H1.54839H1.44839V2.58065V5.16129V5.26129H1.54839H13.4194H13.5194V5.16129V2.58065V2.48065H13.4194H11.3548H11.2548V2.58065V3.5129H9.90645V2.58065V2.48065H9.80645H5.16129H5.06129V2.58065V3.5129H3.7129V2.58065ZM13.5194 6.70968V6.60968H13.4194H1.54839H1.44839V6.70968V14.4516V14.5516H1.54839H13.4194H13.5194V14.4516V6.70968Z" fill="#003944" stroke="#F8F9FA" stroke-width="0.2"></path>
                                                    </svg>
                                                    <span><?php echo get_the_date('d.m.Y'); ?></span>
                                                </div>
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="news__info__autor">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84209 7.49984C7.84209 5.77395 9.2412 4.37484 10.9671 4.37484C12.693 4.37484 14.0921 5.77395 14.0921 7.49984C14.0921 9.22573 12.693 10.6248 10.9671 10.6248C9.2412 10.6248 7.84209 9.22573 7.84209 7.49984ZM10.9671 5.62484C9.93156 5.62484 9.09209 6.4643 9.09209 7.49984C9.09209 8.53537 9.93156 9.37484 10.9671 9.37484C12.0026 9.37484 12.8421 8.53537 12.8421 7.49984C12.8421 6.4643 12.0026 5.62484 10.9671 5.62484Z" fill="#003944"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.00876 9.99984C2.00876 5.05229 6.01954 1.0415 10.9671 1.0415C15.9146 1.0415 19.9254 5.05229 19.9254 9.99984C19.9254 14.9474 15.9146 18.9582 10.9671 18.9582C6.01954 18.9582 2.00876 14.9474 2.00876 9.99984ZM10.9671 2.2915C6.7099 2.2915 3.25876 5.74264 3.25876 9.99984C3.25876 12.1212 4.11565 14.0423 5.50218 15.4361C5.65251 14.6252 5.94788 13.8606 6.54073 13.2458C7.42753 12.3261 8.84556 11.8748 10.9671 11.8748C13.0885 11.8748 14.5066 12.3261 15.3934 13.2458C15.9862 13.8606 16.2816 14.6252 16.4319 15.4362C17.8185 14.0424 18.6754 12.1212 18.6754 9.99984C18.6754 5.74264 15.2243 2.2915 10.9671 2.2915ZM15.2952 16.3793C15.2103 15.3694 14.991 14.6293 14.4936 14.1134C13.9523 13.5521 12.9495 13.1248 10.9671 13.1248C8.98459 13.1248 7.98177 13.5521 7.44044 14.1134C6.94304 14.6293 6.72377 15.3694 6.63884 16.3793H15.2952Z" fill="#003944"></path>
                                                    </svg>
                                                    <span><?php echo esc_html($author_name); ?></span>
                                                </a>
                                            </div>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="news__info__link"><?= __('Узнать больше' , 'mebelka') ?></a>
                                        </div>
                                    </div>
                                    <?php endwhile;endif; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
