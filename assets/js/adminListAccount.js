var listAccountData = "";

$(function () {
    listAccounts();

    $(".fa-solid.fa-trash.fa-xl").on("click", function () {
        listAccounts();
    });
});

function listAccounts() {
    $.ajax({
        url: "includes/getAccounts.php",
        type: "POST",
        dataType: "JSON",
        data: { },
        success: function (data) {
            listAccountData = data.ListAccounts;
            console.log(listAccountData);

            $("#accordionListAcounts").empty();
            $.map(listAccountData, function (data, dataKey) {
                var html = "";
                html += '<div class="accordion-item my-3">';
                html += '<h2 class="accordion-header">';
                if (data.montant >= 0) {
                    html += '<button class="accordion-button collapsed rounded compte pasdanger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' + dataKey + '" aria-expanded="false" aria-controls="flush-collapse' + dataKey + '">';
                } else {
                    html += '<button class="accordion-button collapsed rounded compte danger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' + dataKey + '" aria-expanded="false" aria-controls="flush-collapse' + dataKey + '">';
                }
                html += '<span class="col-3 col-md-1">' + data.siren + '</span>';
                html += '<span class="col-1 text-center">-</span>';
                html += '<span class="col-6 col-md-3">' + data.companyName + '</span>';
                html += '</button>';
                html += '</h2>';
                html += '<div id="flush-collapse' + dataKey + '" class="accordion-collapse collapse">';
                html += '<div class="accordion-body">';
                html += '<div class="infos d-flex flex-column flex-sm-row pb-2">';
                html += '<span class="col-5 col-sm-5 col-md-6">' + data.nbTransactions + ' transaction(s)</span>';
                if (data.montant >= 0) { 
                    html += '<span class="col-1">+</span>';
                } else {
                    html += '<span class="col-1">-</span>';
                }
                html += '<span class="col-4 col-sm-4 col-md-3">' + data.montant + '</span>';
                html += '<span class="col-2">(' + 'KEKE' + ')</span>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $("#accordionListAcounts").append(html);
            });
        },
        error: function (data) {
            console.log(data);
        },
    });
}