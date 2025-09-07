<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= get_bloginfo('description') ?>">
    <meta name="keywords" content="2BDM ARCHITECTURE, 2BDM, ARCHITECTURE, studio d'architectes, studio, studio d'artchitecture">
    <meta name="author" content="Rapkalin">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="header-container">
        <div class="reduced-navigation">
            <div id="header-logo">
                <a href="<?= home_url('/'); ?>">
                    <span class="dynamic-logo<?= $args['color-logo'] ?? '' ?>"><?php get_template_part("components/logo-white"); ?></span>
                </a>
            </div>
            <nav id="navigation">
                <?php $menuItems = build_menu(); ?>
                <div class="menu-content">
                    <?php foreach ($menuItems as $index => $menuItem): ?>
                        <div class="menu-item<?= $menuItem['children'] ? ' has-children' : '' ?>" data-menu-index="<?= $index ?>">
                            <?php if($menuItem['children']): ?>
                                <div class="menu-item-title"><?= $menuItem['title'] ?></div>
                            <?php else: ?>
                                <a class="menu-item-link" href="<?= $menuItem['url'] ?>"><?= $menuItem['title'] ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </nav>
        </div>
        <nav class="expanded-navigation">
            <div class="side">
                <span><?php get_template_part('components/svg-bullet') ?></span>
                <div class="site-title"><?= $menuItem['title'] ?></div>
            </div>
            <div class="expanded-menu-container">
                <?php foreach ($menuItems as $index => $menuItem): ?>
                    <?php if($menuItem['children']): ?>
                        <div class="expanded-menu-section" data-menu-index="<?= $index ?>">
                            <?php foreach ($menuItem['children'] as $label => $child): ?>
                                <div class="subtitle"><?= $label ?></div>
                                <?php if ($child && is_array($child)): ?>
                                    <div class="tags-container">
                                        <?php foreach ($child as $tag): ?>
                                            <a class="child-item" href="<?= $menuItem['url'] . '?filter=' . $tag->slug ?>">
                                                <?= $tag->name ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </nav>
    </div>
<div class="container">
