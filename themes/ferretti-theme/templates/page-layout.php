<?php while(have_rows('builder')) : the_row(); ?>
    <?php get_template_part('builder/' . get_row_layout()); ?>
<?php endwhile; ?>