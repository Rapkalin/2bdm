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
foreach ($terms as $parent_name => $child_terms) {
    // Utilisez le slug ou un identifiant unique pour l'attribut id
    $parent_slug = sanitize_title($parent_name);
    ?>
    <div class="parent-term">
        <button class="accordion" data-target="#<?= $parent_slug ?>">
            <?= $parent_name ?>
        </button>
        <div id="<?= $parent_slug ?>" class="accordion-content">
            <?php
            foreach ($child_terms as $child_term) : ?>
                <div class="child-term" data-term-id="<?= $child_term->term_id ?>">
                    <?= $child_term->name ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}


// Initial query to load only 4 projects
$query = new WP_Query(array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'paged' => 1
));

// Get the total number of projects
$total_projects = $query->found_posts;
?>
<div class="projects-container main-wrapper">
    <?php
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
    ?>
</div>

<!-- We display the Button load more projects only if there are more than 4 projects left -->
<?php if ($total_projects > 4) : ?>
    <div class="button-load-more">
        <button
            id="load-more"
            class="classic-button"
            data-projects-left="<?= $total_projects ?>"
            data-page="1"
            data-url="<?php echo admin_url('admin-ajax.php'); ?>"
        >
           Voir plus de projets
           <span class="svg-plus"><?php get_template_part("components/svg-plus"); ?></span>
        </button>
    </div>
<?php endif;

wp_reset_query();
get_footer();
?>