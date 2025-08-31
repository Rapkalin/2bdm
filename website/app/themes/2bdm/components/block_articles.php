<section class="section-block-next-articles-wrapper main-wrapper <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
    <?php if($args['show_header_main']): ?>
        <div class="main-header">
            <h2 class="title"><?= $args['show_header_main'] ?></h2>
            <?php get_template_part('components/button', args: [
                'buttonClasses' => $args['buttonClasses']
            ]) ?>
        </div>
    <?php endif; ?>

    <div class="next-articles-container">
        <?php foreach($args['articles'] as $article): ?>
            <?php get_template_part("components/block_article", args: [
                'article' => $article,
            ]) ?>
        <?php endforeach; ?>
    </div>
</section>