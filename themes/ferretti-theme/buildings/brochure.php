<?php if(get_field('brochure') != '') : ?>
<a href="<?php the_field('brochure'); ?>" class="frt_btn">
    <span class="btn_wrapper">
            <?php echo __('Scarica la brochure', 'frt'); ?>
    </span>
</a>
<?php endif; ?>