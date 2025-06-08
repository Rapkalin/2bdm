<?php if (have_rows('header_banner')) : the_row() ?>
    <section class="header-banner"
        style='background-image: url("<?= get_sub_field('image')['url'];?>")'
    >
        <div class="hb-wrapper">
            <h1><?php the_sub_field('title'); ?></h1>

            <?php if(get_sub_field('description')): ?>
                <div class="hb-description">
                    <i class="fa-solid fa-circle"></i>
                    <p><?= get_sub_field('description'); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <a id="hb-cta" href="#first-section">
            <span class="svg-arrow-down"><?php get_template_part("components/svg-arrow-down"); ?></span>
            <div><?= get_sub_field('call_to_action'); ?></div>
        </a>
    </section>
<?php endif ?>

