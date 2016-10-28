<?php if(have_rows('gallery')) : ?>
    <?php while(have_rows('gallery')) : the_row(); $images = get_sub_field('fotografie'); ?>
    <div class="frt_wip">
        <div class="corner frt_corner_content"></div>
        <h2 class="frt_title_wip"><?php echo __('Lavori', 'frt'); ?></h2>
        <?php if($images) : ?>
        <ul class="frt_wip_list">
            <?php foreach($images as $img) : ?>
                <li class="frt_wip_list_item" style="background-image: url(<?php echo $img['url']; ?>)">
<!--                    <img class="img-hidden" alt="<?php echo $img['alt']; ?>" src="<?php echo $img['url']; ?>" />-->
                    <div class="container_quote">
                        <?php echo $img['caption']; ?>
                        <?php echo $img['description']; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
<?php endif; ?>