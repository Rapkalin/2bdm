<section
        class="section-block-image-text"
        style="background-image: url(<?= get_sub_field('image')['url']; ?>)"
>
    <div class="container">
        <h2 class="title"><?= get_sub_field('title') ?></h2>
        <div class="description"><?= get_sub_field('description') ?></div>
        <?php if ($button = get_sub_field('button')): ?>
            <a
                class="classic-button"
                href="<?= $button['url'] ?>"
                target="<?= $button['target'] ?>"
            >
                <?= $button['title'] ?>
                <?php get_template_part('components/svg-arrow-right-up-diag') ?>
            </a>
        <?php endif; ?>
    </div>
</section>