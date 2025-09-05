<?php
/**
 * Template Name: Page contact
 *
 * @package WordPress
 */

get_header(args:['color-logo' => '__grey']);
?>
<div class="contact-container contact-header-container">
    <div class="contact-title"><?= get_field('title') ?></div>
    <div class="contact-description"><?= nl2br(get_field('description')) ?></div>
</div>

<div class="form-wrapper main-wrapper">
    <div class="form-side-container">
        <?php if(have_rows('side_content')): the_row() ?>
            <div class="side-title">
                <?php get_template_part('components/svg-bullet') ?>
                <?= get_sub_field('title') ?>
            </div>
            <div class="side-next side-desktop">
                <div class="next-title">
                    <?php get_template_part('components/svg-bullet') ?>
                    <?= get_sub_field('side_content_bottom')['title'] ?>
                </div>
                <p class="next-description"><?= get_sub_field('side_content_bottom')['description'] ?></p>
            </div>
        <?php endif; ?>
    </div>
    <form id="dynamic-form" method="post">
        <?php // <div class="g-recaptcha" data-sitekey="votre_cle_de_site"></div> ?>
        <?php
        if (have_rows('form')):
            while (have_rows('form')): the_row();
                switch (get_row_layout()):
                    case 'text':
                    case 'email':
                        getFormGroup(
                            get_sub_field('field_type'),
                            ['label' => get_sub_field('text_label')]
                        );
                        break;
                    case 'cities':
                        $cities = get_sub_field('cities');
                        if ($cities) {
                            getFormGroup(
                                'cities',
                                ['label' => get_sub_field('text_label'), 'cities' => $cities]
                            );
                        }
                        break;
                endswitch;
            endwhile;
        endif;
        ?>
        <input
            type="hidden"
            id="email-to"
            name="email_to"
            value="<?= get_field('email_to') ?>"
        >
        <div class="legal-text">
            * Champs obligatoires.  <br>
            Les données collectées sur ce formulaire sont enregistrées afin d'étudier votre demande et de vous répondre.
            Les données sont conservées pendant la durée légale de conservation des données.
            Vous pouvez accéder à vos données, les rectifier, demander leur suppression ou exercer votre droit à la limitation du traitement.
            Pour exercer ces droits ou pour toute question relative au traitement de vos données, vous pouvez nous contacter à l'adresse électronique suivante : <a href="mailto:contact@2bdm.fr">contact@2bdm.fr</a>
        </div>
        <div id="group-submit-button">
            <input
                id="submit-button"
                data-url="<?php echo admin_url('admin-ajax.php'); ?>"
                type="submit"
                value="<?= get_field('submit_label') ?>"
            >
        </div>
    </form>
</div>

<div class="side-next side-mobile">
    <div class="next-title">
        <?php get_template_part('components/svg-bullet') ?>
        <?= get_sub_field('side_content_bottom')['title'] ?>
    </div>
    <p class="next-description"><?= get_sub_field('side_content_bottom')['description'] ?></p>
</div>

<?php

wp_reset_query();
get_footer();
?>
