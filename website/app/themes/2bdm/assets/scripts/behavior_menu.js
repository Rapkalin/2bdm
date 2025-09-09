const behavior_menu = {
    init() {
        const menuItems = document.querySelectorAll('.menu-item.has-children');
        const expandedSections = document.querySelectorAll('.expanded-menu-section');
        const sideDiv = document.querySelector('.side-title');

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

                const menuIndex = this.getAttribute('data-menu-index');
                const sectionToShow = document.querySelector(`.expanded-menu-section[data-menu-index="${menuIndex}"]`);
                const menuItemTitle = this.querySelector('.menu-item-title').textContent;
                item.classList.add('active')

                // Hide all menu sections
                expandedSections.forEach(section => {
                    section.style.display = 'none';
                });

                // Update the div .side
                sideDiv.textContent = menuItemTitle;

                // Display the hovered menu section
                if (sectionToShow) {
                    sectionToShow.style.display = 'flex';
                }
            });
        });

        const headerMainElement = document.querySelector('#header-main');
        const headerContainerElement = document.querySelector('#header-container');
        const navigationElement = document.querySelector('#navigation');

        navigationElement.addEventListener('mouseenter', function() {
            headerContainerElement.classList.add('active')
        });

        navigationElement.addEventListener('mouseleave', function() {
            headerContainerElement.classList.remove('active')
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
