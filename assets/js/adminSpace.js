var login = "";
var siren = "";
var companyName = "";
var firstName = "";
var lastName = "";
var email = "";
var currency = "";
var password = "";

$(function () {
    $("#addMerchant").on("click", function () {
        fetchDataForm();
        addAccount();
    });
});

function fetchDataForm() {
    login = $('#login').val();
    siren = $('#siren').val();
    companyName = $('#companyName').val();
    firstName = $('#firstName').val();
    lastName = $('#lastName').val();
    email = $('#email').val();
    currency = $('#currency').val();
    password = $('#password').val();
}

function deleteDataForm() {
    $('#login').val('');
    $('#siren').val('');
    $('#companyName').val('');
    $('#firstName').val('');
    $('#lastName').val('');
    $('#email').val('');
    $('#currency').val('');
    $('#password').val('');
}

function addAccount() {
    $.ajax({
        url: "includes/addMerchant.php",
        type: "POST",
        dataType: "JSON",
        data: { "login": login, "siren": siren, "firstName": firstName, "lastName": lastName, "companyName": companyName, "email": email, "currency": currency, "password": password },
        success: function (data) {
            var result = data.AddMerchant;
            console.log(result);
            var modal = new bootstrap.Modal(document.getElementById("modalAddMerchant"));
            modal.show();
            deleteDataForm();
            $('#modalAddMerchant').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function deleteCustomer(login) {
    $.ajax({
        url: "includes/deleteMerchant.php",
        type: "POST",
        dataType: "JSON",
        data: { "login": login },
        success: function (data) {
            console.log(data.DeleteMerchant);
            var modal = new bootstrap.Modal(document.getElementById("modalDeleteMerchant"));
            modal.show();
            $('#modalDeleteMerchant').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function (data) {
            console.log(data);
        },
    });
}