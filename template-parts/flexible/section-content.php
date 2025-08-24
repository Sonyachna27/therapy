<?php 
    $content_wrapper = get_sub_field('content_wrapper');
    $content = get_sub_field('content');
?>
<?php
    if($content) { ?>
        <div class="container">
            <article class="<?= $content_wrapper ? 'article' : '' ?> mb-m">		
                <?= $content ?>
            </article>
        </div>
<?php } ?>
