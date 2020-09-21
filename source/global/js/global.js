$(document).ready(function () {
    $(".button-toggle button").on("click", openToggleMenu)
    $(".li li").on("click", openSubMenu)

    function openToggleMenu() {
        $(".nav-bar").toggleClass("visable");
    }

    function openSubMenu() {
        let path = window.location.pathname;

        if (path.includes("lista-geral")) {
            $("[nav-home]").addClass("nav-home");
        } else {
            $("[nav-home]").removeClass("nav-home");
        }
    }
    openSubMenu()
});
