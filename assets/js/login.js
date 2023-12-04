$(function () {
    console.log(nbAttemptsCo);
    if (nbAttemptsCo == 1) {
        var toastElement = document.querySelector(".toast.toastAlert");

        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement, {
                autohide: false,
            });
            toast.show();
        }
    } else if (nbAttemptsCo <= 0) {
        var toastElement = document.querySelector(".toast.toastQuit");

        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement, {
                autohide: false,
            });
            toast.show();
        }
        $('#submit-login-button').prop('disabled', true);
    } else if (nbAttemptsCo == 2) {
        var toastElement = document.querySelector(".toast.toasFirst");
        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement, {
                autohide: false,
            });
            toast.show();
        }
    }
});
