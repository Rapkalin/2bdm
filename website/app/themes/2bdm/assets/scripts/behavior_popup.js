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

        const peopleDetails = document.querySelectorAll('.people-details');
        const popup = document.getElementById('people-popup');
        const popupImage = popup.querySelector('.popup-image');
        const popupName = popup.querySelector('.popup-name');
        const popupDescription = popup.querySelector('.popup-description');
        const popupClose = popup.querySelector('.popup-close');

        peopleDetails.forEach(person => {
            person.addEventListener('click', function(e) {
                if (e.target.classList.contains('people-button') || e.target.classList.contains('people-image')) {
                    const name = this.getAttribute('data-name');
                    const description = this.getAttribute('data-description');
                    const image = this.getAttribute('data-image');

                    popupName.textContent = name;
                    popupDescription.textContent = description;
                    popupImage.src = image;
                    popupImage.alt = name;

                    popup.hidden = false;
                }
            });
        });

        popupClose.addEventListener('click', function() {
            popup.hidden = true;
        });

        // Close popup if we click outside
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.hidden = true;
            }
        });

    }
};

export default behavior_popup;
