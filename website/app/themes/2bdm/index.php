<?php
get_header();
?>
        <div class="intro-container" id="intro-start">
            <?php get_template_part("components/intro-svg"); ?>
        </div>
        <div class="intro-container" id="intro-mask">
            <?php get_template_part("components/intro-svg-mask"); ?>
        </div>
<?php

$home = new WP_Query(['pagename' => 'homepage']);
while ($home->have_posts()) : $home->the_post();
    foreach (get_fields($home->post->ID) as $key => $field) {
        if (file_exists(__DIR__ . "/partials/homepage/{$key}.php")) {
            get_template_part("partials/homepage/{$key}");
        }
    }
endwhile;
?> <button id="button">Cliquez ici</button> <?php
get_footer();