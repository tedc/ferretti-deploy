<?php use Roots\Sage\Titles; ?>
<header class="header">
<?php if(is_front_page()) : ?>
<?php $images = get_field('header_gallery'); 
    if($images) : ?>
<ul class="header-grid">
    <?php foreach($images as $img) : ?>
    <li class="grid-item" style="background-image: url(<?php echo $img['url']; ?>)">
        
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; endif; ?>
</header>