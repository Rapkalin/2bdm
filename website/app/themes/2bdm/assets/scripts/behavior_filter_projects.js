const behavior_filter_projects = {
    init() {
        const childTerms = document.querySelectorAll('.child-term');
        const loadMoreButton = document.getElementById('load-more');
        const projectsContainer = document.querySelector('.projects-container');

        let selectedTerms = [];
        let currentPage = 1;

        childTerms.forEach(term => {
            term.addEventListener('click', function() {
                const termId = this.getAttribute('data-term-id');

                if (selectedTerms.includes(termId)) {
                    selectedTerms = selectedTerms.filter(id => id !== termId);
                    this.classList.remove('selected');
                } else {
                    selectedTerms.push(termId);
                    this.classList.add('selected');
                }

                currentPage = 1; // Reset to first page on new filter
                fetchProjects(selectedTerms, currentPage);
            });
        });

        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                currentPage++;
                fetchProjects(selectedTerms, currentPage);
            });
        }

        function fetchProjects(terms, page) {
            const ajaxUrl = loadMoreButton.getAttribute('data-url');
            let body = {
                action: 'load_more_or_filtered_projects',
                paged: page,
            }

            // We send the terms only if there are in the request
            if (terms.length) {
                body.terms = terms.join(',');
            }

            fetch(ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(body),
            })
                .then(response => response.json())
                .then(jsonResponse => {
                    const data = jsonResponse.data;
                    console.log('dat', data);
                    if (page === 1) {
                        projectsContainer.innerHTML = data.projects_html;
                    } else {
                        projectsContainer.insertAdjacentHTML('beforeend', data.projects_html);
                    }

                    if (data.remaining_projects < 0) {
                        const button_wrapper = document.querySelector('.button-load-more');
                        // We remove the button from the DOM
                        loadMoreButton.style.display = 'none';
                    } else {
                        loadMoreButton.style.display = 'flex';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
}

export default behavior_filter_projects;
