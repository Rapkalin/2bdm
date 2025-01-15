<?php

if (have_rows('home_core_business')) : while (have_rows('home_core_business')) : the_row();
    if(get_sub_field('image')['url']) :
?>

        <section id="home-core-business" class="home-block">
            <div class="banner" style="background-image: url(<?= get_sub_field('image')['url']; ?>);">
                <div class="content">
                    <p><?php the_sub_field('description'); ?></p>
                    <?php if (get_sub_field('button')['url']) : ?>
                        <a href="<?= get_sub_field('button')['url']; ?>" class="button"><?= get_sub_field('button')['label']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php
        endif;
    endwhile;
endif;

