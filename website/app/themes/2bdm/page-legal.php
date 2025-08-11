<?php
/**
 * Template Name: Page legal
 *
 * @package WordPress
 */

get_header(args:['color-logo' => '__grey']);
?>

<div class="legal-wrapper">
    <h1 class="legal-title"><?= get_the_title() ?></h1>


    <div class="legal-container">
        <?php while (have_rows('content_blocks')) : the_row(); ?>
            <div class="block-legal-container">
                <h2 class="block-legal-title"><?= get_sub_field('title') ?></h2>
                <p class="block-legal-description"><?= get_sub_field('description') ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
wp_reset_query();
get_footer();
?>
