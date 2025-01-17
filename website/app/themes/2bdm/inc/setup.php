<?php

/*
 * Set up the 2BDM theme
 */
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

/*
 * Reorganize the 2BDM admin menu
 */
if (!function_exists('theme_remove_admin_menus')) {
    // Removes from admin menu
    function theme_remove_admin_menus(): void {
        remove_menu_page( 'edit-comments.php' );
    }
    add_action( 'admin_menu', 'theme_remove_admin_menus' );
}

if (!function_exists('theme_remove_comment_support')) {
    // Removes from post and pages
    function theme_remove_comment_support(): void {
        remove_post_type_support( 'post', 'comments' );
        remove_post_type_support( 'page', 'comments' );
    }
    add_action('init', 'theme_remove_comment_support', 100);
}

if (!function_exists('theme_admin_bar_render')) {
    // Removes from admin bar
    function theme_admin_bar_render(): void {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
    add_action( 'wp_before_admin_bar_render', 'theme_admin_bar_render' );
}

if (!function_exists('theme_custom_menu_order')) {
    function theme_custom_menu_order( $menu_ord ) : array|bool {
        if ( !$menu_ord )  {
            return true;
        }

        return [
            "index.php",
            "separator1",
            "edit.php?post_type=page",
            "edit.php?post_type=projects",
            "edit.php",
            "upload.php",
            "separator2",
            "themes.php",
            "plugins.php",
            "users.php",
            "tools.php",
            "options-general.php",
            "edit.php?post_type=acf-field-group",
            "separator-last"
        ];
    }
    add_filter( 'custom_menu_order', 'theme_custom_menu_order' );
    add_filter( 'menu_order', 'theme_custom_menu_order' );
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