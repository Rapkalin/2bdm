<?php
if (have_rows('home_agencies')) :
    while (have_rows('home_agencies')) : the_row(); ?>
        <section id="home-agencies" class="home-block">
            <?php while (have_rows('agency')) : the_row() ?>
                <a href="<?= get_sub_field('url'); ?>" class="home-agency">
                    <h2><?php the_sub_field('title'); ?></h2>
                    <p><?php the_sub_field('description'); ?></p>
                </a>
            <?php endwhile; ?>
            <div id="google-map"></div>
        </section>
    <?php endwhile;
endif;