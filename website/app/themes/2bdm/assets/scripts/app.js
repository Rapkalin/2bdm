import css from "../styles/app.scss"
import cookies from "./cookies";
import carousel from "./carousel";
import carousel_banner from "./carousel_banner";

console.log('Main JS loaded')
let intro = cookies.getCookie("intro");

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

    cookies.setCookie("intro", true, 1);
}

document.addEventListener("DOMContentLoaded", () => {
    carousel.init();// Carousel init
    carousel_banner.init(); // Carousel banner init
});