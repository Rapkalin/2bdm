<section class="section-block-chapo">
    <h2 class="chapo-title"><?= get_sub_field('chapo_title') ?></h2>
    <div class="chapo-container">
        <div class="chapo-bullet">
            <?php get_template_part('components/svg-bullet') ?>
            <?= get_sub_field('chapo_bullet') ?>
        </div>
        <div class="chapo-description-container">
            <div><?= get_sub_field('chapo_description') ?></div>
            <button>Button</button>
        </div>
    </div>
</section>