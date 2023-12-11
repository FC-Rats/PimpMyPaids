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
        addAccount().then(function () {
            sendMailAdd();
        });
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
    return new Promise(function (resolve, reject) {
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
                resolve();
            },
            error: function (data) {
                console.log(data);
                reject();
            },
        });
        resolve();
    });
}

function sendMailAdd() {
    $.ajax({
        url: "includes/clientValidation.php",
        type: "POST",
        dataType: "JSON",
        data: { "email": email },
        success: function (data) {
            console.log(data.Result);
        },
        error: function (data) {
            console.log(data);
        },
    });
}