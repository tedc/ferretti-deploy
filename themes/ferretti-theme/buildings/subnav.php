<nav class="subnav">
    <div class="container">
        <ul class="anchors" ng-anchors>
            <li class="anchor" ng-click="goToAnchor('#info')"><?php echo __('Informazioni', 'frt'); ?></li>
            <li class="anchor" ng-click="goToAnchor('#map')"><?php echo __('Servizi', 'frt'); ?></li>
            <li class="anchor" ng-click="goToAnchor('#plus')"><?php echo __('Plus', 'frt'); ?></li>
            <li class="anchor" ng-click="goToAnchor('#gallery')"><?php echo __('Gallery', 'frt'); ?></li>
            <li class="anchor" ng-click="goToAnchor('#appointment')"><?php echo __('Fissa un appuntamento', 'frt'); ?></li>
        </ul>
        <div class="offset-left">
            
            <?php $nav = true; include( locate_template(get_post_type() . '/price.php', false, false) ); $nav = false; ?>
            <?php if(get_field('planimetria') != '') : ?>
            <a href="#" ng-click="$event.preventDefault();isPlant=true;isHousePopup=true">
                <?php echo __('Planimetria', 'frt'); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</nav>