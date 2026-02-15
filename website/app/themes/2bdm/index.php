<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$homeCover = get_field('home_cover');
?>

<?php if (!$_COOKIE["intro"]): ?>
    <div class="intro-container" id="intro-start">
        <?php get_template_part("components/svg-intro"); ?>
    </div>
    <div class="intro-container" id="intro-mask">
        <?php get_template_part("components/svg-intro-mask"); ?>
    </div>
<?php endif; ?>

<?php if(have_rows('home_cover')): the_row() ?>
        <?php $align = get_sub_field('text_alignment'); ?>
        <section class="section-block-home-cover text-align-<?= $align ?>"
                 style='background-image:
                         <?php if (get_sub_field('cover_filter_activated')): ?>
                         linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)),
                         <?php endif; ?>
                         url("<?= get_sub_field('image')['url']; ?>")'
        >
            <?php if($description = get_sub_field('description')): ?>
                <div class="description">
                    <?= $description ?>
                </div>
            <?php endif; ?>
        </section>
<?php endif; ?>

<span id="first-section"></span>

<?php
if (have_rows('content_blocks')) : ?>
    <?php
        $templateName  = basename(get_page_template());
        $maxWidth = $templateName === 'page-projects.php' || get_post_type() === 'projects' || is_front_page();
    ?>
    <div class="main-content-container <?= $maxWidth ? 'max-width-container' : '' ?>">
        <?php while (have_rows('content_blocks')) : the_row(); ?>
            <section class="content-blocks <?= get_row_layout() ?>">
                <?php switch(get_row_layout()) {
                    case 'block_chapo':
                        get_template_part("components/block_chapo");
                        break;
                    case 'block_image_text':
                        get_template_part("components/block_image_text_button");
                        break;
                    case 'block_realisations':
                        get_template_part("components/block_realisations");
                        break;
                    case 'block_image_with_text':
                        get_template_part("components/block_image_with_text");
                        break;
                    case 'block_articles':
                        get_template_part("components/block_articles", args: [
                            'articles' => get_sub_field('articles'),
                            'extraClasses' => ['bck-color-grey'],
                            'show_header_main' => get_sub_field('main_title'),
                        ]);
                        break;
                    case 'block_contact':
                        get_template_part("components/block_contact");
                        break;
                } ?>
            </section>
        <?php endwhile; ?>
    </div>
<?php endif;
get_footer();