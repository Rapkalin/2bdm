const behavior_accordions = {
    init() {
        const accordions = document.querySelectorAll('.fc-accordion-label');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const content = document.querySelector(targetId);
                const contentMobile = document.querySelector(targetId + '-mobile');
                const iconPlus = this.querySelector('.icon-plus');
                const iconMinus = this.querySelector('.icon-minus');

                // Close all accordions
                document.querySelectorAll('.accordion-content, .accordion-content-mobile').forEach(acc => {
                    if (acc !== content && acc !== contentMobile) {
                        acc.classList.remove('accordion-active');
                    }
                });

                // Toggle - icon to + icon if any other accordion is clicked
                document.querySelectorAll('.fc-accordion-label').forEach(otherAccordion => {
                    if (otherAccordion !== this) {
                        const otherIconPlus = otherAccordion.querySelector('.icon-plus');
                        const otherIconMinus = otherAccordion.querySelector('.icon-minus');
                        otherIconPlus.style.display = 'block';
                        otherIconMinus.style.display = 'none';
                    }
                });
                
                // Basculer l'état de l'accordéon cliqué
                if (window.innerWidth <= 780) {
                    // Version mobile

                    // Open the clicked accordion
                    contentMobile.classList.toggle('accordion-active');
                    if (contentMobile.classList.contains('accordion-active')) {
                        iconPlus.style.display = 'none';
                        iconMinus.style.display = 'block';
                    } else {
                        iconPlus.style.display = 'block';
                        iconMinus.style.display = 'none';
                    }
                } else {
                    // Version desktop

                    // Open the clicked accordion
                    content.classList.toggle('accordion-active');
                    if (content.classList.contains('accordion-active')) {
                        iconPlus.style.display = 'none';
                        iconMinus.style.display = 'block';
                    } else {
                        iconPlus.style.display = 'block';
                        iconMinus.style.display = 'none';
                    }
                }
            });
        });
    }
};
export default behavior_accordions;
