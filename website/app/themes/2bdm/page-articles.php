<?php
/**
 * Template Name: Grille des articles
 *
 * @package WordPress
 */

get_header(args:['color-logo' => '__grey']);

?>
    <div class="article-container articles-grid-header-container">
        <div class="articles-grid-title"><?= get_field('title') ?></div>
        <div class="articles-grid-description"><?= get_field('description') ?></div>
    </div>
<?php

$terms =     $parent_terms = get_terms([
    'taxonomy' => '2bdm-articles',
    'parent' => 0,
]);
get_template_part("components/block_filters_articles", args: ['terms' => $terms]);

// Initial query to load only 4 articles
$tax_query = [];
if (isset($_GET['terms']) && $_GET['terms'] !== 'all') {
    $terms = explode(',', $_GET['terms']);
    $tax_query = [
        [
            'taxonomy' => '2bdm-articles',
            'field' => 'term_id',
            'terms' => $terms,
        ]
    ];
}

$query = new WP_Query(
    [
        'post_type' => 'articles',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => 1,
        'tax_query' => $tax_query
    ]
);

// Get the total number of projects
$total_articles = $query->found_posts;
?>
<section class="section-block-next-articles-wrapper main-wrapper">
        <div class="next-articles-container">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <?php get_template_part("components/block_article", args: [
                    'article' => get_post(),
                ]) ?>
            <?php endwhile; ?>
        </div>
</section>

    <!-- We display the Button load more projects only if there are more than 4 projects left -->
<?php if ($total_articles > 4) : ?>
    <div class="button-load-more">
        <button
            id="load-more"
            class="classic-button"
            data-projects-left="<?= $total_articles ?>"
            data-page="1"
            data-url="<?php echo admin_url('admin-ajax.php'); ?>"
        >
            Voir plus d'actualités
            <?php get_template_part("components/svg-plus"); ?>
        </button>
    </div>
<?php endif;

wp_reset_query();
get_footer();
?>