<?php

if (have_rows('home_articles')) :
    $featured_articles = get_field('home_articles');
    if ($featured_articles) : ?>
        <section id="home-articles" class="home-block">
            <?php foreach ($featured_articles as $article) :
                $image = get_field('thumbnail_image', $article->ID);
            ?>
                <a href="<?= get_permalink($article->ID) ?>">
                    <div class="home-article">
                        <h2><?= $article->post_title ?></h2>
                        <p><?= $article->post_excerpt ?></p>
                        <img
                            alt="<?= $image['title'] ?>"
                            src="<?= $image['url'] ?>"
                            width="<?= $image['width'] ?>"
                            height="<?= $image['height'] ?>"
                        >
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif;
endif;