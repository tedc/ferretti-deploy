<header class="header">
    <?php if(get_field(get_field('header_kind'))) : ?>
    <?php get_template_part(get_post_type() . '/' . get_field('header_kind')); ?>
    <?php else : ?>
    <?php the_post_thumbnail('full'); ?>
    <?php endif; ?>
</header>