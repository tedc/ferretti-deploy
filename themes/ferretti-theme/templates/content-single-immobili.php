<?php
    $parent = $post->post_parent;
    $kind = get_field('tipologia');
 ?>
<?php while(have_posts()) : the_post(); ?>

<header>
    
</header>
<section <?php post_class(); ?>>
    <div class="frt_columns">
        <div class="cols_40">
            <?php include( locate_template(get_post_type() . '/logo.php', false, false) ); ?>
            <?php get_template_part(get_post_type() . '/price'); ?>
            <?php get_template_part(get_post_type() . '/items'); ?>
            <?php get_template_part(get_post_type() . '/year'); ?>
        </div>
        <div class="col_60">
            <h1><?php the_title(); ?></h1>
            <?php echo get_field('indirizzo')['address']; ?>
            <?php the_content(); ?>
        </div>
    </div>
    <?php include( locate_template(get_post_type() . '/plus-map.php', false, false) ); ?>
    <?php get_template_part(get_post_type() . '/icons'); ?>
    <?php get_template_part(get_post_type() . '/details'); ?>
    <?php 
        $gallery = ($kind < 1) : '-wip' ? '';
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
    <h4><?php echo __('Le soluzioni di', 'frt'); ?> <?php the_title(); ?></h4>
    <ul class="frt_columns" ng-compare-homes>
        <?php while($children->have_posts()) : $children->the_post(); ?>
        <li <?php post_class('cols_33'); ?>>
            <div>
                <figure>
                    <?php the_post_thumbnail(); ?>
                    <a href="#" ng-click="compare(<?php echo get_the_ID(); ?>)">
                        <span class="label_button"><?php echo __('Compara', 'frt'); ?></span>
                    </a>
                </figure>
                <h2><?php the_title(); ?></h2>
                <?php echo get_field('indirizzo')['address']; ?>
                <?php get_template_part(get_post_type() . '/price'); ?>
                <?php get_template_part(get_post_type() . '/items'); ?>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
    <nav class="container_btn container_btn_center">
        <span class="dashed_line"></span>
        <a href="#" ng-click="compare(<?php echo get_the_ID(); ?>)">
            <span class="label_button"><?php echo __('Compara', 'frt'); ?></span>
        </a>
    </nav>
    <?php endif; endif; ?>
    <?php if($kind == 1) : ?>
    
    <?php endif; ?>
    <?php if($kind == 2) : ?>
    
    <?php endif; ?>
</section>
<?php endwhile; ?>