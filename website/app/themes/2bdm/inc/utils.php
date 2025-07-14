<?php

/**
* Return images folder path
*/
function asset($path): string
{
    return get_template_directory_uri() . '/assets/images/' . $path;
}

function get_terms_hierarchy(string $taxonomy): array
{
    $parent_terms = get_terms([
        'taxonomy' => $taxonomy,
        'parent' => 0,
    ]);

    $terms = [];
    foreach ($parent_terms as $parent_term) {
        $terms[$parent_term->name] = get_terms([
            'taxonomy' => $taxonomy,
            'child_of' => $parent_term->term_id,
        ]);
    }

    return $terms;
}