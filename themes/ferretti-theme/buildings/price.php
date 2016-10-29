<?php $nav = isset($nav) ? $nav : false; ?>
<?php if(have_rows('prezzo')) : ?>
<?php while(have_rows('prezzo')) : the_row(); ?>
<?php if(!$nav) : ?>
<div class="row">
<?php endif; ?>
<span class="price">€ <?php echo number_format(get_sub_field('cifra'), '00', ',', '.'); ?><?php if(get_sub_field('rent')) : ?>/<?php echo __('mese', 'frt'); ?>
<?php endif; ?>
</span>
<?php if(!$nav) : ?>
</div>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>