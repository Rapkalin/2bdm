<?php
/**
 * Template Name: Grille des projets
 *
 * @package WordPress
 */

get_header();

if (have_rows('header_slider')) :
    get_template_part("components/block_header_slider");
endif;

$terms = get_terms_hierarchy('2bdm-projects');
get_template_part("components/block_filters", args: ['terms' => $terms]);

// Initial query to load only 6 projects
$args = [
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'paged' => 1
];

// Add filter if a term is selected
$filterParam = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';
if (!empty($filterParams)) {
    $args['tax_query'] = [
        'relation' => 'OR', // Utiliser OR pour afficher les projets qui ont AU MOINS UN des termes
    ];

    foreach ($filterParams as $filterSlug) {
        $term = get_term_by('slug', $filterSlug, '2bdm-projects');
        if ($term) {
            $args['tax_query'][] = [
                'taxonomy' => '2bdm-projects',
                'field' => 'term_id',
                'terms' => $term->term_id,
            ];
        }
    }
}

// Get the total number of projects
$query = new WP_Query($args);
$total_projects = $query->found_posts;
?>
<div
    class="projects-container main-wrapper"
    data-url="<?php echo admin_url('admin-ajax.php'); ?>"
>
    <?php
    while ($query->have_posts()): $query->the_post();
        if (have_rows('header_banner')) : the_row(); ?>
            <section class="section-next-next-project-wrapper">
                <?php
                    $project_banner = get_field('header_banner', $post->ID);

                    get_template_part("components/block_project", args: [
                        'project' => $post,
                        'project_banner' => $project_banner,
                        'srcset' => wp_get_attachment_image_srcset( $project_banner['image']['ID']),
                    ]);
                ?>
            </section>
        <?php endif;
    endwhile;
    ?>
</div>

<!-- We display the Button load more projects only if there are more than 6 projects left -->
<?php if ($total_projects > 6) : ?>
    <div class="button-load-more">
        <button
            id="load-more"
            class="classic-button"
            data-projects-left="<?= $total_projects ?>"
            data-page="1"
        >
           Voir plus de projets
           <span class="svg-plus"><?php get_template_part("components/svg-plus"); ?></span>
        </button>
    </div>
<?php endif;

wp_reset_query();
get_footer();
?>