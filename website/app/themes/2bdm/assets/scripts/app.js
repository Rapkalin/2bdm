import css from "../styles/app.scss"

console.log('Main JS loaded')

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
