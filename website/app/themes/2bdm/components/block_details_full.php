<?php
dd('details full');
?>
<section class="section-block-details">
    <section class="block-details-left">
        <div class="left-title"></div>
    </section>

    <section class="block-details-right">
        <div class="right-title"></div>
        <div class="details-container">
            <?php foreach ($details as $detail): ?>
                <h3 class="detail-title"><?= $title ?></h3>
                <p class="detail-text"><?= $details ?></p>
            <?php endforeach; ?>
        </div>
    </section>
</section>
