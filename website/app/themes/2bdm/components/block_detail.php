<?php $type = $args['type']; ?>
<?php foreach ($args['content'] as $i => $detail): ?>
    <?php $isLastKey = array_key_last($args['content']) === $i; ?>
    <!-- BEGIN We open the div -->
    <?php if ($i % 2 === 0): ?><div
        class="row-container row-<?= $type ?> <?= ($type === 'list' && array_key_first($args['content']) === $i) ? 'row-list-first' : '' ?>"
        ><?php endif; ?>
        <!-- END We open the div -->

        <!-- BEGIN We display the selected content type: paragraph or list -->
        <div class="content"><?= $detail["{$type}_item"] ?></div>
        <!-- END We display the selected content type: paragraph or list -->

        <!-- BEGIN We close the div -->
        <?php if (($i % 2 !== 0) || $isLastKey): ?></div><?php endif; ?>
    <!-- END We close the div -->
<?php endforeach; ?>
