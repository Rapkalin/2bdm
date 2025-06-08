<?php if (have_rows('table_content')): ?>
    <div class="table-content">
        <?php while( have_rows('table_content') ) : the_row(); ?>
            <div class="tc-wrapper">
                <div class="tc-title"><?= get_sub_field('title'); ?></div>

                <div class="tc-description">
                    <?= get_sub_field('description'); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif ?>

