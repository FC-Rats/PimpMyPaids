$(document).ready(function () {
    $("#nbLineByPage").on("input", function () {
        console.log("Contenu de l'input nbLineByPage : " + $(this).val());
    });
    $("#pageToShow").on("input", function () {
        console.log("Contenu de l'input pageToShow : " + $(this).val());
    });
});