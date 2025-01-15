<?php

if (have_rows('home_cover')) :
    while (have_rows('home_cover')) : the_row();
        if(get_sub_field('image')['url']) : ?>
            <section id="home-cover" class="home-block">
                <div class="banner" style="background-image: url(<?= get_sub_field('image')['url']; ?>);">
                    <div class="content">
                        <div class="section-title">
                            <h2><?php the_sub_field('title'); ?></h2>
                        </div>
                        <?php if (get_sub_field('button')['url']) : ?>
                            <a href="<?= get_sub_field('button')['url']; ?>" class="button"><?= get_sub_field('button')['label']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;
    endwhile;
endif;

