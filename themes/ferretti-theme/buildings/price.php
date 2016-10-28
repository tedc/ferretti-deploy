<?php if(have_rows('prezzo')) : ?>
<?php while(have_rows('prezzo')) : the_row(); ?>
<div class="row">
<span class="price">€ <?php echo number_format(get_sub_field('cifra'), '00', ',', '.'); ?><?php if(get_sub_field('rent')) : ?>/<?php echo __('mese', 'frt'); ?>
<?php endif; ?>
</span>
</div>
<?php endwhile; ?>
<?php endif; ?>