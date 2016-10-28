<?php $compare = isset($parent) ? true : false; ?>
<li <?php post_class('cols_33'); ?>>
    <figure class="image_wrapper">
        <?php the_post_thumbnail(); ?>
        <?php if(!$compare) : ?>
        <a class="frt_btn" href="<?php the_permalink(); ?>">
            <span class="btn_wrapper">
                <span class="label_button"><?php echo __('Guarda', 'frt'); ?></span>
            </span>
        </a>
        <?php else :  ?>
        <a class="frt_btn" href="<?php the_permalink(); ?>">
            <span class="btn_wrapper">
                <span class="label_button"><?php echo __('Compare', 'frt'); ?></span>
            </span>
        </a>
        <?php endif; ?>
    </figure>
    <div class="frt_paragraph">
        <div class="frt_paragraph_wrapper">
            <div class="info">
                <h2 class="title_schedule">
                    <?php the_title(); ?>
                </h2>
                <?php if(get_field('indirizzo')) : ?>
                <?php get_template_part(get_post_type() . '/address'); ?>
                <?php endif; ?>
                <?php get_template_part(get_post_type() . '/price'); ?>
                <?php get_template_part(get_post_type() . '/items'); ?>
            </div>
        </div>
    </div>
</li>