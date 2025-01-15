<?php

if (have_rows('home_team')) : while (have_rows('home_team')) : the_row();
?>
    <section id="home-team" class="home-block">
        <div class="banner">
            <div class="content">
                <div class="section-title">
                    <h2><?php the_sub_field('title'); ?></h2>
                </div>
                <div class="section-members">
                    <?php while (have_rows('members')) : the_row() ?>
                        <div class="member" style="background-image: url(<?= get_sub_field('image')['url']; ?>)">
                            <h2><?php the_sub_field('name'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php
    endwhile;
endif;

