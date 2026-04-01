const behavior_filter_articles = {
    init() {
        const terms = document.querySelectorAll('.filter-term');
        const loadMoreButton = document.getElementById('load-more');
        const articlesContainer = document.querySelector('.next-articles-container');

        let selectedTerm = 'all';
        let currentPage = 1;

        terms.forEach(term => {
            term.addEventListener('click', function() {
                const termId = this.getAttribute('data-term-id');

                // reset the filter visually
                terms.forEach(t => t.classList.remove('selected'));
                this.classList.add('selected');

                // We can select only one filter
                selectedTerm = termId;

                currentPage = 1;
                fetchArticles(selectedTerm, currentPage);
            });
        });

        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                currentPage++;
                fetchArticles(selectedTerm, currentPage);
            });
        }

        function fetchArticles(term, page) {
            const ajaxUrl = loadMoreButton.getAttribute('data-url');

            let body = {
                action: 'load_more_or_filtered_articles',
                paged: page,
                terms: term // the key name is plural in case we need to go back to multiple selection filter
            };

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

                    if (data.remaining_articles <= 0) {
                        loadMoreButton.style.display = 'none';
                    } else {
                        loadMoreButton.style.display = 'inline-block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
}

export default behavior_filter_articles;