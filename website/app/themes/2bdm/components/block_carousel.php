<?php
$images = get_sub_field('images');
if( $images ): ?>
    <section class="carousel-images">
        <div class="carousel-track">
            <?php foreach( $images as $image ): ?>
                <div class="carousel-slide">
                    <img
                        src="<?= esc_url($image['url']) ?>"
                        alt="<?= esc_attr($image['alt'] ?? $image['title']) ?>"
                        width="<?= $image['width'] ?>"
                        height="<?= $image['height'] ?>"
                    >
                </div>
            <?php endforeach; ?>
        </div>

        <div class="carousel-nav">
            <button class="carousel-prev"><?php get_template_part("components/svg-arrow-left"); ?></button>
            <?php get_template_part("components/svg-carousel"); ?>
            <button class="carousel-next"><?php get_template_part("components/svg-arrow-right"); ?></button>
        </div>
    </section>
<?php endif; ?>
