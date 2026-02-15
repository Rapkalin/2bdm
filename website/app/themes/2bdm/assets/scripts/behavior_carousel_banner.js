const behavior_carousel_banner = {
    init() {
        const slides = document.querySelectorAll('.slide');
        const prevButtons = document.querySelectorAll('.prev-slide');
        const nextButtons = document.querySelectorAll('.next-slide');
        const hbBottoms = document.querySelectorAll('.hb-bottom');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');

            hbBottoms.forEach(bottom => bottom.classList.remove('hb-active'));
            hbBottoms[index].classList.add('hb-active');
        }

        prevButtons.forEach(prevButton => prevButton.addEventListener('click', function(e) {
                e.preventDefault();
                currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
                showSlide(currentSlide);
            })
        );

        nextButtons.forEach(nextButton => nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
                showSlide(currentSlide);
            })
        );

        // Show the first slide initially
        showSlide(currentSlide);
    }
}

export default behavior_carousel_banner;
