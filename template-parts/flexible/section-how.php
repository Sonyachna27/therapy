<?php $how_title = get_sub_field('how_title'); ?>
<?php if( have_rows('how') ): ?>
<section class="how mb-m">
    <div class="how__container">
        <?php if($how_title) : ?>
        <h2><?= $how_title ?></h2>
        <?php endif; ?>
        <div class="how__list">
            <?php while( have_rows('how') ): the_row(); 
                $how_repeater_icon = get_sub_field('how_repeater_icon');
                $how_repeater_title = get_sub_field('how_repeater_title');
                $how_repater_description = get_sub_field('how_repater_description');
                ?>
                <div class="how__list__item">
                    <?php if($how_repeater_icon) : ?>
                    <div class="how__list__item__img">
                        <img src="<?= $how_repeater_icon ?>" alt="<?= $how_repeater_title ? $how_repeater_title : get_the_title(); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="how__list__item__content">
                        <?php if($how_repeater_title) : ?>
                            <h3><?= $how_repeater_title ?></h3>
                        <?php endif ;?>
                        <?php if($how_repater_description) : ?>
                            <p><?= $how_repater_description ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
           
        </div>
    </div>
</section>
<?php endif; ?>