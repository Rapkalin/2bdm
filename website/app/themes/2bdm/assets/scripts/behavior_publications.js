const behavior_loadmore_publications = {
    init() {
        function setupLoadMore(containerSelector, buttonSelector, itemsPerPage = 6) {
            const container = document.querySelector(containerSelector);
            const button = document.querySelector(buttonSelector);

            if (!container || !button) return;

            const items = Array.from(container.children);
            let visibleCount = itemsPerPage;

            // Hide all publications except the 6 first
            items.forEach((item, i) => {
                if (i >= itemsPerPage) item.style.display = "none";
            });

            // Display the 6 next publications
            if (items.length > itemsPerPage) {
                button.style.display = "block";
            }

            button.addEventListener("click", function () {
                const nextVisible = visibleCount + itemsPerPage;

                items.forEach((item, i) => {
                    if (i < nextVisible) item.style.display = "";
                });

                visibleCount = nextVisible;

                // Hide button if everything is displayed
                if (visibleCount >= items.length) {
                    button.style.display = "none";
                }
            });
        }

        setupLoadMore(".block-publications-cards", ".load-more-cards");
        setupLoadMore(".block-publications-cards-list", ".load-more-list");
    }
};

export default behavior_loadmore_publications;
