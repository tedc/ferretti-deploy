<?php if(get_field('indirizzo')) : ?>
<p class="address"><?php if(isset($post_content)): ?><i class="frt_icon-marker"></i><?php endif; ?><?php echo get_field('indirizzo')['address']; ?>
<?php endif; ?>