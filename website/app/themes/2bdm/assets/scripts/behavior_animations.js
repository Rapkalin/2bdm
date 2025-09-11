const behavior_animations = {
    init() {
        // Select all elements to animate
        const textElements = document.querySelectorAll(
            'h1, h2, h3, h4, h5, h6, p, a, span, button'
        );

        // Add class to all selected element
        textElements.forEach(element => {
            element.classList.add('fade-up');
        });

        // Config Intersection Observer
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        // Deactive animation when element is visible
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                root: null, // Use viewport as container
                rootMargin: '0px', // No extra marge
                threshold: 0.1 // Trigger when 10% of the element is visible
            }
        );

        // Observe all elements
        textElements.forEach(element => {
            observer.observe(element);
        });
    }
};
export default behavior_animations;
