const accordions_behavios = {
    init() {
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const content = document.querySelector(targetId);

                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });
    }
};

export default accordions_behavios;
