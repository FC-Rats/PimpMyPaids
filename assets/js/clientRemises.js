var listRemittancesData = "";
var amount = "";
var remittanceNumber = "";
var beforeDate = "";
var afterDate = "";
var rowsPerPage = 3;
var pageToShow = 1;
var remittanceNumberToKey = [];

var remisesElement = document.getElementById("clientSumRemises");
var remises = parseFloat(remisesElement.textContent);
if (remises < 0) {
    remisesElement.style.color = "#AE2A00";
}

$(function () {
    amount = $('#amount').val();
    remittanceNumber = $('#remittanceNumber').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    listClientRemittances(amount, remittanceNumber, beforeDate, afterDate);

    $("#searchRemittanceClientButton").on("click", function () {
        amount = $('#amount').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listClientRemittances(amount, remittanceNumber, beforeDate, afterDate);
    });

    // pagination
    $("#nbLineByPage").on("input", function () {
        rowsPerPage = $(this).val();
        printClientRemittances();
    });
    $("#pageToShow").on("input", function () {
        pageToShow = $(this).val();
        printClientRemittances();
    });

    // export
    $("#export_type").on("change", function () {
        amount = $('#amount').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        dataToExport = JSON.stringify(listRemittancesData);
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "amount": amount, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type, "dataToExport": dataToExport },
            success: function (data) {
                window.location.href = data.fileUrl; // Cela déclenchera le téléchargement du fichier
                $("#export_type").val("noExport");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    // export details
    $("#offcanvasDetailRemittanceClient").on("change", "#export_typeDetails", function () {
        var idDetails = $('#idDetails').val();
        var dateRemittance = listRemittancesData[idDetails].dateRemittance;
        montantTotal = listRemittancesData[idDetails].montantTotal;
        currency = listRemittancesData[idDetails].currency;
        remittanceNumber = $('#idRemittanceDetail').text();
        context = $('#contextDetails').val();
        export_type = $('#export_typeDetails').val();
        dataToExport = JSON.stringify(listRemittancesData[idDetails].details);
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "remittanceNumber": remittanceNumber, "dateRemittance": dateRemittance, "montantTotal": montantTotal, "currency": currency, "context": context, "export_type": export_type, "dataToExport": dataToExport },
            success: function (data) {
                window.location.href = data.fileUrl; // Cela déclenchera le téléchargement du fichier
                $("#export_typeDetails").val("noExport");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});

function listClientRemittances(
    amount,
    remittanceNumber,
    beforeDate,
    afterDate,
) {
    $.ajax({
        url: "includes/listRemittances.php",
        type: "POST",
        dataType: "JSON",
        data: { "amount": amount, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate },
        success: function (data) {
            listRemittancesData = data.ListRemittancesClient;
            console.log(listRemittancesData);
            $("#countResults").text(listRemittancesData.length);

            remittanceNumberToKey = [];

            $.map(listRemittancesData, function (data, dataKey) {
                remittanceNumberToKey[data.remittanceNumber] = dataKey;
            });

            $("#pageToShow").val(1);
            $("#nbLineByPage").val(Math.min(3, listRemittancesData.length));
            rowsPerPage = $('#nbLineByPage').val();
            pageToShow = $('#pageToShow').val();

            printClientRemittances();
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function printClientRemittances() {
    $("#container-remise-list").empty();
    var start = rowsPerPage * (pageToShow - 1);
    var sum = parseInt(start, 10) + parseInt(rowsPerPage, 10);
    var itemsToShow = listRemittancesData.slice(start, sum);
    $.map(itemsToShow, function (data, dataKey) {
        var html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 px-lg-5 py-3 d-flex flex-row flex-wrap justify-content-end justify-content-lg-between align-items-center" id="' + data.remittanceNumber + '">';
        html += '<span class="col-12 col-sm-6 col-lg-1 remittanceNumber">' + data.remittanceNumber + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-3 dateRemittance">' + data.dateRemittance + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-3 nbTransactions">' + data.nbTransactions + ' transaction(s)</span>';
        if (data.montantTotal < 0) {
            html += '<span class="col-12 col-sm-6 col-lg-3 negative totalAmount">' + data.montantTotal + ' (' + data.currency + ')</span>';
        } else {
            html += '<span class="col-12 col-sm-6 col-lg-3 totalAmount">' + data.montantTotal + ' (' + data.currency + ')</span>';
        }
        html += '<button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailRemittanceClient" aria-controls="offcanvasDetailRemittanceClient" onclick="viewClientDetailRemittance(' + remittanceNumberToKey[data.remittanceNumber] + ');">+</button>';
        html += '</div>';

        $("#container-remise-list").append(html);

    });

    if (listRemittancesData.length == 0) {
        $("#container-remise-list").append('<div class="text-center">Aucune remise</div>');
    } else if (itemsToShow.length == 0) {
        $("#container-remise-list").append('<div class="text-center">Aucun résultat</div>');
    }

    formatDate();
}

function viewClientDetailRemittance(id) {
    var dataDetail = listRemittancesData[id].details;
    console.log(dataDetail);
    $("#offcanvasDetailRemittanceClient #offcanvas-body").empty();
    $("#offcanvasDetailRemittanceClientLabel #idRemittanceDetail").text(dataDetail[0].remittanceNumber);

    html = "";
    html += '<input type="hidden" name="contextDetails" value="clientRemisesDetails" id="contextDetails">';
    html += '<input type="hidden" name="idDetails" value="' + id + '" id="idDetails">';
    html += '<select class=" d-flex form-select btn btn-primary border-0 p-1 pe-5" name="export_typeDetails" id="export_typeDetails">';
    html += '<option value="noExport" selected>Exporter les données</option>';
    html += '<option value="pdf">PDF</option>';
    html += '<option value="csv">CSV</option>';
    html += '<option value="xls">XLSX</option>';
    html += '</select>';
    $("#offcanvasDetailRemittanceClient #offcanvas-body").append(html);

    $.map(dataDetail, function (data, dataKey) {
        html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center">';
        html += '<span class="col-12 dateTransac">Date de Transaction : ' + data.dateTransac + '</span>';
        html += '<span class="col-12 network">Réseau : ' + data.network + '</span>';
        html += '<span class="col-12 creditCardNumber">Carte : ' + data.creditCardNumber + '</span>';
        html += '<span class="col-12 numAutorisation">Numéro d\'autorisation : ' + data.numAutorisation + '</span>';
        if (data.sign == "-") {
            html += '<span class="col-12 negative total">Montant : ' + data.sign + ' ' + data.amount + ' (' + data.currency + ')</span>';
        } else {
            html += '<span class="col-12 total">Montant : ' + data.sign + ' ' + data.amount + ' (' + data.currency + ')</span>';
        }
        html += '</div>';

        $("#offcanvasDetailRemittanceClient #offcanvas-body").append(html);
    });

    hideCreditCardNumber();
    formatDateDetail();
}

function formatDate() {
    $(".dateRemittance").each(function () {
        var dateRemittance = $(this).text();
        var date = new Date(dateRemittance);
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();
        $(this).text("Date de Remise : " + formattedDate);
    });
}

function formatDateDetail() {
    $(".dateTransac").each(function () {
        var dateTransac = $(this).text();
        var date = new Date(dateTransac);
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();
        $(this).text("Date de Transaction : " + formattedDate);
    });
}

function hideCreditCardNumber() {
    $(".creditCardNumber").each(function () {
        var creditCardNumber = $(this).text();
        var creditCardNumberHide = creditCardNumber.replace(/\d(?=\d{4})/g, "*");
        $(this).text(creditCardNumberHide);
    });
}