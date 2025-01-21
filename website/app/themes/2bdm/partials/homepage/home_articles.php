<?php

if (have_rows('home_articles')) :
    while (have_rows('home_articles')) : the_row();
        $featured_articles = get_field('home_articles');
        if ($featured_articles) : ?>
            <section id="home-articles" class="home-block">
                <?php foreach ($featured_articles as $article) : ?>
                    <div class="home-article">
                        <h2><?php the_field('title', $article->ID); ?></h2>
                        <p><?php the_field('description', $article->ID); ?></p>
                        <img
                            alt="<?= get_field('image', $article->ID)['title'] ?>"
                            src="<?= get_field('image', $article->ID)['url'] ?>"
                            width="<?= get_field('image', $article->ID)['width'] ?>"
                            height="<?= get_field('image', $article->ID)['height'] ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif;
    endwhile;
endif;