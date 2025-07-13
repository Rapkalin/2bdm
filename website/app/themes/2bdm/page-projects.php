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

// get all projects
$query = new WP_Query(array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => -1
));

while ($query->have_posts()): $query->the_post();
    if (have_rows('header_banner')) : the_row(); ?>
        <div class="next-project-wrapper main-wrapper">
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
wp_reset_query();

get_footer();
?>