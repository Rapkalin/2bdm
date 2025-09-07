const behavior_menu = {
    init() {
        const menuItems = document.querySelectorAll('.menu-item.has-children');
        const expandedSections = document.querySelectorAll('.expanded-menu-section');
        const sideDiv = document.querySelector('.site-title');

        // Masquer toutes les sections au chargement
        expandedSections.forEach(section => {
            section.style.display = 'none';
        });

        // Gérer le survol des éléments de menu
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const menuIndex = this.getAttribute('data-menu-index');
                const sectionToShow = document.querySelector(`.expanded-menu-section[data-menu-index="${menuIndex}"]`);
                const menuItemTitle = this.querySelector('.menu-item-title').textContent;

                // Masquer toutes les sections
                expandedSections.forEach(section => {
                    section.style.display = 'none';
                });

                // Mettre à jour le contenu de la div .side
                sideDiv.textContent = menuItemTitle;

                // Afficher la section correspondante
                if (sectionToShow) {
                    sectionToShow.style.display = 'flex';
                }
            });
        });

        // Masquer toutes les sections quand on quitte le menu
        document.querySelector('#header-container').addEventListener('mouseleave', function() {
            expandedSections.forEach(section => {
                section.style.display = 'none';
            });
        });
    }
};
export default behavior_menu;
