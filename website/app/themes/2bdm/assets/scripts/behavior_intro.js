import behavior_cookies from "./behavior_cookies";

const behavior_intro = {
   init() {
        let intro = behavior_cookies.getCookie("intro");
        let intro_container = document.getElementById("intro-start");

        if (!intro && intro_container) {
            setTimeout(function () {
                    document.getElementById("intro-mask").style.clipPath = "circle(100%)";
                }, 1400
            )

            // Make intro mask disappear in circle while fading
            setTimeout(function () {
                    intro_container.remove();
                    let el = document.getElementById("intro-mask");
                    el.style.transform = "translate(0, -200%)"; // Make intro mask disappear in circle
                    setTimeout(function () {
                        el.remove()
                    }, 1000)
                }, 2900
            )

            behavior_cookies.setCookie("intro", true, 1);
        }
    }
}

export default behavior_intro;
