<?php

add_action('init', 'articles_init');

function articles_init(): void {
    register_post_type(
        'articles',
        [
            'label' => 'Articles',
            'labels' => [
                'name' => 'Articles',
                'singular_name' => 'Article',
                'all_items' => 'Tous les articles',
                'add_new_item' => 'Ajouter un article',
                'edit_item' => 'Éditer le article',
                'new_item' => 'Nouveeau article',
                'view_item' => 'Voir le article',
                'search_items' => 'Rechercher parmi les articles',
                'not_found' => 'Aucun article trouvé',
                'not_found_in_trash'=> 'Aucun article dans la corbeille'
            ],
            'public' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-admin-comments',
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'supports' => [
                'excerpt',
                'page-attributes',
                'title',
                'editor',
                'thumbnail'
            ]
            ,
            'has_archive' => true,
        ]
    );

    register_taxonomy(
        '2bdm-articles',
        'articles',
        [
            'label' => 'Catégories',
            'labels' => [
                'name' => 'Catégories',
                'singular_name' => 'Catégorie',
                'all_items' => 'Toutes les catégories',
                'edit_item' => 'Éditer la catégorie',
                'view_item' => 'Voir la catégorie',
                'update_item' => 'Mettre à jour la catégorie',
                'add_new_item' => 'Ajouter une catégorie',
                'new_item_name' => 'Nouvelle catégorie',
                'search_items' => 'Rechercher parmi les catégories',
                'popular_items' => 'Catégories les plus utilisées',
                'rewrite' => array('slug' => '2bdm-articles'),
            ],
            'hierarchical' => true,
        ]
    );
    register_taxonomy_for_object_type('2bdm-articles', 'articles');
}

add_action('wp_ajax_load_more_or_filtered_articles', 'load_more_or_filtered_articles');
add_action('wp_ajax_nopriv_load_more_or_filtered_articles', 'load_more_or_filtered_articles');

function load_more_or_filtered_articles() {
    $paged = $_POST['paged'];
    $term = isset($_POST['terms']) ? $_POST['terms'] : 'all';

    $tax_query = [];

    if ($term !== 'all') {
        $tax_query = [
            [
                'taxonomy' => '2bdm-articles',
                'field' => 'term_id',
                'terms' => intval($term),
            ]
        ];
    }

    $query = new WP_Query([
        'post_type' => 'articles',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => $paged,
        'tax_query' => $tax_query
    ]);

    $articles_html = '';

    while ($query->have_posts()) : $query->the_post();
        ob_start();
        get_template_part("components/block_article", null, ['article' => get_post()]);
        $articles_html .= ob_get_clean();
    endwhile;

    $remaining_articles = $query->found_posts - ($paged * 4);

    wp_send_json_success([
        'articles_html' => $articles_html,
        'remaining_articles' => $remaining_articles
    ]);

    wp_die();
}