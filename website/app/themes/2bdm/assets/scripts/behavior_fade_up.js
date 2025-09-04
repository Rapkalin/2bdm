const behavior_fade_up = {
    init() {
        const words = document.querySelectorAll('.word');

        words.forEach((word, index) => {
            word.style.animationDelay = `${index * 0.6}s`; // Delay between each word
        });
    }
};

export default behavior_fade_up;
