<?php
get_header();
$home = new WP_Query(['pagename' => 'homepage']);
while ($home->have_posts()) : $home->the_post();
    $fields = get_fields($home->post->ID);
    foreach ($fields as $key => $field) {
        if (file_exists(__DIR__ . "/partials/homepage/{$key}.php")) {
            get_template_part("partials/homepage/{$key}");
        }
    }
endwhile; ?>

<div>
    <h2>A la une</h2>
</div>

<div>
    <h2>Nos agences</h2>
</div>

<div>
    <h2>Contact bloc</h2>
</div>

<?php
get_footer();