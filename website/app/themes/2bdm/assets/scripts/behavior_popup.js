const behavior_popup = {
    init() {
        const accordionTitles = document.querySelectorAll('.accordion-title');

        accordionTitles.forEach(title => {
            title.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.accordion-icon');
                const isOpen = !content.classList.contains('closed');

                if (isOpen) {
                    content.classList.add('closed');
                    icon.textContent = '+';
                } else {
                    content.classList.remove('closed');
                    icon.textContent = '-';
                }
            });
        });

        const peopleDetails = document.querySelectorAll('.popup-active');

        peopleDetails.forEach((person, id) => {
            const popup = document.getElementById('people-popup-' + id);
            const popupClose = popup.querySelector('.popup-close');

            popupClose.addEventListener('click', function() {
                popup.hidden = true;
            });

            // Close popup if we click outside
            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    popup.hidden = true;
                }
            });

            person.addEventListener('click', function(e) {
                if (e.target.classList.contains('people-button') || e.target.classList.contains('people-image')) {
                    popup.hidden = false;
                }
            });
        });
    }
};

export default behavior_popup;
