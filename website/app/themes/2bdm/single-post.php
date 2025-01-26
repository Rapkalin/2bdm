<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>
            <h1 id="article-title"><?= the_title() ?></h1>
            <div id="article-content">
                <?= the_content() ?>
            </div>
        <?php
    endwhile;
endif;

get_footer();
?>

