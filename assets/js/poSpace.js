var login = "";
var siren = "";
var companyName = "";
var email = "";
var currency = "";
var comment = "";

$(function () {
    $("#addRequestPo").on("click", function () {
        fetchDataForm("add");
        addAccount().then(function () {
            sendMailAdd();
        });
    });

    $("#deleteRequestPo").on("click", function () {
        fetchDataForm("delete");
        deleteAccount().then(function () {
            sendMailDelete();
        });
    });
});

function fetchDataForm(type) {
    if (type == "add") {
        siren = $('#siren').val();
        email = $('#email').val();
        currency = $('#currency').val();
    }
    login = $('#login').val();
    companyName = $('#companyName').val();
    comment = $('#comment').val();
}

function deleteDataForm() {
    $('#siren').val('');
    $('#email').val('');
    $('#currency').val('');
    $('#login').val('');
    $('#companyName').val('');
    $('#comment').val('');
}

function addAccount() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "includes/addMerchant.php",
            type: "POST",
            dataType: "JSON",
            data: { "login": login, "siren": siren, "companyName": companyName, "email": email, "currency": currency, "comment": comment },
            success: function (data) {
                var result = data.AddMerchant;
                console.log(result);
                var modal = new bootstrap.Modal(document.getElementById("modalAddMerchant"));
                modal.show();
                deleteDataForm();
                //resolve();
            },
            error: function (data) {
                console.log(data);
                reject();
            },
        });
        resolve();
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

function sendMailAdd() {
    var modal = new bootstrap.Modal(document.getElementById("modalAddMerchant"));
    modal.show();
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