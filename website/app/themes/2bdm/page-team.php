<?php
/**
 * Template Name: Page équipe
 *
 * @package WordPress
 */

get_header(args:['color-logo' => '__grey']);
?>

<div class="page-header-container">
    <h1 class="title"><?= get_field('title') ?></h1>
    <div class="description"><?= get_field('description') ?></div>
</div>

<div class="main-wrapper">
    <section class="section-block-people">
        <?php foreach (get_field('departments') as $department): ?>
            <div class="accordion-block block-people">
                <h3 class="accordion-title block-people-title">
                    <?= $department['title'] ?>
                    <span class="accordion-icon">-</span>
                </h3>
                <div class="accordion-content">
                    <div class="block-people-container">
                    <?php foreach ($department['team'] as $member): ?>
                        <?php $srcset = wp_get_attachment_image_srcset( $member['image']['ID']); ?>
                        <div
                            class="people-details"
                            data-name="<?= esc_attr($member['title']) ?>"
                            data-description="<?= esc_attr($member['description']) ?>"
                            data-image="<?= esc_url($member['image']['url']) ?>"
                        >
                            <img
                                class="people-image"
                                src="<?= esc_url($member['image']['url']) ?>"
                                srcset="<?php echo esc_attr( $srcset ); ?>"
                                alt="<?= esc_attr($member['image']['title']) ?>"
                                width="<?= $member['image']['width'] ?>"
                                height="<?= $member['image']['height'] ?>"
                            >
                            <button class="people-button classic-button">En savoir plus</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="people-popup" id="people-popup" hidden>
            <div class="popup-content">
                <button class="popup-close">&times;</button>
                <img src="" alt="" class="popup-image">
                <h4 class="popup-name"></h4>
                <p class="popup-description"></p>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?>
