<div class="next-project-wrapper <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
    <div class="next-project-links">
        <div class="previous-project">Projet suivant</div>

        <div class="all-projects-container">
            <a class="all-projects" href="/projects">Tous nos projets</a>
            <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
        </div>
    </div>
    <?php get_template_part("components/block_project", args: [
        'project' => $args['project'],
        'project_banner' => $args['project_banner'],
        'srcset' => wp_get_attachment_image_srcset( $args['project_banner']['image']['ID'])
    ]) ?>
</div>