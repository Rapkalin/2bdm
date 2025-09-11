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

<section class="section-block-home-cover"
         style='background-image:
                 linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.2)),
                 url("<?= $homeCover['image']['url']; ?>")'
>
    <div class="block-cover-words">
        <?php foreach($homeCover['cover_words'] as $i => $word): ?>
            <div class="word">
                <?= $word['cover_word'] ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<span id="first-section"></span>

<?php
if (have_rows('content_blocks')) :
    while (have_rows('content_blocks')) : the_row(); ?>
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
    <?php endwhile;
endif;
get_footer();