const behavior_filter_projects = {
    init() {
        const childTerms = document.querySelectorAll('.child-term');
        const loadMoreButton = document.getElementById('load-more');
        const projectsContainer = document.querySelector('.projects-container');

        let selectedTerms = [];
        let currentPage = 1;

        // Check if url contains filters
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter');

        if (filterParam) {
            // Find the corresponding term
            const termElement = Array.from(childTerms).find(term => {
                return term.getAttribute('data-term-slug') === filterParam;
            });

            if (termElement) {
                const termId = termElement.getAttribute('data-term-id');
                selectedTerms = [termId];
                termElement.classList.add('selected');
            }
        }

        childTerms.forEach(term => {
            term.addEventListener('click', function() {
                const termId = this.getAttribute('data-term-id');
                const termSlug = this.getAttribute('data-term-slug');

                if (selectedTerms.includes(termId)) {
                    selectedTerms = selectedTerms.filter(id => id !== termId);
                    this.classList.remove('selected');
                } else {
                    selectedTerms.push(termId);
                    this.classList.add('selected');

                    // Update url with filter
                    const newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('filter', termSlug);
                    window.history.pushState({}, '', newUrl);
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
