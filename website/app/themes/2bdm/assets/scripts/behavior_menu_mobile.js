const behavior_menu_mobile = {
    init() {
        // Vérifier si c'est un appareil mobile
        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Supprimer les menus desktop en mobile
        function optimizeDOMForMobile() {
            if (isMobile()) {
                const desktopMenus = document.querySelector('.desktop-menus');
                if (desktopMenus) {
                    desktopMenus.remove();
                }
            }
        }

        // Exécuter au chargement et au redimensionnement
        optimizeDOMForMobile();
        window.addEventListener('resize', optimizeDOMForMobile);

        // Le reste de votre code JavaScript pour le menu mobile
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileNavigation = document.querySelector('.mobile-navigation');

        if (!mobileNavigation) return;

        // Récupérer les données du menu de manière sécurisée
        let menuData = [];
        try {
            const menuItemsAttr = mobileNavigation.getAttribute('data-menu-items');
            if (menuItemsAttr) {
                menuData = JSON.parse(menuItemsAttr);
                console.log('parsdd data', menuData);
            }
        } catch (e) {
            console.error("Erreur lors du parsing des données du menu:", e);
        }

        const mobileMenuItems = document.querySelectorAll('.mobile-menu-item.has-children');

        if (mobileMenuButton && mobileNavigation) {
            mobileMenuButton.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileNavigation.classList.toggle('active');

                // Animation du burger
                const burgerIcon = this.querySelector('.burger-icon');
                if (burgerIcon) {
                    burgerIcon.classList.toggle('active');
                }
            });
        }

        // Gestion des éléments avec enfants
        if (mobileMenuItems) {
            mobileMenuItems.forEach(item => {
                const title = item.querySelector('.mobile-menu-item-title');

                if (title) {
                    title.addEventListener('click', function(e) {
                        e.preventDefault();
                        const menuIndex = item.getAttribute('data-menu-index');
                        const menuLevel = parseInt(item.getAttribute('data-level')) + 1;
                        showSubmenu(menuIndex, menuLevel, menuData);
                    });
                }
            });
        }

        // Fonction pour afficher un sous-menu
        function showSubmenu(menuIndex, level, menuData) {
            if (!menuData || !menuData[menuIndex]) return;

            const menuItem = document.querySelector(`.mobile-menu-item[data-menu-index="${menuIndex}"]`);
            if (!menuItem) return;

            const menuTitle = menuItem.querySelector('.mobile-menu-item-title').textContent;
            const currentItem = menuData[menuIndex];

            // Récupérer le conteneur du niveau
            const levelContainer = document.querySelector(`.mobile-menu-level[data-level="${level}"]`);
            if (!levelContainer) return;

            // Vider le conteneur
            levelContainer.innerHTML = '';

            // Ajouter un bouton retour
            const backButton = document.createElement('div');
            backButton.className = 'mobile-back-button';
            backButton.innerHTML = `
                <span class="arrow">←</span>
                <span>${menuTitle}</span>
            `;
            backButton.addEventListener('click', function() {
                hideSubmenu(level);
            });
            levelContainer.appendChild(backButton);

            // Ajouter les sous-éléments
            for (const [label, child] of Object.entries(currentItem.children)) {
                const submenuItem = document.createElement('div');
                submenuItem.className = 'mobile-submenu-section';

                const subtitle = document.createElement('div');
                subtitle.className = 'mobile-subtitle';
                subtitle.textContent = label;

                submenuItem.appendChild(subtitle);

                if (Array.isArray(child)) {
                    const tagsContainer = document.createElement('div');
                    tagsContainer.className = 'mobile-tags-container';

                    child.forEach(tag => {
                        const tagItem = document.createElement('a');
                        tagItem.className = 'mobile-child-item';
                        tagItem.href = currentItem.url + '?filter=' + tag.slug;
                        tagItem.textContent = tag.name;
                        tagsContainer.appendChild(tagItem);
                    });

                    subtitle.addEventListener('click', function() {
                        tagsContainer.classList.toggle('active');
                    });

                    submenuItem.appendChild(tagsContainer);
                } else {
                    subtitle.addEventListener('click', function() {
                        window.location.href = currentItem.url;
                    });
                    subtitle.style.cursor = 'pointer';
                }

                levelContainer.appendChild(submenuItem);
            }

            // Afficher le niveau
            levelContainer.style.display = 'flex';
            document.querySelector(`.mobile-menu-level[data-level="${level-1}"]`).style.transform = 'translateX(-100%)';
        }

        // Fonction pour masquer un sous-menu
        function hideSubmenu(level) {
            document.querySelector(`.mobile-menu-level[data-level="${level}"]`).style.display = 'none';
            document.querySelector(`.mobile-menu-level[data-level="${level-1}"]`).style.transform = 'translateX(0)';
        }
    }
};
export default behavior_menu_mobile;
