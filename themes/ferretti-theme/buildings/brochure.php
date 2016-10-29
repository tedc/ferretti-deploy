<?php if(get_field('brochure') != '') : ?>
<a href="<?php the_field('brochure'); ?>" class="frt_btn download" target="_blank">
    <span class="btn_wrapper">
        <span class="label_button"><?php echo __('Scarica la brochure', 'frt'); ?></span>
    </span>
</a>
<?php endif; ?>