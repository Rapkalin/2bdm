const behavior_menu = {
    init() {
        const menuItems = document.querySelectorAll('.menu-item.has-children');
        const expandedNavigation = document.querySelector('.expanded-navigation');
        const expandedSections = document.querySelectorAll('.expanded-menu-section');

        // Masquer toutes les sections au chargement
        expandedSections.forEach(section => {
            section.style.display = 'none';
        });

        // Gérer le survol des éléments de menu
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const menuIndex = this.getAttribute('data-menu-index');
                const sectionToShow = document.querySelector(`.expanded-menu-section[data-menu-index="${menuIndex}"]`);

                // Masquer toutes les sections
                expandedSections.forEach(section => {
                    section.style.display = 'none';
                });

                // Afficher la section correspondante
                if (sectionToShow) {
                    sectionToShow.style.display = 'block';
                }
            });
        });

        // Masquer toutes les sections quand on quitte le menu
        document.querySelector('#header-main').addEventListener('mouseleave', function() {
            expandedSections.forEach(section => {
                section.style.display = 'none';
            });
        });
    }
};
export default behavior_menu;
