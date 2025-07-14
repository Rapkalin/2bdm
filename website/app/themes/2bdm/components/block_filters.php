<div class="filters-container main-wrapper">
    <div class="fc-title">Projects</div>
    <div class="fc-terms-container">
        <?php foreach ($args['terms'] as $parent_name => $child_terms) :
            // Utilisez le slug ou un identifiant unique pour l'attribut id
            $parent_slug = sanitize_title($parent_name);
            ?>
            <div class="parent-term">
                <button class="fc-accordion-label" data-target="#<?= $parent_slug ?>">
                   <?= $parent_name ?>
                   <span class="svg-plus-grey"><?php get_template_part("components/svg-plus-grey"); ?></span>
                </button>
                <div id="<?= $parent_slug ?>" class="accordion-content">
                    <?php
                    foreach ($child_terms as $child_term) : ?>
                        <div class="child-term" data-term-id="<?= $child_term->term_id ?>">
                            <?= $child_term->name ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
