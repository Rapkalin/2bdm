<?php

if (have_rows('home_projects')) :
    $featured_projects = get_field('home_projects');
    if ($featured_projects) : ?>
        <section id="home-projects" class="home-block">
            <?php foreach ($featured_projects as $project) : ?>
                <a href="<?= get_permalink($project->ID) ?>">
                    <div class="home-project">
                        <h2><?= $project->post_title ?></h2>
                        <p><?= $project->post_excerpt ?></p>
                        <img
                            alt="<?= get_field('image', $project->ID)['title'] ?>"
                            src="<?= get_field('image', $project->ID)['url'] ?>"
                            width="<?= get_field('image', $project->ID)['width'] ?>"
                            height="<?= get_field('image', $project->ID)['height'] ?>"
                        >
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif;
endif;