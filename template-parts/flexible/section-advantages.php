<?php $advantages_title = get_sub_field('advantages_title'); ?>
<section class="advantages mb-m">
    <div class="advantages__container">
        <?php if($advantages_title) : ?>
            <h2><?= $advantages_title ?></h2>
        <?php endif; ?>
        <div class="advantages__list">
        <?php if( have_rows('advatages') ): ?>
            <?php while( have_rows('advatages') ): the_row(); 
                $advantages_repeater_title = get_sub_field('advantages_repeater_title');
                $advantages_repeater_description = get_sub_field('advantages_repeater_description');
                ?>
                <div class="advantages__list__item">
                    <?php if($advantages_repeater_title) : ?>
                        <h3><?= $advantages_repeater_title ?></h3>
                    <?php endif; ?>
                    <?php if($advantages_repeater_description) : ?>
                        <p><?= $advantages_repeater_description ?></p>
                    <?php endif; ?>
                    <img src="<?= MEBELKA_THEME_DIRECTORY ?>assets/images/advantages__img1.svg" alt="<?= $advantages_repeater_title ? $advantages_repeater_title : get_the_title(); ?>">
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        </div>
    </div>
</section>