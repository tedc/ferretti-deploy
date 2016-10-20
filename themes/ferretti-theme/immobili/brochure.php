<?php if(get_field('brochure') != '') : ?>
<a href="<?php the_field('brochure'); ?>"><?php echo __('Scarica la brochure', 'frt'); ?></a>
<?php endif; ?>