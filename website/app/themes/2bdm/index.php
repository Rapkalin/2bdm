<?php
get_header();
?>

<?php if (!$_COOKIE["intro"]): ?>
    <div class="intro-container" id="intro-start">
        <?php get_template_part("components/svg-intro"); ?>
    </div>
    <div class="intro-container" id="intro-mask">
        <?php get_template_part("components/svg-intro-mask"); ?>
    </div>
<?php endif; ?>

    <section class="section-block-header-banner slide-content"
             style='background-image: url("<?= get_field('home_cover')['image']['url']; ?>")'
    >
    </section>

    <span id="first-section"></span>

<?php
if (have_rows('content_blocks')) :
    while (have_rows('content_blocks')) : the_row(); ?>
        <section class="content-blocks">
            <?php switch(get_row_layout()) {
                case 'block_chapo':
                    get_template_part("components/block_chapo");
                    break;
            } ?>
        </section>
    <?php endwhile;
endif;
get_footer();