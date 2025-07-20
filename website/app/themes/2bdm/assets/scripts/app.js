import css from "../styles/app.scss" // This loads the css even though it is not use here do not remove it
import behavior_intro from "./behavior_intro";
import behavior_carousel from "./behavior_carousel";
import behavior_carousel_banner from "./behavior_carousel_banner";
import behavior_accordions from "./behavior_accordions";
import behavior_filter_projects from "./behavior_filter_projects";

console.log('Main JS loaded')

document.addEventListener("DOMContentLoaded", () => {
    const carousel_images = document.querySelectorAll(".carousel-images");
    if (carousel_images.length) {
        behavior_carousel.init();// Carousel init
    }

    const slider = document.querySelectorAll('.slider');
    if (slider.length) {
        behavior_carousel_banner.init(); // Carousel banner init
    }

    const pageContainer = document.querySelectorAll(".projects-container");
    if (pageContainer.length) {
        behavior_accordions.init();
        behavior_filter_projects.init();
    }

    const intro_container = document.querySelectorAll(".intro-container");
    if (intro_container.length) {
        behavior_intro.init()
    }
});