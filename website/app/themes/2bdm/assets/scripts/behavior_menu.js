const behavior_menu = {
    init() {
        const menuItems = document.querySelectorAll('.menu-item.has-children');
        const expandedNavigation = document.querySelector('.expanded-navigation');

        menuItems.forEach((item, index) => {
            item.addEventListener('mouseenter', function() {
                const expandedSections = document.querySelectorAll('.expanded-menu-section');
                expandedSections.forEach(section => section.style.display = 'none');
                if (expandedSections[index]) {
                    expandedSections[index].style.display = 'block';
                }
            });
        });

        document.querySelector('#header-main').addEventListener('mouseleave', function() {
            const expandedSections = document.querySelectorAll('.expanded-menu-section');
            expandedSections.forEach(section => section.style.display = 'none');
        });
    }
};
export default behavior_menu;
