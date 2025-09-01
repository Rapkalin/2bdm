<?php
    $article = $args['article'];
    $next_article_banner = get_field('thumbnail_image', $article->ID);
    $srcset = wp_get_attachment_image_srcset( $next_article_banner['ID']);

    /*
     * We only display the first taxonomy
     * So even though there are several contributed we only take the first one
     */
    $taxonomy = get_the_terms($article->ID, '2bdm-articles')[0];
?>

<div class="next-article-container">
    <a href="<?= get_permalink() ?>">
        <div class="next-article-img-container">
            <div class="next-article-taxonomy-button">
                <button class="classic-button">
                    <?= $taxonomy->name ?>
                </button>
            </div>

            <div class="next-article-img">
                <img
                    src="<?= $next_article_banner['url']; ?>"
                    srcset="<?php echo esc_attr( $args['srcset'] ); ?>"
                    alt="<?= $next_article_banner['title']; ?>"
                    height="<?= $next_article_banner['height']; ?>"
                    width="<?= $next_article_banner['width']; ?>"
                >

                <div class="next-article-button">
                    <button class="classic-button">
                        En savoir plus
                        <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
                    </button>
                </div>
            </div>

        </div>
    </a>
    <div class="next-article-date">
        <i class="fa-solid fa-circle"></i>
        <?= get_field('release_date', $article->ID) ?>
    </div>
    <h2 class="next-article-title"><?= get_field('title', $article->ID) ?></h2>
</div>