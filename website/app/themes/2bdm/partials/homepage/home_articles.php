<?php

if (have_rows('home_articles')) :
    $featured_articles = get_field('home_articles');
    if ($featured_articles) : ?>
        <section id="home-projects" class="section-block-next-articles-wrapper main-wrapper">
            <section class="next-articles-container">
                <?php foreach ($featured_articles as $article) : ?>
                    <?php get_template_part("components/block_article", args: [
                        'article' => $article,
                    ]) ?>
                <?php endforeach; ?>
            </section>
        </section>
    <?php endif;
endif;
