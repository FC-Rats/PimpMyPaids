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
        siren = $('#ajout-form #siren').val();
        firstName = $('#ajout-form #firstName').val();
        lastName = $('#ajout-form #lastName').val();
        email = $('#ajout-form #email').val();
        currency = $('#ajout-form #currency').val();
        login = $('#ajout-form #login').val();
        companyName = $('#ajout-form #companyName').val();
        comment = $('#ajout-form #comment').val();
    } else if (type == "delete") {
        login = $('#suppression-form #login').val();
        companyName = $('#suppression-form #companyName').val();
        comment = $('#suppression-form #comment').val();
    }
}

function deleteDataForm(type) {
    if (type == "add") {
        $('#ajout-form #siren').val('');
        $('#ajout-form #firstName').val('');
        $('#ajout-form #lastName').val('');
        $('#ajout-form #email').val('');
        $('#ajout-form #currency').val('');
        $('#ajout-form #login').val('');
        $('#ajout-form #companyName').val('');
        $('#ajout-form #comment').val('');
    } else if (type == "delete") {
        $('#suppression-form #login').val('');
        $('#suppression-form #companyName').val('');
        $('#suppression-form #comment').val('');
    }
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
            deleteDataForm("add");
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
            deleteDataForm("delete");
        },
        error: function (data) {
            console.log(data);
        },
    });
}