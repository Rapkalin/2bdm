<section class="section-block-publications">
    <div class="publications-intro-title">
        <?php get_template_part('components/svg-bullet') ?>
        <?= get_sub_field('title') ?>
    </div>
    <div class="block-publications-container">
        <div class="block-publications-wrapper">
            <div class="publications-intro-description"><?= get_sub_field('description') ?></div>
            <div class="block-publications-cards">
                <?php foreach (get_sub_field('publication_cards') as $card): ?>
                    <div class="block-publications-card">
                        <img src="<?= $card['publication_image']['url'] ?>" alt="publication-cover">
                        <div class="publication-info">
                            <div class="publication-info-details">
                                <div class="publication-title"><?= $card['publication_title'] ?></div>
                                <div class="publication-author"><?= $card['publication_author'] ?></div>

                                <?php if ($card['button']): ?>
                                    <a class="publication-button" href="<?= $card['button']['url'] ?>">
                                        <?= $card['title'] ?>
                                        <span class="svg-right"><?php get_template_part("components/svg-arrow-right") ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="publication-details">
                                <div class="publication-name"><?= $card['publication_newspaper_title'] ?></div>
                                <div class="publication-year">
                                    <?php get_template_part('components/svg-bullet') ?>
                                    <?= $card['publication_year'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>