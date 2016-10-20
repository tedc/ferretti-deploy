<header class="banner">
    <div class="container">
        <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <nav class="nav-primary">
            <?php
            if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
            <a href="#" class="frt_search_btn frt_menu_btn">
                <?php echo __('Cerca', 'frt'); ?>
                <i class="frt_icon frt_icon-search"></i>
            </a>
            <a href="#" class="frt_contact_btn frt_menu_btn">
                <?php echo __('Contatti', 'frt'); ?>
                <i class="frt_icon frt_icon-contact"></i>
            </a>
            <a href="#" class="frt_menu_btn frt_menu_btn">
                <?php echo __('Menu', 'frt'); ?>
                <i class="frt_icon frt_icon-menu"></i>
            </a>
        </nav>
    </div>
</header>