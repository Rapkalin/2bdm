const behavior_filter_articles = {
    init() {
        const terms = document.querySelectorAll('.filter-term');
        const loadMoreButton = document.getElementById('load-more');
        const articlesContainer = document.querySelector('.next-articles-container');

        let selectedTerms = [];
        let currentPage = 1;

        terms.forEach(term => {
            console.log('term solo', term);
            term.addEventListener('click', function() {
                console.log('this', this.getAttribute('data-term-id'));
                const termId = this.getAttribute('data-term-id');

                if (termId === 'all') {
                    selectedTerms = [];
                    terms.forEach(t => t.classList.remove('selected'));
                    this.classList.add('selected');
                } else {
                    if (selectedTerms.includes(termId)) {
                        selectedTerms = selectedTerms.filter(id => id !== termId);
                        this.classList.remove('selected');
                    } else {
                        selectedTerms.push(termId);
                        this.classList.add('selected');
                    }
                    document.querySelector('.filter-term[data-term-id="all"]').classList.remove('selected');
                }

                currentPage = 1; // Reset to first page on new filter
                fetchArticles(selectedTerms, currentPage);
            });
        });

        console.log('load more', loadMoreButton);
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                currentPage++;
                fetchArticles(selectedTerms, currentPage);
            });
        }

        function fetchArticles(terms, page) {
            const ajaxUrl = loadMoreButton.getAttribute('data-url');
            let body = {
                action: 'load_more_or_filtered_articles',
                paged: page,
            }

            // We send the terms only if there are in the request
            if (terms.length) {
                body.terms = terms.join(',');
            } else {
                body.terms = 'all';
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
                        articlesContainer.innerHTML = data.articles_html;
                    } else {
                        articlesContainer.insertAdjacentHTML('beforeend', data.articles_html);
                    }

                    if (data.remaining_articles < 0) {
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

export default behavior_filter_articles;
