<div class="filters-container main-wrapper">
    <h3 class="fc-title">
        <?php get_template_part('components/svg-bullet') ?>
        Projects
    </h3>
    <div class="fc-terms-container">

        <div class="parent-terms-container">
            <?php foreach ($args['terms'] as $parent_name => $child_terms) :
                $parent_slug = sanitize_title($parent_name);
                ?>
                    <button class="fc-accordion-label" data-target="#<?= $parent_slug ?>">
                       <?= $parent_name ?>
                        <span class="icon-plus"><?php get_template_part("components/svg-plus"); ?></span>
                        <span class="icon-minus" style="display: none;"><?php get_template_part("components/svg-minus"); ?></span>                    </button>
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
                            <?php get_template_part("components/svg-plus"); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
