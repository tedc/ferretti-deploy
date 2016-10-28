<?php while(have_rows('related')) : the_row(); ?>
<section class="container row-md">
    <header class="header-section">
        <h3 class="frt_title">
            <?php echo strip_tags(get_sub_field('titolo'), '<strong><br>'); ?>
        </h3>
    </header>
    <?php if(get_sub_field('immobili')) : 
        $related = new WP_Query(
            array(
                'post_type' => get_post_type(),
                'post__in' => get_sub_field('immobili')
            )
        );
        if($related->have_posts()) :
    ?>
    <ul class="frt_columns property_list row-md">     
        <?php while($related->have_posts()) : $related->the_post(); ?>
        <?php get_template_part('templates/content', get_post_type()); ?>
        <?php endwhile; wp_reset_query(); ?>
    </ul>
    <?php endif; endif; ?>
</section>
<?php endwhile; ?>