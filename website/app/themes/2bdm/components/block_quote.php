<section class="section-block-quote">
    <div class="banner" style="background-image: url(<?= get_sub_field('image')['url']; ?>);">
        <h2 class="block-quote">
            <?php get_template_part('components/svg-quote') ?>
            <?= nl2br(get_sub_field('quote')) ?>
        </h2>
    </div>
</section>