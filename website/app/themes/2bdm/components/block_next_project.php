<section class="section-next-next-project-wrapper max-width-container <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
    <?php if($args['show_header_main']): ?>
        <div class="main-header">
            <h2 class="title"><?= $args['show_header_main'] ?></h2>
            <?php get_template_part('components/button', args: [
                    'buttonClasses' => $args['buttonClasses']
            ]) ?>
        </div>
    <?php endif; ?>

    <div class="next-project-links">
        <?php if($args['show_header_minor']): ?>
            <div class="previous-project">Projet suivant</div>

            <div class="all-projects-container">
                <a class="all-projects" href="/grille-des-projets">Tous nos projets</a>
                <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <?php get_template_part("components/block_project", args: [
        'project' => $args['project'],
        'project_banner' => $args['project_banner'],
        'srcset' => wp_get_attachment_image_srcset( $args['project_banner']['image']['ID'])
    ]) ?>
</section>