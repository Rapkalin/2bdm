<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <a href="<?= get_permalink(get_the_ID()) ?>"><?= the_title() ?></a><br>
    <?php endwhile;
endif;

get_footer();
?>