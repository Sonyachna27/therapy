<?php $post_type = get_post_type(); 
get_header(); ?>
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
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
            
                <?= get_template_part('template-parts/single/single' , $post_type ) ?>
                <div class="public mb-m">
                    <p><?= __('Обновлено' , 'mebelka') ?></p>
                    <span><?php echo get_the_modified_date('d.m.Y'); ?></span>
                </div>


            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>