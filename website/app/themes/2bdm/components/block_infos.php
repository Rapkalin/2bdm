<section class="section-block-infos">
    <div class="block-infos-title"><?= get_sub_field('title') ?></div>
    <div class="block-infos-container">
        <?php foreach (get_sub_field('content') as $content): ?>
            <div class="block-infos">
                <div class="title"><?= $content['title'] ?></div>
                <div class="content"><?= $content['description'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>