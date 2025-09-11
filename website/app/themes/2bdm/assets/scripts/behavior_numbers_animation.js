import {CountUp} from 'countup.js';

const behavior_numbers_accordion = {
    init() {
        // Detect number in text
        const textElements = document.querySelectorAll('body *:not(script):not(style):not(noscript):not(.no-numbers-animation)');
        const numberRegex = /\b\d+(\.\d+)?\b/g;

        textElements.forEach(element => {
            if (element.children.length === 0 && element.textContent.trim() !== '') {
                const text = element.textContent.trim();
                const matches = text.match(numberRegex);

                if (matches) {
                    element.innerHTML = text.replace(numberRegex, match => {
                        return `<span class="count-up" data-count="${match}">0</span>`;
                    });
                }
            }
        });

        // Animate number when user scroll
        const countUpElements = document.querySelectorAll('.count-up');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const countTo = parseFloat(element.getAttribute('data-count'));
                    const countUp = new CountUp(element, countTo, {
                        duration: 2,
                        decimalPlaces: countTo % 1 !== 0 ? 2 : 0,
                    });
                    if (!countUp.error) countUp.start();
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.2 }); // Animate when 20% of the viewport is visible

        countUpElements.forEach(element => observer.observe(element));
    }
};
export default behavior_numbers_accordion;
