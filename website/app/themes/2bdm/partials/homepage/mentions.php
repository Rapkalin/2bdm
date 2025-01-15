<?php

if (have_rows('home_mentions')) :
    while (have_rows('home_mentions')) : the_row();
        if(get_sub_field('image')['url']) : ?>
            <section id="home-mentions" class="home-block">
                <div class="banner" style="background-image: url(<?= get_sub_field('image')['url']; ?>);">
                    <div class="content">
                        <p><?php the_sub_field('title'); ?></p>
                        <div class="section-mentions">
                            <?php while (have_rows('mentions')) : the_row() ?>
                                <p><?php the_sub_field('description'); ?></p>
                                <h3><?php the_sub_field('title'); ?></h3>
                                <p><?php the_sub_field('location'); ?></p>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif;
    endwhile;
endif;

