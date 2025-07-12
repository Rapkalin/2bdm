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
            $image = get_sub_field('image');
            $srcset = wp_get_attachment_image_srcset( $image['ID']);
            ?>
            <div class="next-project-container">
                <a href="<?php  the_permalink(); ?>">
                    <h2><?= the_title() ?></h2>
                    <ul>
                        <li><?= get_the_excerpt() ?></li>
                    </ul>
                    <div class="next-project-img">
                        <img
                                src="<?= $image['url']; ?>"
                                srcset="<?php echo esc_attr( $srcset ); ?>"
                                alt="<?= $image['image']['title']; ?>"
                                height="<?= $image['height']; ?>"
                                width="<?= $image['width']; ?>"
                        >
                        <div class="next-project-button">
                            <button class="classic-button">
                                Voir le projet
                                <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif;
endwhile;
wp_reset_query();

get_footer();
?>