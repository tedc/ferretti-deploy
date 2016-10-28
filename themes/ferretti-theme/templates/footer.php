<ng-instagram></ng-instagram>
<footer class="footer row">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="offset-left">
        <a href="<?php echo get_option('social_settings')['facebook']; ?>" class="icon_button frt_icon-facebook" target="_blank" rel="nofollow"></a>
        <a href="<?php echo get_option('social_settings')['instagram']; ?>" class="icon_button frt_icon-instagram" target="_blank" rel="nofollow"></a><br />
        <em>by</em> <a href="http://www.bspkn.it" class="frt_icon-credits" target="_blank" rel="nofollow"></a>
    </div>
</footer>
<nav class="footer-nav" ng-show="!isFooterNav">
    <div class="container row">
        <div class="offset-right">
        <h6 class="frt_title"><?php echo __('Hai bisogno del nostro supporto?', 'frt'); ?></h6>
        <span class="frt_nav_btn frt_phone_btn">
            <i class="frt_icon-phone"></i>
            <?php echo get_option('address_settings')['phone']; ?>
        </span>
        <a href="#" ng-click="$event.preventDefault(); isContact = true" class="frt_nav_btn frt_contact_btn">
            <i class="frt_icon frt_icon-contact">    
            </i>
            <?php _e('Scrivici', 'frt'); ?>
        </a>
        </div>
        <span class="frt_close frt_nav_btn" ng-click="isFooterNav = true">
            <?php echo __('Chiudi', 'frt'); ?>
        </span>
    </div>
</nav>
