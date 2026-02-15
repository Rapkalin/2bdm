<div class="section-block-addresses <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
    <?php foreach (get_addresses() as $address): ?>
        <div class="address-wrapper">
            <h4 class="no-numbers-animation address-title"><?= $address['title'] ?></h4>
            <div class="address-description">
                <p class="no-numbers-animation"><?= $address['address'] ?></p>
                <p class="no-numbers-animation "><?= $address['zipcode'] ?></p>
                <p class="no-numbers-animation strong"><?= $address['phone_number'] ?></p>
                <p class="no-numbers-animation strong"><?= $address['email'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>