<?php

if (!function_exists('theme_2bdm_setup')) {
    function theme_2bdm_setup(): void {
        add_theme_support('title-tag');
        add_filter('use_block_editor_for_post', '__return_false');
        show_admin_bar(false);

    }
    add_action('after_setup_theme', 'theme_2bdm_setup');
}

if (!function_exists('theme_2bdm_title_separator')) {
    function theme_2bdm_title_separator(): string {
        return '|';
    }
    add_action('document_title_separator', 'theme_2bdm_title_separator');
}

/**
 * 2BDM functions and definitions

if (!function_exists('theme_2bdm_setup')) {
    function theme_2bdm_setup(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('post-formats',
            [
                'aside',
                'chat',
                'gallery',
                'image',
                'link',
                'quote',
                'status',
                'video',
                'audio'
            ]
        );
        add_theme_support('editor-color-palette',
            [
                ['name' => 'Rose', 'slug'  => 'pink', 'color' => '#ff8da8'],
                ['name' => 'Noir', 'slug'  => 'dark-text', 'color' => '#5f5e5e']
            ]
        );

        register_nav_menus([
            'header-menu' => esc_html__('Header Menu', 'pdesign'),
            'products-menu' => esc_html__('Products Menu', 'pdesign'),
            'footer-menu' => esc_html__('Footer Menu', 'pdesign'),
            'footer-products-menu' => esc_html__('Footer Products Menu', 'pdesign'),
        ]);
    }
    add_action('after_setup_theme', 'theme_2bdm_setup');
}
*/

/**
 * Enqueue scripts and styles.

if (!function_exists('theme_2bdm_scripts')) {
    function theme_2bdm_scripts(): void
    {
        wp_enqueue_style('2bdm', get_stylesheet_uri());
        wp_dequeue_style('wp-block-library');
        wp_deregister_script('wp-embed');
        wp_deregister_script('jquery');
        wp_enqueue_script('main-js', get_template_directory_uri() .  '/assets/app.js', array(), '1.0', true);
    }
    add_action('wp_enqueue_scripts', 'theme_2bdm_scripts');
}
 * */

