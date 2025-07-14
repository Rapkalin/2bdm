const load_more_projects = {
    init() {
        const button = document.getElementById('load-more');
        if (button) {
            button.addEventListener('click', this.handleClick);
        }
    },

    handleClick() {
        const button = document.getElementById('load-more');
        const button_wrapper = document.querySelector('.button-load-more');
        button.textContent = 'Chargement...';

        // We display the Button load more projects only if there are more than 4 projects left
        let projects_max = parseInt(button.getAttribute('data-projects-left')) - 4;
        let page = parseInt(button.getAttribute('data-page')) + 1;
        let ajaxUrl = button.getAttribute('data-url');

        fetch(ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'load_more_projects',
                paged: page,
            }),
        })
        .then(response => response.text())
        .then(response => {
            button.setAttribute('data-page', page);
            button.setAttribute('data-projects-left', projects_max);
            document.querySelector('.projects-container').insertAdjacentHTML('beforeend', response);
            button.textContent = 'Voir plus de projets';

            if (projects_max < 5) {
                // We remove the button from the DOM
                button_wrapper.remove();
            }

        })
        .catch(error => {
            console.error('Error:', error);
            button.textContent = 'Erreur de chargement';
        });
    }
};

export default load_more_projects;