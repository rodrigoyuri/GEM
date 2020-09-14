$(document).ready(function () {
    $(".button-toggle button").on("click", openToggleMenu)

    function openToggleMenu () {
        $(".nav-bar").toggleClass("visable");
    }
});
