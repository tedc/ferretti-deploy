<?php if(get_field('planimetria') != '') : ?>
<a href="#" class="frt_btn download" ng-click="$event.preventDefault();isPlant=true;isHousePopup=true">
    <span class="btn_wrapper">
        <span class="label_button"><?php echo __('Guarda la planimetria', 'frt'); ?></span>
    </span>
</a>
<?php endif; ?>