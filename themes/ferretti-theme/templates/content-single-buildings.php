<?php
    $parent = $post->post_parent;
    $kind = get_field('tipologia');
 ?>
<?php while(have_posts()) : the_post(); ?>

<?php get_template_part('templates/' . get_post_type() . '-header'); ?>
<section <?php post_class(); ?>>
    <div class="frt_columns row-md container">
        <div class="cols_40 corner cols_meta">
            <?php include( locate_template(get_post_type() . '/logo.php', false, false) ); ?>
            <?php get_template_part(get_post_type() . '/price'); ?>
            <?php get_template_part(get_post_type() . '/items'); ?>
            <?php get_template_part(get_post_type() . '/dotations'); ?>
            <?php get_template_part(get_post_type() . '/year'); ?>
        </div>
        <div class="cols_60 offset-left">
            <div class="frt_paragraph_content">
            <h1 class="frt_title"><strong><?php the_title(); ?></strong></h1>
            <?php $post_content = true; include( locate_template(get_post_type() . '/address.php', false, false) ); $post_content = false; ?>
            <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php include( locate_template(get_post_type() . '/plus-map.php', false, false) ); ?>
    <?php if(get_field('plus_con_icona') || get_field('plus_descrittivi')) : ?>
    <section class="container row-md">
        <div class="corner frt_corner_content">
            <?php get_template_part(get_post_type() . '/icons'); ?>
            <?php get_template_part(get_post_type() . '/details'); ?>
         </div>
    </section>
    <?php endif; ?>
    <?php 
        $gallery = (get_field('is_wip')) ? '-wip' : '';
        get_template_part(get_post_type() . '/gallery'.$gallery); ?>
    <?php if($kind < 1) : ?>
    <?php 
        $children = new WP_Query(
            array(
                'post_type' => get_post_type(),
                'post_parent' => $post->ID
            )
        );
        if($children->have_posts()) : ?>
        <header class="header-section container row-md">
            <h4 class="frt_title"><?php echo __('Le soluzioni di', 'frt'); ?> <strong><?php the_title(); ?></strong></h4>
        </header>
        <nav class="container_button container_button_center">
            <span class="dashed_line"></span>
            <?php $terms = get_terms(array('taxonomy' => 'tipologie', 'orderby' =>'name')); 
                foreach($terms as $term) :
                echo '<a href="#" ng-click="$event.preventDefault()" class="frt_btn"><span class="btn_wrapper"><span class="label_button">'.$term->name.'</span></span></a>';
                endforeach; ?>
        </nav>
    <section class="row-md">
        <ul class="frt_columns property_list row-md container" ng-compare-homes>
            <?php while($children->have_posts()) : $children->the_post(); ?>
            <?php get_template_part('templates/content', get_post_type()); ?>
            <?php endwhile; wp_reset_query(); ?>
        </ul>
        <nav class="container_button container_button_center">
            <span class="dashed_line"></span>
            <a href="#" ng-click="compare(<?php echo get_the_ID(); ?>)" class="frt_btn">
                <span class="btn_wrapper">
                    <span class="label_button"><?php echo __('Altro', 'frt'); ?></span>
                </span>
            </a>
        </nav>
    </section>
    <?php endif; endif; ?>
    <?php if($kind == 1) : ?>
    <?php if($parent) :
       include( locate_template(get_post_type() . '/parentadv.php', false, false) );
    endif; ?>
    <?php get_template_part(get_post_type() . '/appuntamento'); ?>  
    <?php get_template_part(get_post_type() . '/related'); ?>
    <?php endif; ?>
    <?php if($kind == 2) : ?>
    
    <?php endif; ?>
</section>
<?php endwhile; ?>