<?php
get_header();

if (have_rows('header_banner')) : the_row() ?>
    <?php
        get_template_part("components/block_header_banner", args: [
            'banner' => [
                'image'=> ['url' => get_sub_field('image')['url']],
                'title' => get_sub_field('title'),
                'description' => get_sub_field('description'),
                'call_to_action' => get_sub_field('call_to_action'),
            ],
            'permalink' => get_permalink()
        ]);
    ?>
<?php endif;

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
                case 'carousel':
                    get_template_part("components/block_carousel");
                    break;
                case 'introduction':
                    get_template_part("components/block_introduction", args: [
                        'extraClasses' => ['main-wrapper', 'project-intro-wrapper']
                    ]);
                    break;
                case 'next_project':
                    $next_project = get_sub_field('next_project')[0];
                    $next_project_banner = get_field('header_banner', $next_project->ID);

                    get_template_part("components/block_next_project", args: [
                        'project' => $next_project,
                        'project_banner' => $next_project_banner,
                        'srcset' => wp_get_attachment_image_srcset( $next_project_banner['image']['ID']),
                        'extraClasses' => ['main-wrapper']
                    ]);
                    break;
            } ?>
        </section>
    <?php endwhile;
endif;

get_footer();
?>

