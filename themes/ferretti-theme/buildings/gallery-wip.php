<?php if(have_rows('gallery')) : ?>
    <?php while(have_rows('gallery')) : the_row(); $images = get_sub_field('fotografie'); ?>
        <h2><?php echo __('Lavori', 'frt'); ?></h2>
        <?php if($images) : ?>
        <ul>
            <?php foreach($images as $img) : ?>
                <li style="background-image: url(<?php echo $img['url']; ?>)">
                    <img class="img-hidden" alt="<?php echo $img['alt']; ?>" src="<?php echo $img['url']; ?>" />
                    <?php echo $img['caption']; ?>
                    <?php echo $img['description']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>