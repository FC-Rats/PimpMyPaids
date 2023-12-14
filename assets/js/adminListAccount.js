var listAccountData = "";

$(function () {
    listAccounts();
});

function listAccounts() {
    $.ajax({
        url: "includes/getAccounts.php",
        type: "POST",
        dataType: "JSON",
        data: {},
        success: function (data) {
            listAccountData = data.ListAccounts;
            console.log(listAccountData);

            $("#accordionListAcounts").empty();
            $.map(listAccountData, function (data, dataKey) {
                var html = "";
                html += '<div class="accordion-item my-3">';
                html += '<h2 class="accordion-header">';
                html += '<button class="accordion-button collapsed rounded compte pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' + dataKey + '" aria-expanded="false" aria-controls="flush-collapse' + dataKey + '">';
                html += '<span class="col-3 col-md-1">' + data.siren + '</span>';
                html += '<span class="col-1 text-center">-</span>';
                html += '<span class="col-6 col-md-3">' + data.companyName + '</span>';
                html += '</button>';
                html += '</h2>';
                html += '<div id="flush-collapse' + dataKey + '" class="accordion-collapse collapse">';
                html += '<div class="accordion-body">';
                html += '<div class="infos d-flex flex-row flex-wrap pb-2 col-12 justify-content-center align-items-center">';
                html += '<div class="d-flex flex-column col-12">';
                html += '<div class="col-12">Email : <span class="emailCustomer">' + data.email + '</span></div>';
                html += '<div class="col-12">DEVISE : <span class="currency">' + data.currency + '</span></div>';
                html += '<br>';
                html += '<div class="col-12">Login : <span class="login">' + data.login + '</span></div>';
                html += '</div>';
                html += '<div class="d-flex justify-content-end clear-button align-items-center col-12">';
                html += '<div class="btn border-0" onclick="deleteCustomer(\'' + data.login + '\');"><i class="fa-solid fa-trash fa-xl"></i></div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $("#accordionListAcounts").append(html);
            });

            if (listAccountData.length == 0) {
                $("#accordionListAcounts").append('<div class="text-center">Aucun compte</div>');
            }
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
            listAccounts();
            var modal = new bootstrap.Modal(document.getElementById("modalDeleteMerchant"));
            modal.show();
        },
        error: function (data) {
            console.log(data);
        },
    });
}