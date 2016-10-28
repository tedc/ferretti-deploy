<div class="carousel" ng-carousel>
    <?php $images = get_field('header_gallery'); ?>
    <nav class="carousel-nav">
        <span class="arrow-prev arrow" ng-click="dir(false, pos, <?php echo count($images) - 1; ?>)" ng-class="{inactive : pos == 0}">
            <span class="arrow-line"></span>
        </span>
        <span class="arrow-next arrow" ng-click="dir(true, pos, <?php echo count($images) - 1; ?>)" ng-class="{inactive : pos == <?php echo count($images) - 1; ?>}">
            <span class="arrow-line"></span>
        </span>
    </nav>
    <?php foreach($images as $img) : ?>
    <div class="carousel-item" style="background-image:url(<?php echo $img['url']; ?>)">
    </div>
    <?php endforeach; ?>
    
</div>