<?php if(have_rows('prezzo')) : ?>
<?php while(have_rows('prezzo')) : the_row(); ?>
€ <?php echo get_sub_field('cifra'); ?>
<?php if(get_sub_field('rent')) : ?>
/ <?php echo __('mese', 'frt'); ?>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>