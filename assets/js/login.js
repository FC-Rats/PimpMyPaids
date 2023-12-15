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
        var toast2 = new bootstrap.Toast(toastElement2, {
            autohide: false,
        });
        toast2.show();
    }
    var toastElement3 = document.querySelector(".toast.toastThird");
    if (toastElement3) {
        var toast3 = new bootstrap.Toast(toastElement3, {
            autohide: false,
        });
        toast3.show();
    }
    var toastElement4 = document.querySelector(".toast.toastFourth");
    if (toastElement4) {
        var toast4 = new bootstrap.Toast(toastElement4, {
            autohide: false,
        });
        toast4.show();
    }
    if (nbAttemptsCo <= 0) {
        $('#submit-login-button').prop('disabled', true);
    }
});
