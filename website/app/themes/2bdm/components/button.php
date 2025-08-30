<?php if ($button = get_sub_field('button')): ?>
    <a
        class="classic-button <?= isset($args['buttonClasses']) ? implode(' ', $args['buttonClasses']) : '' ?>"
        href="<?= $button['url'] ?>"
        target="<?= $button['target'] ?>"
    >
        <?= $button['title'] ?>
        <?php get_template_part('components/svg-arrow-right-up-diag') ?>
    </a>
<?php endif; ?>