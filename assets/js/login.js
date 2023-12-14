$(function () {
    var toastElement = document.querySelector(".toast.toastFirst");
    if (toastElement) {
        var toast = new bootstrap.Toast(toastElement, {
            autohide: false,
        });
        toast.show();
    }
    var toastElement2 = document.querySelector(".toast.toastSecond");
    if (toastElement2) {
        var toast1 = new bootstrap.Toast(toastElement2, {
            autohide: false,
        });
        toast2.show();
    }
    if (nbAttemptsCo <= 0) {
        $('#submit-login-button').prop('disabled', true);
    }
});
