document.addEventListener("DOMContentLoaded", function () {
  var toastElement = document.querySelector(".toast");

  if (toastElement) {
    var toast = new bootstrap.Toast(toastElement, {
      autohide: false,
    });
    toast.show();
  }
});