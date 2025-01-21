<?php

if (have_rows('home_projects')) :
    while (have_rows('home_projects')) : the_row();
        $featured_projects = get_field('home_projects');
        if ($featured_projects) : ?>
            <section id="home-projects" class="home-block">
                <?php foreach ($featured_projects as $project) : ?>
                    <div class="home-project">
                        <h2><?php the_field('title', $project->ID); ?></h2>
                        <p><?php the_field('description', $project->ID); ?></p>
                        <img
                            alt="<?= get_field('image', $project->ID)['title'] ?>"
                            src="<?= get_field('image', $project->ID)['url'] ?>"
                            width="<?= get_field('image', $project->ID)['width'] ?>"
                            height="<?= get_field('image', $project->ID)['height'] ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif;
    endwhile;
endif;