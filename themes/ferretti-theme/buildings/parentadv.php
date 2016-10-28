<?php $query = new WP_Query(
    array(
        'post_type' => get_post_type(),
        'post__in' => array($parent)
    )
); if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
<section class="row-md">
    <div class="container_single_service row-md-top">
        <div class="frt_img_cover" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></div>
        <div class="container">
            <h2 class="frt_title cover_title">
                <?php echo __('Comprare la tua nuova casa a'); ?><br />
                <strong><?php the_title(); ?></strong> </h2>
            <div class="content_btn_bubble">
                <div class="frt_paragraph">
                    <div class="frt_paragraph_wrapper attributes">
                        <ul class="list frt_columns">
                        <?php while(have_rows('motivazioni')) : the_row(); ?>
                            <li class="hyphen-list cols_50"><?php the_sub_field('motivazione'); ?></li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endwhile; wp_reset_query(); endif; ?>