    </div>

    <div id="footer-container" class="main-wrapper">
        <div id="footer-logo">
            <?php $imageData = getimagesize(get_template_directory() . '/assets/images/' . '2BDM_white.webp'); ?>
            <a href="<?= home_url('/'); ?>">
                <img
                    src="<?= asset('logo-white.svg') ?>"
                    alt="2BDM ARCHITECTURE LOGO"
                    width="<?= $imageData[0] ?>"
                    height="<?= $imageData[1] ?>"
                >
            </a>
        </div>

        <div class="section-block-addresses">
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

        <div class="footer-navigation">
            <nav id="footer-main-navigation">
                <ul class="menu-content">
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-menu',
                        'menu_id' => 'footer-menu',
                        'items_wrap' => '%3$s',
                        'container' => false
                    ]); ?>
                </ul>
            </nav>
            <nav id="footer-social-media-navigation">
                <ul class="menu-content">
                    <?php wp_nav_menu([
                        'theme_location' => 'social-menu',
                        'menu_id' => 'social-menu',
                        'items_wrap' => '%3$s',
                        'container' => false
                    ]); ?>
                </ul>
            </nav>
        </div>

        <div class="footer-legal">
            <div>© 2025 2BDM architectes</div>
            <nav id="footer-legal-navigation">
                <ul class="menu-content">
                    <?php wp_nav_menu([
                        'theme_location' => 'legal-menu',
                        'menu_id' => 'legal-menu',
                        'items_wrap' => '%3$s',
                        'container' => false
                    ]); ?>
                </ul>
            </nav>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>