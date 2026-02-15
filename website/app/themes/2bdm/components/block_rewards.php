<section class="section-block-rewards main-wrapper">
    <div class="block-rewards-intro">
        <div class="reward-intro-title">
            <?php get_template_part('components/svg-bullet') ?>
            <?= get_sub_field('bullet') ?>
        </div>
        <div class="reward-intro-description"><?= get_sub_field('title') ?></div>
    </div>

    <div class="block-rewards-container">
        <?php foreach (get_sub_field('reward_cards') as $card): ?>
            <?php
                $projectCard = $card['reward_project'][0];

                if ($projectCard)  {
                    $project = get_fields($projectCard->ID);
                    $projectCoverImage = $card['reward_project_image']['url'] ?? $project['header_banner']['image']['url'];
                    $projectTitle = $card['reward_project_title'] ?: get_the_title($projectCard->ID);
                } else {
                    $projectCoverImage = $card['reward_project_image']['url'];
                    $projectTitle = $card['reward_project_title'];
                }
            ?>

            <div class="block-rewards-card">
                <div class="card-header-container">
                    <img class="card-logo" src="<?= $card['reward_logo']['url'] ?>" alt="card-logo">
                    <div class="card-header">
                        <div class="no-numbers-animation card-header-title"><?= $card['reward_title'] ?></div>

                        <?php if($card['reward_category']): ?>
                            <div class="card-header-category">
                                <?php get_template_part('components/svg-bullet') ?>
                                <?= $card['reward_category'] ?>
                            </div>
                        <?php endif; ?>
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

                    <?php if ($projectCard): ?>
                        <a class="card-button" href="<?= get_permalink($projectCard->ID) ?>">
                            Voir le projet
                            <?php get_template_part("components/svg-arrow-right") ?>
                        </a>
                    <?php else: ?>
                            Page à venir
                    <?php endif; ?>

                    <div class="card-description"><?= $card['reward_project_description'] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>