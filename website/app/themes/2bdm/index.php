<?php
get_header();
$home = new WP_Query(['pagename' => 'homepage']);
while ($home->have_posts()) : $home->the_post();
    get_template_part('partials/homepage/cover');
endwhile;
?>

<div>
    <h2>Présentation</h2>
</div>

<div>
    <h2>Essence de notre métier</h2>
</div>

<div>
    <h2>Équipe</h2>
</div>

<div>
    <h2>Prix & mentions</h2>
</div>

<div>
    <h2>Publications</h2>
</div>

<div>
    <h2>Publications</h2>
</div>

<div>
    <h2>Projets</h2>
</div>

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