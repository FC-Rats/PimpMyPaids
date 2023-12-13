var login = "";
var siren = "";
var companyName = "";
var firstName = "";
var lastName = "";
var email = "";
var currency = "";
var comment = "";

$(function () {
    $("#addRequestPo").on("click", function () {
        fetchDataForm("add");
        addAccount();
    });

    $("#deleteRequestPo").on("click", function () {
        fetchDataForm("delete");
        deleteAccount();
    });
});

function fetchDataForm(type) {
    if (type == "add") {
        siren = $('#siren').val();
        firstName = $('#firstName').val();
        lastName = $('#lastName').val();
        email = $('#email').val();
        currency = $('#currency').val();
    }
    login = $('#login').val();
    companyName = $('#companyName').val();
    comment = $('#comment').val();
}

function deleteDataForm() {
    $('#siren').val('');
    $('#firstName').val('');
    $('#lastName').val('');
    $('#email').val('');
    $('#currency').val('');
    $('#login').val('');
    $('#companyName').val('');
    $('#comment').val('');
}

function addAccount() {
    $.ajax({
        url: "includes/addMerchant.php",
        type: "POST",
        dataType: "JSON",
        data: { "login": login, "siren": siren, "companyName": companyName, "firstName": firstName, "lastName": lastName, "email": email, "currency": currency, "comment": comment },
        success: function (data) {
            var result = data.AddMerchant;
            console.log(result);
            var modal = new bootstrap.Modal(document.getElementById("modalAddMerchant"));
            modal.show();
            deleteDataForm();
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function deleteAccount() {
    $.ajax({
        url: "includes/deleteMerchant.php",
        type: "POST",
        dataType: "JSON",
        data: { "login": login, "companyName": companyName, "comment": comment },
        success: function (data) {
            var result = data.DeleteMerchant;
            console.log(result);
            var modal = new bootstrap.Modal(document.getElementById("modalDeleteMerchant"));
            modal.show();
            deleteDataForm();
        },
        error: function (data) {
            console.log(data);
        },
    });
}