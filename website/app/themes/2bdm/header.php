<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="<?= get_bloginfo('description') ?>">
    <meta name="keywords" content="2BDM ARCHITECTURE, 2BDM, ARCHITECTURE, studio d'architectes, studio, studio d'artchitecture">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="header-container">
        <div class="header-left">
            <div class="logo">
                <?php $imageData = getimagesize(get_template_directory() . '/assets/images/' . 'logo_2BDM.webp'); ?>
                <a href="<?= home_url('/'); ?>">
                    <img
                        src="<?= asset('logo_2BDM.webp') ?>"
                        alt="2BDM ARCHITECTURE"
                        width="<?= $imageData[0] ?>"
                        height="<?= $imageData[1] ?>"
                    >
                </a>
            </div>
            <nav class="navigation">
                <div class="menu">
                    <ul class="menu-content">
                        <?php wp_nav_menu([
                            'theme_location' => 'header-menu',
                            'menu_id' => 'header-menu',
                            'items_wrap' => '%3$s',
                            'container' => false
                        ]); ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">