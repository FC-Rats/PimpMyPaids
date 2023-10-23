document.addEventListener("DOMContentLoaded", function () {
    const stayConnectedCheckbox = document.getElementById("stayConnected");
    
    stayConnectedCheckbox.addEventListener("change", function () {
        if (stayConnectedCheckbox.checked) {
            stayConnectedCheckbox.value = "1";
        } else {
            stayConnectedCheckbox.value = "0";
        }
    });
});
