const behavior_accordions = {
    init() {
        const accordions = document.querySelectorAll('.fc-accordion-label');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const content = document.querySelector(targetId);

                // Close all accordions
                document.querySelectorAll('.accordion-content').forEach(acc => {
                    if (acc !== content) {
                        acc.classList.remove('accordion-active');
                    }
                });

                // Open the clicked accordion
                content.classList.toggle('accordion-active');
            });
        });
    }
};
export default behavior_accordions;
