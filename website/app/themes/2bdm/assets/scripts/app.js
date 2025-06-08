import css from "../styles/app.scss"
import cookies from "./cookies";
import carousel from "./carousel";

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

// Carrousel init
document.addEventListener("DOMContentLoaded", () => {
    carousel.init();
});
