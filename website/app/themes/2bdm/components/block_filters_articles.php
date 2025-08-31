<div class="filters-container filters-container-articles main-wrapper" style="
    margin-top: 50px;
">
    <div class="fc-title">
        <?php get_template_part('components/svg-bullet') ?>
        Actualités
    </div>
    <div class="fc-terms-container">
        <div id="all" class="filter-content">
            <div class="filter-term selected" data-term-id="all">
                Tout
            </div>
        </div>
        <?php foreach ($args['terms'] as $term) : ?>
            <div id="<?= $term->slug ?>" class="filter-content">
                <div class="filter-term" data-term-id="<?= $term->term_id ?>">
                    <?= $term->name ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
