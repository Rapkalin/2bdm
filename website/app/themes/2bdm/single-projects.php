<?php
get_header();

if (have_rows('header_banner')) :
    get_template_part("components/block_header_banner");
endif;

if (have_rows('content_blocks')) :
    while (have_rows('content_blocks')) : the_row(); ?>
        <section class="content-blocks">
            <?php switch(get_row_layout()) {
                case 'text':
                    get_template_part("components/block_text");
                    break;
                case 'images':
                    get_template_part("components/block_images");
                    break;
                case 'data_table':
                    get_template_part("components/block_table");
                    break;
            } ?>
        </section>
    <?php endwhile;
endif;

get_footer();
?>

