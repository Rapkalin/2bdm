<?php
get_header();

/*
 * We only display the first taxonomy
 * So even though there are several contributed we only take the first one
 */
$taxonomy = get_the_terms(get_the_ID(), '2bdm-articles')[0];
?>
<div class="article-container">
    <div class="article-header-wrapper">
        <span class="article-date"><?= get_field('release_date', $post->ID) ?></span>
        <span class="article-taxonomy"><?= $taxonomy->name ?></span>
    </div>
    <h1 class="article-title"><?= get_field('title', $post->ID) ?></h1>

    <?php
        if (have_rows('content_blocks')) :
            while (have_rows('content_blocks')) : the_row(); ?>
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
                            ?><div class="article-content"><?= get_sub_field('content', $post->ID) ?></div><?php
                            break;
                    } ?>
                </section>
            <?php endwhile;
        endif;
    ?>
</div>


<?php
    if (have_rows('next_articles')) :
        $next_articles = get_field('next_articles');
        get_template_part("components/block_next_articles", args: [
            'articles' => $next_articles,
            'extraClasses' => ['main-wrapper']
        ]);
    endif;

    get_footer();
?>

