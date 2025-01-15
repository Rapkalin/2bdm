<?php

if (have_rows('home_core_business')) :
    while (have_rows('home_core_business')) : the_row();
        if(get_sub_field('image')['url']) : ?>
            <section id="home-core-business" class="home-block">
                <div class="content">
                    <div class="section-title">
                        <h2><?php the_sub_field('title'); ?></h2>
                    </div>
                    <p><?php the_sub_field('description'); ?></p>
                    <img
                        alt="<?= get_sub_field('image')['title'];?>"
                        src="<?= get_sub_field('image')['url'];?>"
                        width="<?= get_sub_field('image')['width'];?>"
                        height="<?= get_sub_field('image')['height'];?>"
                    >
                </div>
            </section>
        <?php endif;
    endwhile;
endif;