<?php

if (have_rows('home_projects')) :
    $featured_projects = get_field('home_projects');
    if ($featured_projects) : ?>
        <section id="home-projects" class="home-block projects-container main-wrapper">
            <?php foreach ($featured_projects as $project) : ?>
            <section class="section-next-next-project-wrapper">
                <?php
                    $project_banner = get_field('header_banner', $project->ID);

                    get_template_part("components/block_project", args: [
                        'project' => $project,
                        'project_banner' => $project_banner,
                        'srcset' => wp_get_attachment_image_srcset( $project_banner['image']['ID']),
                    ]);
                ?>
            </section>
            <?php endforeach; ?>
        </section>
    <?php endif;
endif;
