<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="header-container">
        <div class="header-left">
            <div class="logo">
                <a href="<?= home_url('/'); ?>"><img src="<?= asset('logo_2BDM.png') ?>" alt="2BDM ARCHITECTURE"></a>
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