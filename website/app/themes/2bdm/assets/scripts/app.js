// /!\ CAUTION /!\
// This loads the css even though it is not use here do not remove it
import css from "../styles/app.scss"
// /!\ END OF CAUTION /!\

import behavior_intro from "./behavior_intro";
import behavior_carousel from "./behavior_carousel";
import behavior_carousel_banner from "./behavior_carousel_banner";
import behavior_accordions from "./behavior_accordions";
import behavior_fade_up from "./behavior_fade_up";
import behavior_menu from "./behavior_menu";
import behavior_filter_projects from "./behavior_filter_projects";
import behavior_filter_articles from "./behavior_filter_articles";
import behavior_forms from "./behavior_forms";
import behavior_popup from "./behavior_popup";

console.info('The main JS has been loaded');

document.addEventListener("DOMContentLoaded", () => {
    // Classic carrousel behavior
    const carousel_images = document.querySelectorAll(".carousel-images");
    if (carousel_images.length) {
        behavior_carousel.init();
    }

    // Banner carrousel behavior
    const slider = document.querySelectorAll('.slider');
    if (slider.length) {
        behavior_carousel_banner.init();
    }

    // Filters behavior
    const pageContainer = document.querySelectorAll(".projects-container");
    if (pageContainer.length) {
        behavior_accordions.init();
        behavior_filter_projects.init();
    }

    // Articles behavior
    const terms = document.querySelectorAll('.filter-term');
    if (terms.length) {
        behavior_filter_articles.init();
    }


    // Intro behavior
    const intro_container = document.querySelectorAll(".intro-container");
    if (intro_container.length) {
        behavior_intro.init()
    }

    // Forms behavior
    const form = document.getElementById('dynamic-form');
    if (form) {
        behavior_forms.init();
    }

    const peopleDetails = document.querySelectorAll('.popup-active');
    if (peopleDetails.length) {
        behavior_popup.init();
    }

    const words = document.querySelectorAll('.word');
    if (words) {
        behavior_fade_up.init();
    }

    /* As the menu is on all pages this Behavior is always called */
    behavior_menu.init();
});