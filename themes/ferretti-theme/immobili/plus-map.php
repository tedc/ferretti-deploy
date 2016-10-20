<?php
    $this_post = ($parent) ? $parent : $post->ID;
    $type = 'map_services';
    $plus = get_field($type, $this_post);
    $this_coords = get_field('indirizzo', $this_post);
    $coords = "[{lat : ".$this_coords['lat'].", lng : ".$this_coords['lng']."}]";
    if($plus) : 
    foreach($plus as $p){
        $coord = get_field('posizione', $p);
        $label = get_field('label', $p);
        $desc = get_field('descrizione', $p);
        $coords .= ", [{lat : ".$coord['lat'].", lng : ".$coord['lng'].", desc : ".$desc.", label : ".$label."}]";
    }
    endif; 
?>

<?php 
    $query = new WP_Query(
        array(
            'post_type' => $type,
            'post__in' => $plus,
            'ordery' => 'post__in'
        )
    );
    // START IF                      
    if($query->have_posts()) : ?>
<div ng-map map-data="[<?php echo $coords; ?>]">

    <?php
        // START LOOOP
        while($query->have_posts()) :
        $query->the_post();
                          
    ?>
    
    <?php 
        // END LOOP
        endwhile; ?>
</div>
<?php endif; ?>