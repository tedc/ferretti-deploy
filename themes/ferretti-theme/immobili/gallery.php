<?php if(have_rows('gallery')) : ?>
    <?php while(have_rows('gallery')) : the_row(); $images = get_sub_field('fotografie'); ?>
    <div class="frt_columns">
        <div class="cols_60" style="background-image:url(<?php echo $images[0]; ?>)">
           <img src="<?php echo $images[0]; ?>" />
        </div>
        <?php if(have_rows('consigli')) : ?>
        <h3><?php echo __('Una casa consigliata per', 'frt'); ?></h3>
        <?php while(have_rows('consigli')) : the_row(); ?>
        <?php the_sub_field('consiglio'); ?>
        <?php endwhile; ?>
        
        <?php endif; ?>
    </div>
    <div class="frt_columns">
        <div class="cols_40">
            <span class="dashed_line dashed_line_in_col"></span>
            <a href="#" ng-click="isGallery = true; isHomePopup = true" class="frt_btn">
                <span class="label_button"><?php echo __('Guarda la gallery', 'frt'); ?></span>
            </a>
        </div>
        <div class="cols_60" style="background-image:url(<?php echo $images[0]; ?>)">
           <img src="<?php echo $images[0]; ?>" />
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>