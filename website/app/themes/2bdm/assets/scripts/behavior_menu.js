const behavior_menu = {
    init() {
        const menuItems = document.querySelectorAll('.menu-item');
        const expandedSections = document.querySelectorAll('.expanded-menu-section-container');
        const defaultMenuItem = document.querySelectorAll('.menu-item.has-children')[0];

        // Hide all section when menu is loaded
        expandedSections.forEach(section => {
            section.style.display = 'none';
        });

        // Handle menu hover
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {

                // We remove active class on all items
                menuItems.forEach(item => {
                    item.classList.remove('active');
                })

                // We add the active class on the current element
                item.classList.add('active')

                // Hide all menu sections
                expandedSections.forEach(section => {
                    section.style.display = 'none';
                });

                /*
                 * If item has children we display the corresponding expended menu
                 * If not we display the first expanded menu that has children
                 */
                if (item.classList.contains('has-children')) {
                    const menuIndex = this.getAttribute('data-menu-index');
                    const sectionToShow = document.querySelector(`.expanded-menu-section-container[data-menu-index="${menuIndex}"]`);

                    // Display the hovered menu section
                    if (sectionToShow) {
                        sectionToShow.style.display = 'grid';
                    }
                } else {
                    const defaultMenuIndex = defaultMenuItem.getAttribute('data-menu-index');
                    const defaultSectionToShow = document.querySelector(`.expanded-menu-section-container[data-menu-index="${defaultMenuIndex}"]`);

                    // Display the default menu section
                    if (defaultSectionToShow) {
                        defaultSectionToShow.style.display = 'grid';
                    }
                }
            });
        });

        const headerMainElement = document.querySelector('#header-main');
        const headerContainerElement = document.querySelector('#header-container');
        const navigationElement = document.querySelector('#navigation');

        navigationElement.addEventListener('mouseenter', function() {
            headerContainerElement.classList.add('active');
            headerContainerElement.style.pointerEvents = 'auto'
        });

        headerContainerElement.addEventListener('mouseleave', function() {
            headerContainerElement.classList.remove('active');
            headerContainerElement.style.pointerEvents = 'none'
        });

        // Hide all menu sections if user leave hover menu
        headerMainElement.addEventListener('mouseleave', function() {
            expandedSections.forEach(section => {
                section.style.display = 'none';
            });
        });
    }
};
export default behavior_menu;
