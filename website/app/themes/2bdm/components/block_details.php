<?php
dd('details');
?>
<section class="section-block-details">
    <section class="block-details-left">
        <div class="left-title"></div>
        <?php $image = [];
        if($image): ?>
            <img src="" alt="">
        <?php endif; ?>
    </section>

    <section class="block-details-right">
        <div class="right-title"></div>
        <div class="details-container">
            <?php foreach ($details as $detail): ?>
                <p class="detail-text"><?= $details ?></p>
            <?php endforeach; ?>
        </div>
    </section>
</section>
