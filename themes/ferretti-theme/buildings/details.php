<?php $plus = get_field('plus_descrittivi');
    if($plus) : 
    $query = new WP_Query(
        array(
            'post_type' => 'plus',
            'post__in' => $plus,
            'ordery' => 'post__in'
        )
    );
    // START IF                      
    if($query->have_posts()) : ?>
<?php if(get_field('plus_con_icona')) : ?>
<div class="dashed_line dashed_line_relative"></div>
<?php endif; ?>
<div class="container_text_features<?php echo (!get_field('plus_con_icona')) ? ' no_icons' : ''; ?>">
 <?php
        // START LOOOP
        while($query->have_posts()) :
        $query->the_post();
                          
    ?>
    <h3 class="frt_title container_text_features_title"><?php the_title(); ?></h3>
    <?php the_content(); ?>
    <?php 
        // END LOOP
        endwhile; wp_reset_query();  ?>
</div>
<?php endif; endif; ?>