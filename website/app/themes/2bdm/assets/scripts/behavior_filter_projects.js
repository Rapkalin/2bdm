const behavior_filter_projects = {
    init() {
        const childTerms = document.querySelectorAll('.child-term');
        const loadMoreButton = document.getElementById('load-more');
        const projectsContainer = document.querySelector('.projects-container');
        let selectedTerms = [];
        let currentPage = 1;

        // Check if URL contains filters
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter'); // Récupérer tous les filtres

        // Variable pour savoir si on doit déclencher une mise à jour initiale
        let shouldFetchInitialProjects = false;

        if (filterParam) {
            // Séparer les filtres par virgule
            const filterSlugs = filterParam.split(',');

            // Trouver les termes correspondants
            filterSlugs.forEach(filterSlug => {
                const termElement = Array.from(childTerms).find(term =>
                    term.getAttribute('data-term-slug') === filterSlug
                );

                if (termElement) {
                    const termId = termElement.getAttribute('data-term-id');
                    if (!selectedTerms.includes(termId)) {
                        selectedTerms.push(termId);
                        termElement.classList.add('selected');
                    }
                }
            });

            // Si on a trouvé des termes, on devra déclencher une mise à jour
            if (selectedTerms.length > 0) {
                shouldFetchInitialProjects = true;
            }
        }

        childTerms.forEach(term => {
            term.addEventListener('click', function() {
                const termId = this.getAttribute('data-term-id');
                const isSelected = selectedTerms.includes(termId);

                if (isSelected) {
                    // Désélectionner le terme
                    selectedTerms = selectedTerms.filter(id => id !== termId);
                    this.classList.remove('selected');
                } else {
                    // Sélectionner le terme
                    selectedTerms.push(termId);
                    this.classList.add('selected');
                }

                // Mettre à jour l'URL
                const newUrl = new URL(window.location.href);

                // Add new filters
                if (selectedTerms.length > 0) {
                    const selectedSlugs = selectedTerms.map(termId => {
                        const termElement = Array.from(childTerms).find(t =>
                            t.getAttribute('data-term-id') === termId
                        );
                        return termElement ? termElement.getAttribute('data-term-slug') : '';
                    }).filter(slug => slug !== '');

                    newUrl.searchParams.set('filter', selectedSlugs.join(','));
                } else {
                    // Delete filter param if no term is selected
                    newUrl.searchParams.delete('filter');
                }

                // Update url without reloading current page
                window.history.pushState({}, '', newUrl);

                currentPage = 1; // Reset to first page
                fetchProjects(selectedTerms, currentPage);
            });
        });

        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                currentPage++;
                fetchProjects(selectedTerms, currentPage);
            });
        }

        if (shouldFetchInitialProjects) {
            fetchProjects(selectedTerms, currentPage);
        }

        function fetchProjects(terms, page) {
            const ajaxUrl = projectsContainer.getAttribute('data-url');
            let body = {
                action: 'load_more_or_filtered_projects',
                paged: page,
            }

            // Envoyer les termes seulement s'il y en a dans la requête
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
                    if (page === 1) {
                        projectsContainer.innerHTML = data.projects_html;
                    } else {
                        projectsContainer.insertAdjacentHTML('beforeend', data.projects_html);
                    }
                    if (data.remaining_projects < 0) {
                        const button_wrapper = document.querySelector('.button-load-more');
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
