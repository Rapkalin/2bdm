<?php

$featured_projects = get_sub_field('projects');
$main_title = get_sub_field('main_title');
if ($featured_projects) :

    /*
     * We display only the first project in full
     * Then we display a grid with other selected projects
     */
    $next_project = $featured_projects[0];
    $next_project_banner = get_field('header_banner', $next_project->ID);

    get_template_part("components/block_next_project", args: [
        'project' => $next_project,
        'project_banner' => $next_project_banner,
        'srcset' => wp_get_attachment_image_srcset( $next_project_banner['image']['ID']),
        'extraClasses' => ['main-wrapper'],
        'buttonClasses' => ['classic-button-bkg-grey', 'classic-button-border'],
        'show_header_main' => $main_title,
    ]);

    // We remove the first project and display the other in a grid
    unset($featured_projects[0]);
    if ($featured_projects): ?>
        <div class="projects-container main-wrapper">
            <?php foreach ($featured_projects as $featured_project): ?>
                <section class="section-next-next-project-wrapper">
                    <?php
                    $project_banner = get_field('header_banner', $featured_project->ID);

                    get_template_part("components/block_project", args: [
                        'project' => $featured_project,
                        'project_banner' => $project_banner,
                        'srcset' => wp_get_attachment_image_srcset( $project_banner['image']['ID']),
                    ]);
                    ?>
                </section>
            <?php endforeach; ?>
        </div>
    <?php endif;
endif;
