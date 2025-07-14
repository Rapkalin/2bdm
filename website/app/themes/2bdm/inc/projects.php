<?php

use JetBrains\PhpStorm\NoReturn;

add_action('init', 'projects_init');
add_action('wp_ajax_load_more_projects', 'load_more_projects');
add_action('wp_ajax_nopriv_load_more_projects', 'load_more_projects');

function projects_init(): void {
    register_post_type(
        'projects',
        [
            'label' => 'Projets',
            'labels' => [
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
            ],
            'public' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-admin-multisite',
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
        '2bdm-projects',
        'projects',
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
                'rewrite' => array('slug' => '2bdm-projects'),
            ],
            'hierarchical' => true,
        ]
    );
    register_taxonomy_for_object_type('2bdm-projects', 'projects');
}

/**
 * Ajax call to display more projects
 * @return void
 */
#[NoReturn] function load_more_projects(): void {
    $paged = (int) $_POST['paged'];
    $query = new WP_Query(array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => $paged
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()): $query->the_post();
            if (have_rows('header_banner')) : the_row(); ?>
                <div class="next-project-wrapper">
                    <?php
                    $project_banner = get_field('header_banner', $post->ID);

                    get_template_part("components/block_project", args: [
                        'project' => $post,
                        'project_banner' => $project_banner,
                        'srcset' => wp_get_attachment_image_srcset( $project_banner['image']['ID']),
                    ]);
                    ?>
                </div>
            <?php endif;
        endwhile;
    endif;

    wp_reset_query();
    die();
}


