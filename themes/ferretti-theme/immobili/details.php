<?php $icons = get_field('plus_con_icona');
    $query = new WP_Query(
        array(
            'post_type' => 'plus',
            'post__in' => $icons,
            'ordery' => 'post__in'
        )
    );
    // START IF                      
    if($query->have_posts()) : ?>

 <?php
        // START LOOOP
        while($query->have_posts()) :
        $query->the_post();
                          
    ?>
    
    <?php 
        // END LOOP
        endwhile; ?>
<?php endif; ?>