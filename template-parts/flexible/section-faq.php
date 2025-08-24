<?php 
$faq_title = get_sub_field('faq_title');
$faq_page = get_sub_field('faq_page');
?>
<?php if( have_rows('faq') ): ?>
<section class="faq pb-m mb-m" id="faq">		
    <div class="faq__container">
            <?php if($faq_title) : ?>
            <div class="faq__title justify-title">
                <h2><?= $faq_title ?></h2>
                <?php if(!$faq_page) : ?>
                    <a href="<?= get_wpml_lang_prefix(); ?>/faq/"><?= __('Смотреть все' , 'mebelka') ?></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="faq__items accord">
                <?php $itt = 1; while( have_rows('faq') ): the_row(); 
                    $faq_ask = get_sub_field('faq_ask');
                    $faq_answer = get_sub_field('faq_answer');
                    ?>
                <div class="faq__item accord-item" >
                    <div class="faq__item__top accord-item-top">
                        <?php if($faq_ask) : ?>
                            <p><?=$itt?>. <?= $faq_ask ?></p>
                        <?php endif; ?>
                        <div class="faq-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                <path d="M12 4.73193L8.63599 8.677C7.72416 9.74633 6.06605 9.72737 5.17891 8.63745L2 4.73193" stroke="#003944" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </div>
                    </div>
                    <?php if($faq_answer) : ?>
                    <div class="faq__item-bottom accord-item-bottom">
                        <div class="faq__item-bottom-wrap">
                            <?= $faq_answer ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php $itt++; endwhile; ?>
            
        </div>
        </div>
</section>
<?php endif; ?>