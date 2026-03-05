<section class="section-block-chapo">
    <h2 class="chapo-title"><?= get_sub_field('chapo_title') ?></h2>
    <div class="chapo-container">
        <?php if ($bullet = get_sub_field('chapo_bullet')): ?>
            <div class="chapo-bullet">
                <?php get_template_part('components/svg-bullet') ?>
                <?= $bullet ?>
            </div>
        <?php endif; ?>

        <div class="chapo-description-container">
            <div class="chapo-description"><?= get_sub_field('chapo_description') ?></div>
            <?php if ($button = get_sub_field('chapo_button')): ?>
                <a
                    class="classic-button classic-button-bkg-grey classic-button-border"
                    href="<?= $button['url'] ?>"
                    target="<?= $button['target'] ?>"
                >
                    <?= $button['title'] ?>
                    <?php get_template_part('components/svg-arrow-right-up-diag') ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>