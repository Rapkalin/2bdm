<?php

add_action('init', 'projects_init');

function projects_init(): void {
    register_post_type(
        'projects',
        array(
            'label' => 'Projets',
            'labels' => array(
                'name' => 'Projets',
                'singular_name' => 'Projet',
                'all_items' => 'Tous les projets',
                'add_new_item' => 'Ajouter un projet',
                'edit_item' => 'Éditer le projet',
                'new_item' => 'Nouveeau projet',
                'view_item' => 'Voir le projet',
                'search_items' => 'Rechercher parmi les projets',
                'not_found' => 'Aucun projet trouvé',
                'not_found_in_trash'=> 'Aucun projet dans la corbeille'
            ),
            'public' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-admin-multisite',
            'show_in_rest' => true,
            'supports' => [
                'excerpt',
                'page-attributes',
                'title',
                'editor',
                'thumbnail'
            ]
            ,
            'has_archive' => true,
        )
    );

    register_taxonomy(
        '2bdm-projects',
        'projects',
        array(
            'label' => 'Catégories',
            'labels' => array(
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
                'rewrite' => array('slug' => '2bdm-projects'),
            ),
            'hierarchical' => true,
        )
    );
    register_taxonomy_for_object_type('2bdm-projects', 'projects');
}