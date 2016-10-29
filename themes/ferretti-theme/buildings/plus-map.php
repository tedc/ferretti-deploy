<?php
    $this_post = ($parent) ? $parent : $post->ID;
    $type = 'map_services';
    $plus = get_field($type, $this_post);
    if($plus) : 
    $this_coords = get_field('indirizzo', $this_post);
    $coords = "{lat : ".$this_coords['lat'].", lng : ".$this_coords['lng'].", address : '".$this_coords['address']."'}";
    foreach($plus as $p){
        $coord = get_field('posizione', $p);
        $label = get_field('label', $p);
        $desc = get_field('descrizione', $p);
        $coords .= ", {lat : ".$coord['lat'].", lng : ".$coord['lng'].", address : '".$coord['address']."', desc : '".$desc."', label : '".$label."'}";
    }
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
<section class="row-md map-section" id="map-service">
<?php get_template_part(get_post_type() . '/plant'); ?>
<?php get_template_part(get_post_type() . '/brochure'); ?>
<div class="map_service" ng-map map-data="[<?php echo $coords; ?>]" map-id="map">
    <div class="map" id="map"></div>
    <div class="map_service_cols">
        <h2 class="frt_title map_service_title"><?php echo __('I servizi della zona', 'frt'); ?></h2>
        <ul class="map_service_list">
    <?php
        // START LOOOP
        while($query->have_posts()) :
        $query->the_post();
                          
    ?>
        <li class="map_service_item">
            <a href="#" ng-click="$event.preventDefault(); direction('<?php echo get_field('posizione')['address']; ?>', '<?php echo $this_coords['address']; ?>')">
                <?php the_field('label'); ?>
            </a> 
            <p class="map_service_desc"><?php the_field('descrizione'); ?></p>
        </li>
    <?php 
        // END LOOP
        endwhile; wp_reset_query(); ?>
        </ul>
    </div>
</div>
</section>
<?php endif; 
    endif; ?>