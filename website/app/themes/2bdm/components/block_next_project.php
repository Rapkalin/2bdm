<div class="next-project-wrapper main-wrapper">
    <?php
        $next_project = get_sub_field('next_project')[0];
        $next_project_banner = get_field('header_banner', $next_project->ID);
        $srcset = wp_get_attachment_image_srcset( $next_project_banner['image']['ID']);
    ?>
    <div class="next-project-links">
        <div class="previous-project">Projet suivant</div>

        <div class="all-projects-container">
            <a class="all-projects" href="/projects">Tous nos projets</a>
            <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
        </div>
    </div>
    <div class="next-project-container">
        <h2><?= $next_project->title ?></h2>
        <ul>
            <li><?= $next_project->post_excerpt ?></li>
        </ul>
        <img
            src="<?= $next_project_banner['image']['url']; ?>"
            srcset="<?php echo esc_attr( $srcset ); ?>"
            alt="<?= $next_project_banner['image']['title']; ?>"
            height="<?= $next_project_banner['image']['height']; ?>"
            width="<?= $next_project_banner['image']['width']; ?>"
        >
    </div>
</div>