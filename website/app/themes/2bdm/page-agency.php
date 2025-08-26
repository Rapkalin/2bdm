<?php
/**
 * Template Name: Page agence
 *
 * @package WordPress
 */

get_header(args:['color-logo' => '__grey']);

?>
<div class="agency-header-container">
    <h1 class="agency-title"><?= get_field('title') ?></h1>
    <div class="agency-description"><?= get_field('description') ?></div>
</div>

<?php if (have_rows('content_blocks')) :
while (have_rows('content_blocks')) : the_row(); ?>
<section class="content-blocks">
    <?php switch(get_row_layout()) {
        case 'image_full':
            get_template_part("components/block_image_full");
            break;
        case 'details':
            get_template_part("components/block_details");
            break;
        case 'numbers':
            get_template_part("components/block_numbers");
            break;
        case 'quote':
            get_template_part("components/block_quote");
            break;
        case 'infos':
            get_template_part("components/block_infos");
            break;
        case 'team':
            // get_template_part("components/block_team");
            break;
        case 'awards':
            // get_template_part("components/block_rewards");
            break;
        case 'publications':
            // get_template_part("components/block_publications");
            break;
    } ?>
</section>
<?php endwhile;
endif;

get_footer();
?>