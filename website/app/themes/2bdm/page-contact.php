<?php
/**
 * Template Name: Page contact
 *
 * @package WordPress
 */

get_header();
?>
<div class="article-container articles-grid-header-container">
    <div class="articles-grid-title"><?= get_field('title') ?></div>
    <div class="articles-grid-description"><?= get_field('description') ?></div>
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
    <div class="form-group">
        <input
            id="submit-button"
            data-url="<?php echo admin_url('admin-ajax.php'); ?>"
            type="submit"
            value="Envoyer"
        >
    </div>
</form>

<?php

wp_reset_query();
get_footer();
?>
