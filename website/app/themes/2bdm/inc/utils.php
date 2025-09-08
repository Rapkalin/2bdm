<?php

/**
* Return images folder path
*/
function asset($path): string
{
    return get_template_directory_uri() . '/assets/images/' . $path;
}

function get_terms_hierarchy(string $taxonomy): array
{
    $parent_terms = get_terms([
        'taxonomy' => $taxonomy,
        'parent' => 0,
    ]);

    $terms = [];
    foreach ($parent_terms as $parent_term) {
        $terms[$parent_term->name] = get_terms([
            'taxonomy' => $taxonomy,
            'child_of' => $parent_term->term_id,
        ]);
    }

    return $terms;
}

function build_menu(): array
{
    $menu = [];
    $items = wp_get_nav_menu_items('header-menu', [
        'theme_location' => 'header-menu',
        'menu_id' => 'header-menu',
    ]);

    foreach ($items as $item) {
        $menuItem = [
            'title' => $item->title,
            'url' => $item->url,
            'children' => []
        ];

        if ($item->object === 'page') {
            get_item_menu_children($item, $menuItem);
        }

        /*
         * If a menu entry has a parent then we bind it to its parent with type = pages
         * menu entry
         *  -> child one
         *  -> child two
         */
        if((int) $item->menu_item_parent && isset($menu[$item->menu_item_parent])) {
            $menu[$item->menu_item_parent]['children'][$menuItem['title']] = $menuItem;
            $menu[$item->menu_item_parent]['type'] = 'pages';
        } else {
            $menu[$item->ID] = $menuItem;
        }
    }

    return $menu;
}

function get_item_menu_children(WP_Post $item, array &$menuItem): void
{
    switch (get_page_template_slug((int) $item->object_id)):
        case 'page-articles.php':
            $menuItem['children'] = get_terms_hierarchy('2bdm-articles');
            $menuItem['type'] = 'links';
            break;
        case 'page-projects.php':
            $menuItem['children'] = get_terms_hierarchy('2bdm-projects');
            $menuItem['type'] = 'tags';
            break;
        case 'page-agency.php':
            $menuItem['children'] = get_page_block_ids((int) $item->object_id);
            $menuItem['type'] = 'anchors';
            break;
    endswitch;
}

function get_page_block_ids(int $pageId): array
{
    $block_ids = [];
    $fields = get_fields($pageId);

    foreach ($fields['content_blocks'] as $block) {
        if (
            $block['block_id']['label'] &&
            $block['block_id']['identifier']
        ) {
            $block_ids[$block['block_id']['label']] = $block['block_id']['identifier'];
        }
    }

    return $block_ids;
}