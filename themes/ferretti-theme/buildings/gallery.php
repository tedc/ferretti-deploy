<?php if(have_rows('gallery')) : ?>
<div class="container row-md">
    <?php while(have_rows('gallery')) : the_row(); $images = get_sub_field('fotografie'); ?>
    <div class="frt_columns frt_gallery first_gallery">
        <div class="cols_60" style="background-image:url(<?php echo $images[0]['url']; ?>)">
            <figure class="frt_img flip">
                <div class="frt_img_wrapper">
                    <img src="<?php echo $images[0]['url']; ?>" />
                </div>
            </figure>
        </div>
        <?php if(have_rows('consigli')) : ?>
        <div class="cols_40">
            <div class="frt_paragraph">
                <div class="frt_paragraph_wrapper">
                    <h3 class="frt_title frt_title_small"><strong><?php echo __('Una casa consigliata per', 'frt'); ?></strong></h3>
                    <?php if(have_rows('consigli')) : ?>
                    <ul class="list row-top">
                    <?php while(have_rows('consigli')) : the_row(); ?>
                        <li class="hyphen-list">
                            <?php the_sub_field('consiglio'); ?>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="frt_columns frt_gallery">
        <div class="cols_40 offset-right">
            <nav class="container_button">
                <span class="dashed_line"></span>
                <a href="#" ng-click="isGallery = true; isHomePopup = true" class="frt_btn">
                    <span class="btn_wrapper">
                        <span class="label_button"><?php echo __('Guarda la gallery', 'frt'); ?></span>
                    </span>
                </a>
            </nav>
        </div>
        <div class="cols_60" style="background-image:url(<?php echo $images[0]['url']; ?>)">
            <div class="second_gallery">
               <figure class="frt_img flip">
                    <div class="frt_img_wrapper">
                        <img src="<?php echo $images[0]['url']; ?>" />
                    </div>
                </figure>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</div>
<?php endif; ?>