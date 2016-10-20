<?php
    use Roots\Sage\Assets;
    function my_acf_style() {
        wp_register_style( 'my-acf-input-css', Assets\asset_path('css/admin/acf.css'), false, '1.0.0' );
        wp_enqueue_style( 'my-acf-input-css' );
    }

    add_action('acf/input/admin_head', 'my_acf_style');