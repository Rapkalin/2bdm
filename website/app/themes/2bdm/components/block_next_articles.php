<div class="main-wrapper next-articles-wrapper">
    <div class="all-articles-container">
        <p>Cela peut vous intéresser...</p>
        <a class="all-articles" href="/actualites">Toutes nos actualités</a>
        <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
    </div>

    <div class="next-articles-container">
        <?php foreach ($args['articles'] as $article):?>
            <?php get_template_part("components/block_article", args: [
                'article' => $article,
                'project_banner' => $args['project_banner'],
                'srcset' => wp_get_attachment_image_srcset( $args['project_banner']['image']['ID'])
            ]) ?>
        <?php endforeach ?>
    </div>
</div>
