<?php if(get_field('logo')) : ?>
    <img src="<?php the_field('logo'); ?>" />
<?php endif; ?>
<?php if($parent) : ?>
    <img src="<?php the_field('logo', $parent); ?>" />
<?php endif; ?>