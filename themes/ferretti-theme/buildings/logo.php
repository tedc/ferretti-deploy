<?php if(get_field('logo') != '') : ?>
    <figure class="image_wrapper">
        <img src="<?php the_field('logo'); ?>" />
    </figure>
<?php endif; ?>
<?php if($parent && get_field('logo', $parent) != '') : ?>
    <figure class="image_wrapper parent_logo">
    <img src="<?php the_field('logo', $parent); ?>" />
    </figure>
<?php endif; ?>