<section class="header-banner slide-content"
         style='background-image: url("<?= $args['banner']['image']['url']; ?>")'
>
    <div class="hb-wrapper row-2">
        <h1><?=  $args['banner']['title']; ?></h1>
        <?php if($args['banner']['description']): ?>
            <div class="hb-description">
                <i class="fa-solid fa-circle"></i>
                <div class="hb-description-content">
                    <?= $args['banner']['description']; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="hb-bottom row-3 hb-active">
        <div class="hb-button-wrapper <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
            <a class="classic-button" href="<?= $args['permalink']; ?>">
               Voir le projet
               <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
            </a>
        </div>

        <div class="hb-cta-wrapper">
            <a class="hb-cta" href="#first-section">
                <span class="svg-arrow-down"><?php get_template_part("components/svg-arrow-down"); ?></span>
                <div><?= $args['banner']['call_to_action']; ?></div>
            </a>
            <div class="hb-slider-buttons <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
                <button class="prev-slide"><?php get_template_part("components/svg-arrow-left"); ?></button>
                <button class="next-slide"><?php get_template_part("components/svg-arrow-right"); ?></button>
            </div>
        </div>
    </div>
</section>

<span id="first-section"></span>
