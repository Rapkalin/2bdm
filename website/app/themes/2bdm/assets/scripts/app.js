import css from "../styles/app.scss" // This loads the css even though it is not use here do not remove it
import behavior_cookies from "./behavior_cookies";
import behavior_carousel from "./behavior_carousel";
import behavior_carousel_banner from "./behavior_carousel_banner";
import behavior_accordions from "./behavior_accordions";
import behavior_filter_projects from "./behavior_filter_projects";

console.log('Main JS loaded')
let intro = behavior_cookies.getCookie("intro");

if (!intro) {
    setTimeout(function () {
            document.getElementById("intro-mask").style.clipPath = "circle(100%)";
        }, 1400
    )

    // Make intro mask disappear in circle while fading
    setTimeout(function () {
            document.getElementById("intro-start").remove();
            let el = document.getElementById("intro-mask");
            el.style.transform = "translate(0, -200%)"; // Make intro mask disappear in circle
            setTimeout(function () {
                el.remove()
            }, 1000)
        }, 2900
    )

    behavior_cookies.setCookie("intro", true, 1);
}

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
});