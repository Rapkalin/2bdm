<?php

$featured_projects = get_sub_field('projects');
$main_title = get_sub_field('main_title');
if ($featured_projects) :
    // BLOCK NEXT PROJECT
    $next_project = $featured_projects[0];
    $next_project_banner = get_field('header_banner', $next_project->ID);

    get_template_part("components/block_next_project", args: [
        'project' => $next_project,
        'project_banner' => $next_project_banner,
        'srcset' => wp_get_attachment_image_srcset( $next_project_banner['image']['ID']),
        'extraClasses' => ['main-wrapper'],
        'buttonClasses' => ['classic-button-bkg-grey'],
        'show_header_main' => $main_title,
    ]);
endif;
