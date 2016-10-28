<h2 class="frt_title blue text_center text_center">
    <strong><?php echo __('Ci interessa solo un\'opinione:<mark>la vostra</mark>', 'frt'); ?></strong>
</h2>
<ng-fb-reviews></ng-fb-reviews>
<nav class="container_button container_button_center">
    <div class="dashed_line"></div>
    <a href="<?php echo get_option('social_settings')['facebook']; ?>" target="_blank" class="frt_btn">
        <span class="btn_wrapper">
            <i class="frt_icon-facebook icon_button"></i>
            <span class="label_button">
                <?php echo __('Seguici su facebook', 'frt'); ?>
            </span>
        </span>
    </a>
</nav>