const behavior_carousel = {
    init() {
        const track = document.querySelector(".carousel-track");
        const prevBtn = document.querySelector(".carousel-prev");
        const nextBtn = document.querySelector(".carousel-next");
        const slides = document.querySelectorAll(".carousel-slide");

        if (!track || slides.length === 0) return;

        let currentIndex = 0;

        // Fonction pour faire trembler la navigation
        const shakeNavigation = () => {
            if (carouselNav) {
                carouselNav.classList.add('shake');
                setTimeout(() => {
                    carouselNav.classList.remove('shake');
                }, 2500);
            }
        };

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

        // Détecter quand la section du carrousel est visible
        const carouselSection = document.querySelector('.carousel-images');
        const carouselNav = document.querySelector('.carousel-nav');

        // Trigger animation when section is visible in viewport
        if (carouselSection && carouselNav) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(shakeNavigation, 1000); // 1 seconde après que la section soit visible
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(carouselSection);
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

export default behavior_carousel;
