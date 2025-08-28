<section class="section-block-numbers">
    <div class="block-numbers-title"><?= get_sub_field('title') ?></div>
    <div class="block-numbers-container">
        <?php foreach (get_sub_field('numbers') as $number): ?>
            <div class="block-number">
                <div class="number"><?= $number['nombre'] ?></div>
                <div class="title"><?= $number['text'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>