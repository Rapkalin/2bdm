<section class="section-block-contact">
    <?php $image = get_sub_field('image');
    if( $image ): ?>
        <?php $srcset = wp_get_attachment_image_srcset( $image['ID']); ?>
        <img
            src="<?= $image['url'] ?>"
            srcset="<?php echo esc_attr( $srcset ); ?>"
            alt="<?= $image['alt'] ?? $image['title'] ?>"
            width="<?= $image['width'] ?>"
            height="<?= $image['height'] ?>"
        >
    <?php endif; ?>

    <div class="block-contact-container">
        <div class="contact-container">
            <h3 class="title"><?= get_sub_field('title') ?></h3>
            <p class="description"><?= get_sub_field('description', false) ?></p>
            <?php get_template_part('components/button', args: [
                'buttonClasses' => ['classic-button-bkg-grey', 'classic-button-border'],
            ]) ?>
        </div>

        <?php while(have_rows('join_us')): the_row() ?>
            <div class="join-us-container">
                <div class="join-us-details">
                    <h3 class="title"><?= get_sub_field('title') ?></h3>
                    <p class="description"><?= get_sub_field('description', false) ?></p>
                </div>
                <?php if($button = get_sub_field('button')): ?>
                    <a href="<?= $button['url'] ?>">
                        <?= $button['title'] ?>
                        <?php get_template_part('components/svg-arrow-right-up-diag') ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>