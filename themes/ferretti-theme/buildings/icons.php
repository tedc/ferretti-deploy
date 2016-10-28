<?php $icons = get_field('plus_con_icona');
    if($icons) :
    $query = new WP_Query(
        array(
            'post_type' => 'plus_icon',
            'post__in' => $icons,
            'ordery' => 'post__in'
        )
    );
    // START IF                      
    if($query->have_posts()) : ?>
    <ul class="frt_columns frt_features">
        
 <?php
        // START LOOOP
        while($query->have_posts()) :
        $query->the_post();
                          
    ?>
    <li class="cols_33">
        <?php echo wp_get_attachment_image(get_field('icon')['id'], array(48,48, true), false, array('class' => 'img_features')); ?>
        <p class="label_features"><?php the_title(); ?></p>
    </li>
    <?php 
        // END LOOP
        endwhile; wp_reset_query(); ?>
    
    </ul>
<?php endif; endif;?>