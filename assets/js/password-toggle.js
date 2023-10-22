document.addEventListener("DOMContentLoaded", function () {

    function togglePasswordField(inputElement, toggleButton) {
        toggleButton.addEventListener("mousedown", function () {
            inputElement.type = "text";
        });

        toggleButton.addEventListener("mouseup", function () {
            inputElement.type = "password";
        });

        toggleButton.addEventListener("mouseout", function () {
            inputElement.type = "password";
        });
    }

    const passwordInput = document.getElementById("password");
    togglePasswordField(passwordInput, document.getElementById("toggle-password"));
});
