<section class="section-block-rewards main-wrapper">
    <div class="block-rewards-intro">
        <div class="reward-intro-title">
            <?php get_template_part('components/svg-bullet') ?>
            Récompenses
        </div>
        <div class="reward-intro-description">Une reconnaissance du travail d’excellence, de l’innovation et de l’engagement de l’agence en faveur du patrimoine.</div>
    </div>

    <div class="block-rewards-container">
        <?php foreach (get_sub_field('reward_card') as $card): ?>
            <?php
                $projectCard = $card['reward_project'][0];
                $project = get_fields($projectCard->ID);
                $projectCoverImage = $card['reward_project_image']['url'] ?? $project['header_banner']['image']['url'];
                $projectTitle = $card['reward_project_title'] ?: get_the_title($projectCard->ID);
            ?>

            <div class="block-rewards-card">
                <div class="card-header-container">
                    <img class="card-logo" src="<?= $card['reward_logo']['url'] ?>" alt="card-logo">
                    <div class="card-header">
                        <div class="card-header-title"><?= $card['reward_title'] ?></div>
                        <div class="card-header-category">
                            <?php get_template_part('components/svg-bullet') ?>
                            <?= $card['reward_category'] ?>
                        </div>
                    </div>
                </div>
                <img class="card-image" src="<?= $projectCoverImage ?>" alt="card-image">
                <div class="card-infos">
                    <div class="card-infos-header">
                        <div class="card-infos-header-title"><?= $projectTitle ?></div>
                        <div class="card-infos-header-location">
                            <?php get_template_part('components/svg-bullet') ?>
                            <?= $card['reward_project_location'] ?>
                        </div>
                    </div>
                    <a
                        class="card-button"
                        href="<?= get_permalink($projectCard->ID) ?>"
                    >
                        Voir le projet
                        <?php get_template_part("components/svg-arrow-right") ?>
                    </a>
                    <a href=""></a>
                    <div class="card-description"><?= $card['reward_project_description'] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>