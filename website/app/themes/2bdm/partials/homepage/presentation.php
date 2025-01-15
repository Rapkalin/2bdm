<?php

if (have_rows('home_presentation')) :
    while (have_rows('home_presentation')) : the_row();
        if(get_sub_field('image')['url']) : ?>
            <section id="home-presentation" class="home-block">
                <div class="banner" style="background-image: url(<?= get_sub_field('image')['url']; ?>);">
                    <div class="content">
                        <div class="section-title">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                        </div>
                        <div class="section-numbers">
                            <?php while (have_rows('numbers')) : the_row() ?>
                                <h2><?php the_sub_field('number'); ?></h2>
                                <p><?php the_sub_field('description'); ?></p>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif;
    endwhile;
endif;

