const behavior_menu_mobile = {
    init() {
        // Check if you are in mobile mode
        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Remove desktop menu when in mobile mode
        function optimizeDOMForMobile() {
            if (isMobile()) {
                const desktopMenus = document.querySelector('.desktop-menus');
                if (desktopMenus) {
                    desktopMenus.remove();
                }
            }
        }

        // Execut and load and resize
        optimizeDOMForMobile();
        window.addEventListener('resize', optimizeDOMForMobile);

        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileNavigation = document.querySelector('.mobile-navigation');

        if (!mobileNavigation) { return }

        // Retrieve the menu data
        let menuData = [];
        try {
            const menuItemsAttr = mobileNavigation.getAttribute('data-menu-items');
            if (menuItemsAttr) {
                menuData = JSON.parse(menuItemsAttr);
            }
        } catch (e) {
            console.error("Error while parsing the menu data:", e);
        }

        const mobileMenuItems = document.querySelectorAll('.mobile-menu-item.has-children');
        const menuItemsContainer = document.querySelector(`.mobile-menu-level[data-level="0"]`);

        if (mobileMenuButton && mobileNavigation) {
            mobileMenuButton.addEventListener('click', function() {
                this.classList.toggle('active');
                this.classList.toggle('color-white');
                mobileNavigation.classList.toggle('active')

                // Prevent body from being scrollable when mobile menu is open
                document.body.classList.toggle('mobile-menu-open');

                // Burger menu animation
                const burgerIcon = this.querySelector('.burger-icon');
                const closeMenuIcon = this.querySelector('.close-icon');
                if (burgerIcon) {
                    burgerIcon.classList.toggle('active');
                    closeMenuIcon.classList.toggle('active');
                }
            });
        }

        // Handle elements with children
        if (mobileMenuItems) {
            mobileMenuItems.forEach(item => {
                const title = item.querySelector('.mobile-menu-item-title');

                if (title) {
                    title.addEventListener('click', function(e) {
                        e.preventDefault();
                        const menuIndex = item.getAttribute('data-menu-index');
                        const menuLevel = parseInt(item.getAttribute('data-level')) + 1;
                        showSubmenu(menuIndex, menuLevel, menuData, item);
                    });
                }
            });
        }

        // Function to display the submenu entries
        function showSubmenu(menuIndex, level, menuData, parentLevel) {
            if (!menuData || !menuData[menuIndex]) { return }

            const menuItem = document.querySelector(`.mobile-menu-item[data-menu-index="${menuIndex}"]`);
            if (!menuItem) { return }

            const currentItem = menuData[menuIndex];

            // Retrieve the menu level container
            const levelContainer = document.querySelector(`.mobile-menu-level[data-level="${level}"]`);
            if (!levelContainer) { return }

            // Empty the container
            levelContainer.innerHTML = '';

            // Add a return button
            const backButton = document.createElement('div');
            backButton.className = 'mobile-back-button';
            backButton.innerHTML = `
                <span>Retour</span>
            `;

            const SideInfo = document.createElement('div');
            SideInfo.className = 'side-info-menu';
            SideInfo.innerHTML = `
                <span class="side-title-menu">${currentItem.title}</span>
            `;

            const headerInfo = document.createElement('div');
            headerInfo.className = 'mobile-menu-header-info';
            headerInfo.appendChild(backButton);
            headerInfo.appendChild(SideInfo);

            backButton.addEventListener('click', function() {
                hideSubmenu(level);
            });

            levelContainer.appendChild(headerInfo);

            // Add sub elements
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
                        tagItem.href = currentItem.url + '?filter=' + tag.slug + '#filters-container'; // scroll to the filtered results block
                        tagItem.textContent = tag.name;

                        // Handle click on tags
                        tagItem.addEventListener('click', function(e) {
                            e.preventDefault();
                            const url = this.getAttribute('href');

                            // Fermer le menu mobile
                            mobileMenuButton.classList.remove('active');
                            mobileNavigation.classList.remove('active');
                            document.body.classList.remove('mobile-menu-open');

                            // Redirect with a delay for the menu to close
                            setTimeout(() => {
                                window.location.href = url;
                            }, 300);
                        });

                        tagsContainer.appendChild(tagItem);
                    });

                    subtitle.addEventListener('click', function() {
                        tagsContainer.classList.toggle('active');
                    });

                    submenuItem.appendChild(tagsContainer);
                } else {
                    const url = currentItem.type === 'pages' ? child.url : (currentItem.type === 'anchors' ? currentItem.url.replace(/.$/, "#") + child : '#');
                    subtitle.addEventListener('click', function() {
                        window.location.href = url;
                    });
                    subtitle.style.cursor = 'pointer';
                }

                levelContainer.appendChild(submenuItem);
            }

            // Hide the level 0 div
            menuItemsContainer.style.display = 'none'

            // display the level
            levelContainer.style.display = 'flex';
            document.querySelector(`.mobile-menu-level[data-level="${level-1}"]`).style.transform = 'translateX(-100%)';

            /* Add the addresses block if menu entry is contact */
            if (currentItem.is_contact) {
                const blockAddresses = document.createElement('div');

                // Retrieve the menu data
                let addressesData = [];
                try {
                    const addressesAttr = parentLevel.getAttribute('data-addresses');
                    if (addressesAttr) {
                        addressesData = JSON.parse(addressesAttr);
                        blockAddresses.className = 'section-block-addresses section__addresses__white';

                        addressesData.forEach(address => {
                            blockAddresses.innerHTML += `<div class="address-wrapper">
                                <h4 class="address-title">${address.title}</h4>
                                <div class="address-description">
                                    <p>${address.address}</p>
                                    <p>${address.zipcode}</p>
                                    <p class="strong">${address.phone_number}</p>
                                    <p class="strong">${address.email}</p>
                                </div>`
                        });

                        levelContainer.appendChild(blockAddresses);
                    }
                } catch (e) {
                    console.error("Error while parsing the menu data:", e);
                }

            }
        }

        // Hide sub menu
        function hideSubmenu(level) {
            document.querySelector(`.mobile-menu-level[data-level="${level}"]`).style.display = 'none';
            document.querySelector(`.mobile-menu-level[data-level="${level-1}"]`).style.transform = 'translateX(0)';
            menuItemsContainer.style.display = 'flex'
        }
    }
};
export default behavior_menu_mobile;
