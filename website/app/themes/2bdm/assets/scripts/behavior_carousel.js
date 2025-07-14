const carousel = {
    init() {
        const track = document.querySelector(".carousel-track");
        const prevBtn = document.querySelector(".carousel-prev");
        const nextBtn = document.querySelector(".carousel-next");
        const slides = document.querySelectorAll(".carousel-slide");

        if (!track || slides.length === 0) return;

        let currentIndex = 0;

        const scrollToIndex = (index) => {
            if (index < 0 || index >= slides.length) return;
            const slide = slides[index];
            track.scrollTo({
                left: slide.offsetLeft,
                behavior: "smooth"
            });
            currentIndex = index;
        };

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener(
                "click", (e) => {
                    e.preventDefault();
                    scrollToIndex(currentIndex - 1)
                }
            );

            nextBtn.addEventListener(
                "click", (e) => {
                e.preventDefault();
                scrollToIndex(currentIndex + 1)
            });
        }

        // Drag / swipe
        let isDragging = false,
            startX = 0,
            scrollLeft = 0;

        const startDrag = (x) => {
            isDragging = true;
            startX = x;
            scrollLeft = track.scrollLeft;
        };

        const moveDrag = (x) => {
            if (!isDragging) return;
            const walk = (x - startX) * 1.5;
            track.scrollLeft = scrollLeft - walk;
        };

        const endDrag = () => {
            isDragging = false;
        };

        // Mouse
        track.addEventListener("mousedown", (e) => startDrag(e.pageX));
        track.addEventListener("mousemove", (e) => moveDrag(e.pageX));
        track.addEventListener("mouseup", endDrag);
        track.addEventListener("mouseleave", endDrag);

        // Touch
        track.addEventListener("touchstart", (e) => startDrag(e.touches[0].pageX));
        track.addEventListener("touchmove", (e) => moveDrag(e.touches[0].pageX));
        track.addEventListener("touchend", endDrag);
    }
};

export default carousel;
