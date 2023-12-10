var listRemittancesData = "";
var amount = "";
var remittanceNumber = "";
var beforeDate = "";
var afterDate = "";
var rowsPerPage = 3;
var pageToShow = 1;
var remittanceNumberToKey = [];

$(function () {
    amount = $('#amount').val();
    remittanceNumber = $('#remittanceNumber').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    listClientRemittances( amount, remittanceNumber, beforeDate, afterDate);

    $("#searchRemittanceClientButton").on("click", function () {
        amount = $('#amount').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listClientRemittances( amount, remittanceNumber, beforeDate, afterDate);
    });

    // pagination
    $("#nbLineByPage").on("input", function () {
        rowsPerPage=$(this).val();
        printClientRemittances();
    });
    $("#pageToShow").on("input", function () {
        pageToShow=$(this).val();
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
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: {"amount": amount, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type },
            success: function (data) {
                if (data.Test) {
                    console.log(data.Test);
                }
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
    var start = rowsPerPage*(pageToShow-1);
    var sum = parseInt(start, 10)+parseInt(rowsPerPage, 10);
    var itemsToShow = listRemittancesData.slice(start, sum);
    $.map(itemsToShow, function (data, dataKey) {
        var html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 px-lg-5 py-3 d-flex flex-row flex-wrap justify-content-end justify-content-lg-between align-items-center" id="'+ data.remittanceNumber +'">';
        html += '<span class="col-12 col-sm-6 col-lg-1 remittanceNumber">'+ data.remittanceNumber +'</span>';
        html += '<span class="col-12 col-sm-6 col-lg-3 dateRemittance">'+ data.dateRemittance +'</span>';
        html += '<span class="col-12 col-sm-6 col-lg-3 nbTransactions">'+ data.nbTransactions +' transaction(s)</span>';
        html += '<span class="col-12 col-sm-6 col-lg-3 totalAmount">KEKE '+ data.montantTotal +' ('+ data.currency +')</span>';
        html += '<button class="col-12 col-sm-6 col-lg-1 d-flex justify-content-end clear-button fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailRemittanceClient" aria-controls="offcanvasDetailRemittanceClient" onclick="viewClientDetailRemittance('+ remittanceNumberToKey[data.remittanceNumber] +');">+</button>';
        html += '</div>';

        $("#container-remise-list").append(html);

    });

    formatDate();
}

function viewClientDetailRemittance(id) {
    var dataDetail = listRemittancesData[id].details;
    console.log(dataDetail);
    $("#offcanvasDetailRemittanceClient #offcanvas-body").empty();
    $("#offcanvasDetailRemittanceClientLabel #idRemittanceDetail").text(dataDetail[0].remittanceNumber);

    $.map(dataDetail, function (data, dataKey) {
        html = "";
        html += '<div class="remise-element rounded-3 my-3 px-2 py-3 d-flex flex-row flex-wrap justify-content-between align-items-center">';
        html += '<span class="col-12 dateTransac">'+ data.dateTransac +'</span>';
        html += '<span class="col-6 network">'+ data.network +'</span>';
        html += '<span class="col-6 creditCardNumber">'+ data.creditCardNumber +'</span>';
        html += '<span class="col-12 numAutorisation">'+ data.numAutorisation +'</span>';
        html += '<span class="col-1 sign">'+ data.sign +'</span>';
        html += '<span class="col-4 amount">'+ data.amount +'</span>';
        html += '<span class="col-3 currency">'+ data.currency +'</span>';
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
        $(this).text(formattedDate);
    });
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