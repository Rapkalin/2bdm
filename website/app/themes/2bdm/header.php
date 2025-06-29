<!DOCTYPE html >
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= get_bloginfo('description') ?>">
    <meta name="keywords" content="2BDM ARCHITECTURE, 2BDM, ARCHITECTURE, studio d'architectes, studio, studio d'artchitecture">
    <meta name="author" content="Rapkalin">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="header-main">
        <div id="header-container">
            <div id="header-logo">
                <?php $imageData = getimagesize(get_template_directory() . '/assets/images/' . '2BDM_white.webp'); ?>
                <a href="<?= home_url('/'); ?>">
                    <img
                        src="<?= asset('logo-white.svg') ?>"
                        alt="2BDM ARCHITECTURE LOGO"
                        width="<?= $imageData[0] ?>"
                        height="<?= $imageData[1] ?>"
                    >
                </a>
            </div>
            <nav id="navigation">
                <ul class="menu-content">
                    <?php wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'menu_id' => 'header-menu',
                        'items_wrap' => '%3$s',
                        'container' => false
                    ]); ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">

    <?php if (!$_COOKIE["intro"]): ?>
        <div class="intro-container" id="intro-start">
            <?php get_template_part("components/svg-intro"); ?>
        </div>
        <div class="intro-container" id="intro-mask">
            <?php get_template_part("components/svg-intro-mask"); ?>
        </div>
    <?php endif; ?>