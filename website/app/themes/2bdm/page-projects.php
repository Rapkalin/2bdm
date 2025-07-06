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

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <a href="<?= get_permalink(get_the_ID()) ?>"><?= the_title() ?></a><br>
    <?php endwhile;
endif;

get_footer();
?>