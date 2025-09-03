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

        <div class="footer-addresses">
            <div class="ft-wrapper">
                <h4 class="ft-title">Paris</h4>
                <div class="ft-description">
                    <p>60 · 62, rue d’Hauteville</p>
                    <p>75010 Paris</p>
                    <p class="strong">+33 1 42 26 76 10</p>
                    <p class="strong">contact@2bdm.fr</p>
                </div>
            </div>
            <div class="ft-wrapper">
                <h4 class="ft-title">Versailles</h4>
                <div class="ft-description">
                    <p>Château de Versailles · Aile des Ministres Nord </p>
                    <p>RP834 · 78008 Versailles</p>
                    <p class="strong">+33 1 30 83 74 10</p>
                    <p class="strong">versailles@2bdm.fr</p>
                </div>
            </div>
            <div class="ft-wrapper">
                <h4 class="ft-title">Grand Est</h4>
                <div class="ft-description">
                    <p>81, rue Théodore Deck</p>
                    <p>68500 Guebwiller</p>
                    <p class="strong">+33 3 89 31 44 67</p>
                    <p class="strong">grandest@2bdm.fr</p>
                </div>
            </div>
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