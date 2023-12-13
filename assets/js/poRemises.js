var listRemittancesData = "";
var siren = "";
var companyName = "";
var remittanceNumber = "";
var beforeDate = "";
var afterDate = "";
var rowsPerPage = 3;
var pageToShow = 1;
var remittanceNumberToKey = [];

$(function () {
    siren = $('#siren').val();
    companyName = $('#companyName').val();
    remittanceNumber = $('#remittanceNumber').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    listRemittances(siren, companyName, remittanceNumber, beforeDate, afterDate);

    $("#searchRemittances").on("click", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listRemittances(siren, companyName, remittanceNumber, beforeDate, afterDate);
    });

    // pagination
    $("#nbLineByPage").on("input", function () {
        rowsPerPage = $(this).val();
        printRemittances();
    });
    $("#pageToShow").on("input", function () {
        pageToShow = $(this).val();
        printRemittances();
    });

    // export
    $("#export_type").on("change", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
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
            data: { "siren": siren, "companyName": companyName, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type, "dataToExport": dataToExport },
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
    $("#export_typeDetails").on("change", function () {
        var idDetails = $('#idDetails').val();
        companyName = $('#offcanvasDetailRemittancePo #companyNameDetail').val();
        remittanceNumber = $('#offcanvasDetailRemittancePo #idRemittanceDetail').val();
        context = $('#contextDetails').val();
        export_type = $('#export_typeDetails').val();
        dataToExport = JSON.stringify(listRemittancesData[idDetails].details);
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "companyName": companyName, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type, "dataToExport": dataToExport },
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

function listRemittances(
    siren,
    companyName,
    remittanceNumber,
    beforeDate,
    afterDate,
) {
    $.ajax({
        url: "includes/listRemittances.php",
        type: "POST",
        dataType: "JSON",
        data: { "siren": siren, "companyName": companyName, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate },
        success: function (data) {
            listRemittancesData = data.ListRemittances;
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

            printRemittances();
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function printRemittances() {
    $("#container-remise-list").empty();
    var start = rowsPerPage * (pageToShow - 1);
    var sum = parseInt(start, 10) + parseInt(rowsPerPage, 10);
    var itemsToShow = listRemittancesData.slice(start, sum);
    $.map(itemsToShow, function (data, dataKey) {
        var html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 px-lg-5 py-3 d-flex flex-row flex-wrap justify-content-end justify-content-lg-between align-items-center" id="' + data.remittanceNumber + '">';
        html += '<span class="col-12 col-sm-6 col-lg-1 siren">' + data.siren + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-2 companyName">' + data.companyName + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-1 remittanceNumber">' + data.remittanceNumber + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-1 dateRemittance">' + data.dateRemittance + '</span>';
        html += '<span class="col-12 col-sm-6 col-lg-2 nbTransactions">' + data.nbTransactions + ' transaction(s)</span>';
        html += '<span class="col-12 col-sm-6 col-lg-2 totalAmount">' + data.montantTotal + ' (' + data.currency + ')</span>';
        html += '<button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailRemittancePo" aria-controls="offcanvasDetailRemittancePo" onclick="viewDetailRemittance(' + remittanceNumberToKey[data.remittanceNumber] + ');">+</button>';
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

function formatDate() {
    $(".dateRemittance").each(function () {
        var dateRemittance = $(this).text();
        var date = new Date(dateRemittance);
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();
        $(this).text(formattedDate);
    });
}

function viewDetailRemittance(id) {
    var dataDetail = listRemittancesData[id];
    console.log(dataDetail);
    $("#offcanvasDetailRemittancePo #offcanvas-body").empty();
    $("#offcanvasDetailRemittancePo #companyNameDetail").text(dataDetail.companyName);
    $("#offcanvasDetailRemittancePo #idRemittanceDetail").text(dataDetail.remittanceNumber);

    html = "";
    html += '<input type="hidden" name="contextDetails" value="poRemisesDetails" id="contextDetails">';
    html += '<input type="hidden" name="idDetails" value="'+id+'" id="idDetails">';
    html += '<select class=" d-flex form-select btn btn-primary border-0 p-1 pe-5" name="export_typeDetails" id="export_typeDetails">';
    html += '<option value="noExport" selected>Exporter les données</option>';
    html += '<option value="pdf">PDF</option>';
    html += '<option value="csv">CSV</option>';
    html += '<option value="xls">XLSX</option>';
    html += '</select>';

    $("#offcanvasDetailRemittancePo #offcanvas-body").append(html);

    $.map(dataDetail.details, function (data, dataKey) {
        html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center" id="' + data.numAutorisation + '">';
        html += '<span class="col-12 dateTransac">' + data.dateTransac + '</span>';
        html += '<span class="col-4 network">' + data.network + '</span>';
        html += '<span class="col-6 creditCardNumber">' + data.creditCardNumber + '</span>';
        html += '<span class="col-12 numAutorisation">' + data.numAutorisation + '</span>';
        html += '<span class="col-1 sign">' + data.sign + '</span>';
        html += '<span class="col-4 amount">' + data.amount + '</span>';
        html += '<span class="col-2 currency">' + data.currency + '</span>';
        html += '</div>';

        $("#offcanvasDetailRemittancePo #offcanvas-body").append(html);
    });

    hideCreditCardNumber();
    formatDateDetail();

    var monElement = document.getElementById("export_typeDetails");
    console.log(monElement);

    console.log("okk");
}

function formatDateDetail() {
    $(".dateTransac").each(function () {
        var dateTransac = $(this).text();
        var date = new Date(dateTransac);
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();
        $(this).text(formattedDate);
    });
}

function hideCreditCardNumber() {
    $(".creditCardNumber").each(function () {
        var creditCardNumber = $(this).text();
        var creditCardNumberHide = creditCardNumber.replace(/\d(?=\d{4})/g, "*");
        $(this).text(creditCardNumberHide);
    });
}