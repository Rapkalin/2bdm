const behavior_carousel = {
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

        // Detect when carrousel section is visible
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

        // Function to shake the bottom navigation icon
        const shakeNavigation = () => {
            if (carouselNav) {
                carouselNav.classList.add('shake');
                setTimeout(() => {
                    carouselNav.classList.remove('shake');
                }, 2500);
            }
        };
    }
};

export default behavior_carousel;
