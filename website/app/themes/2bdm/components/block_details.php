<?php
$leftDetails = get_sub_field('block_details_left');
$rightDetails = get_sub_field('block_details_right');
?>

<section class="section-block-details main-wrapper">
    <section class="block-details-left">
        <h3 class="left-title"><?= $leftDetails['title'] ?></h3>
        <?php if($image = $leftDetails['image']): ?>
            <?php $srcset = wp_get_attachment_image_srcset( $image['ID']); ?>
            <img
                src="<?php header_image(); ?>"
                srcset="<?php echo esc_attr( $srcset ); ?>"
                alt="<?= $image['alt'] ?? $image['title'] ?>"
                width="<?= $image['width'] ?>"
                height="<?= $image['height'] ?>"
            >
        <?php endif; ?>
    </section>

    <section class="block-details-right">
        <h2 class="right-title"><?= $rightDetails['introduction'] ?></h2>
        <div class="details-container">
            <?php foreach ($rightDetails['contents'] as $detail): ?>
                <?= $detail['content'] ?>
            <?php endforeach; ?>
        </div>
    </section>
</section>
