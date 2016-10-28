<header class="banner">
    <div class="container">
        <nav class="nav-brand">
        <a class="brand" href="<?= esc_url(home_url('/')); ?>"><i class="frt_icon-logo"></i><span class="site-name"><?php bloginfo('name'); ?></span></a>
        <?php if ( function_exists('yoast_breadcrumb') && !is_home() ) {
            yoast_breadcrumb('<p class="breadcrumbs">','</p>');
        } ?></nav>

        <nav class="nav-primary">
            <?php
            if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
            <a href="#" class="frt_search_btn frt_nav_btn" title="<?php echo __('Cerca', 'frt'); ?>">
                <i class="frt_icon frt_icon-search"></i>
            </a>
            <a href="#" class="frt_contact_btn frt_nav_btn" title="<?php echo __('Contatti', 'frt'); ?>">
                <i class="frt_icon frt_icon-contact"></i>
            </a>
            <a href="#" class="frt_menu_btn frt_nav_btn" title="<?php echo __('Menu', 'frt'); ?>">
                <i class="frt_icon frt_icon-menu"></i>
            </a>
        </nav>
    </div>
</header>