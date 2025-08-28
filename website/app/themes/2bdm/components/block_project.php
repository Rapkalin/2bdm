<section class="section-block-next-project-container">
    <a href="<?= get_permalink($args['project']) ?>">
        <h2><?= get_the_title($args['project']) ?></h2>
        <ul>
            <li><?= get_the_excerpt($args['project']) ?></li>
        </ul>
        <div class="next-project-img">
            <img
                src="<?= $args['project_banner']['image']['url']; ?>"
                srcset="<?php echo esc_attr( $args['srcset'] ); ?>"
                alt="<?= $args['project_banner']['image']['title']; ?>"
                height="<?= $args['project_banner']['image']['height']; ?>"
                width="<?= $args['project_banner']['image']['width']; ?>"
            >
            <div class="next-project-button">
                <button class="classic-button">
                   Voir le projet
                   <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
                </button>
            </div>
        </div>
    </a>
</section>