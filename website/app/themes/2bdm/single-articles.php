<?php
get_header(args:['color-logo' => '__grey']);

if (is_preview()) {
    global $post;
    $post_id = $post->ID;
} else {
    $post_id = get_the_ID();
}

/*
 * We only display the first taxonomy
 * So even though there are several contributed we only take the first one
 */
$taxonomy = get_the_terms(get_the_ID(), '2bdm-articles')[0];
?>
<div class="article-container">
    <div class="article-header-wrapper">
        <span class="no-numbers-animation article-date"><?= get_field('release_date', $post_id) ?></span>
        <span class="article-taxonomy"><?= $taxonomy->name ?></span>
    </div>
    <h1 class="article-title"><?= get_field('title', $post_id) ?></h1>

    <?php
        if (have_rows('content_blocks', $post_id)) :
            while (have_rows('content_blocks', $post_id)) : the_row(); ?>
                <section class="content-blocks">
                    <?php switch(get_row_layout()) {
                        case 'image':
                            get_template_part("components/block_image");
                            break;
                        case 'introduction':
                            get_template_part("components/block_introduction", args: [
                                'extraClasses' => ['article-intro-wrapper']
                            ]);
                            break;
                        case 'text':
                            get_template_part("components/block_text");
                            break;
                        case 'content':
                            ?><div class="no-numbers-animation article-content"><?= get_sub_field('content', false) ?></div>
                            <?php break;
                    } ?>
                </section>
            <?php endwhile;
        endif;
    ?>

    <?php  if($button = get_field('button', $post_id)): ?>
        <a
            class="article-button classic-button classic-button-bkg-grey classic-button-border"
            href="<?= $button['url'] ?>"
        >
            <?= $button['title'] ?>
            <?php get_template_part('components/svg-arrow-right-up-diag') ?>
        </a>
    <?php endif; ?>
</div>


<?php
    if (have_rows('next_articles', $post_id)) :
        $next_articles = get_field('next_articles', $post_id);
        get_template_part("components/block_next_articles", args: [
            'articles' => $next_articles,
            'extraClasses' => ['main-wrapper']
        ]);
    endif;

    get_footer();
?>

