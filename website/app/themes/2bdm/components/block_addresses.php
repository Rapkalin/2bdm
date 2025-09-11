<div class="section-block-addresses <?= isset($args['extraClasses']) ? implode(' ', $args['extraClasses']) : '' ?>">
    <?php foreach (get_addresses() as $address): ?>
        <div class="address-wrapper">
            <h4 class="address-title"><?= $address['title'] ?></h4>
            <div class="address-description">
                <p><?= $address['address'] ?></p>
                <p><?= $address['zipcode'] ?></p>
                <p class="strong"><?= $address['phone_number'] ?></p>
                <p class="strong"><?= $address['email'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>