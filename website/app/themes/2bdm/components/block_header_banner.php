<section class="header-banner"
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

    <div class="hb-bottom row-3">
        <?php if(isset($args['slider']) && $args['slider']) : ?>
            <div class="hb-button-wrapper">
                <a class="classic-button" href="<?= $args['permalink']; ?>">Voir le projet</a>
            </div>
        <?php endif; ?>
        <div class="hb-cta-wrapper">
            <a class="hb-cta" href="#first-section">
                <span class="svg-arrow-down"><?php get_template_part("components/svg-arrow-down"); ?></span>
                <div><?= $args['banner']['call_to_action']; ?></div>
            </a>
            <?php if(isset($args['slider']) && $args['slider']) : ?>
                <div class="hb-slider-buttons">
                    <button><?php get_template_part("components/svg-arrow-left"); ?></button>
                    <button><?php get_template_part("components/svg-arrow-right"); ?></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>