<div class="filters-container main-wrapper">
    <div class="fc-title">Projects</div>
    <div class="fc-terms-container">

        <div class="parent-terms-container">
            <?php foreach ($args['terms'] as $parent_name => $child_terms) :
                $parent_slug = sanitize_title($parent_name);
                ?>
                    <button class="fc-accordion-label" data-target="#<?= $parent_slug ?>">
                       <?= $parent_name ?>
                       <span class="svg-plus-grey"><?php get_template_part("components/svg-plus-grey"); ?></span>
                    </button>
            <?php endforeach; ?>
        </div>

        <div class="accordions-container">
            <?php foreach ($args['terms'] as $parent_name => $child_terms) :
                $parent_slug = sanitize_title($parent_name);
            ?>
                <div id="<?= $parent_slug ?>" class="accordion-content">
                    <?php
                    foreach ($child_terms as $child_term) : ?>
                        <button class="child-term" data-term-id="<?= $child_term->term_id ?>">
                            <?= $child_term->name ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
