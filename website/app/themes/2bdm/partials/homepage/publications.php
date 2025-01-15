<?php

if (have_rows('home_publications')) :
    while (have_rows('home_publications')) : the_row(); ?>
        <section id="home-publications" class="home-block">
            <div class="content">
                <p><?php the_sub_field('title'); ?></p>
                <div class="section-publications">
                    <?php while (have_rows('publications')) : the_row() ?>
                        <div class="publication">
                            <img
                                alt="<?= get_sub_field('image')['title'] ?>"
                                src="<?= get_sub_field('image')['url'] ?>"
                                width="<?= get_sub_field('image')['width'] ?>"
                                height="<?= get_sub_field('image')['height'] ?>"
                            >
                            <h2><?php the_sub_field('title'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endwhile;
endif;