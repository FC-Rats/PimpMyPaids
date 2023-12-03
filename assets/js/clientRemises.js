var listRemittancesData = "";
var listRemittancesDetailsData = "";
var creditCardNumber = "";
var amount = "";
var remittanceNumber = "";
var beforeDate = "";
var afterDate = "";
var rowsPerPage = 3;
var pageToShow = 1;
var listRemittancesData = [
    "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"
];

$(function () {
    creditCardNumber = $('#creditCardNumber').val();
    amount = $('#amount').val();
    remittanceNumber = $('#remittanceNumber').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    listClientRemittances(creditCardNumber, amount, remittanceNumber, beforeDate, afterDate);

    $("#searchRemittanceClientButton").on("click", function () {
        creditCardNumber = $('#creditCardNumber').val();
        amount = $('#amount').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listClientRemittances(creditCardNumber, amount, remittanceNumber, beforeDate, afterDate);
    });

    // pagination
    $("#nbLineByPage").on("input", function () {
        rowsPerPage=$(this).val();
        listClientRemittances(creditCardNumber, amount, remittanceNumber, beforeDate, afterDate);
    });
    $("#pageToShow").on("input", function () {
        pageToShow=$(this).val();
        listClientRemittances(creditCardNumber, amount, remittanceNumber, beforeDate, afterDate);
    });

    // export
    $("#export_type").on("change", function () {
        creditCardNumber = $('#creditCardNumber').val();
        amount = $('#amount').val();
        remittanceNumber = $('#remittanceNumber').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        $.ajax({
            url: "../../export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "creditCardNumber": creditCardNumber, "amount": amount, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type },
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
    creditCardNumber,
    amount,
    remittanceNumber,
    beforeDate,
    afterDate,
) {
    $.ajax({
        url: "../../includes/listRemittances.php",
        type: "POST",
        dataType: "JSON",
        data: { "creditCardNumber": creditCardNumber, "amount": amount, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate },
        success: function (data) {
            listRemittancesData = data.ListRemittancesClient;
            listRemittancesDetailsData = data.ListRemittancesDetailsClient;
            console.log(listRemittancesData);
            console.log(listRemittancesDetailsData);
            $("#countResults").text(listRemittancesData.length);
            // changer max pagination
            // $("#pagination").attr("max", listRemittancesData.length);
            // $("#pagination").val(1);
            // $("#pagination").trigger("change");
            // afficher somme
        },
        error: function (data) {
            console.log(data);
        },
    });

    $("#container-remise-list").empty();
    var start = rowsPerPage*(pageToShow-1);
    var itemsToShow = listRemittancesData.slice(start, start+rowsPerPage);
    var sum = parseInt(start, 10)+parseInt(rowsPerPage, 10);
    console.log("PRINTING : [" + start + ", " + sum + "]");
    $.map(itemsToShow, function (data, dataKey) {
        html = "";
        // html += "to Add";

        $("#container-remise-list").append(html);
    });
}

function viewClientDetailRemittance(id) {
    var dataDetail = listRemittancesDetailsData[id];
    $("#offcanvasDetailRemittanceClient").empty();
    $.map(dataDetail, function (data, dataKey) {
        html = "";
        // html += "to Add";
        // à changer : 
        // + changer le label offcanvas
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.dateTransac").val(data.dateTransac);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.network").val(data.network);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.creditCardNumber").val(data.creditCardNumber);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.numAutorisation").val(data.numAutorisation);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.sign").val(data.sign);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.amount").val(data.amount);
        $("#offcanvasDetailRemittanceClient\\#" + data.id + "\\.currency").val(data.currency);
        $("#offcanvasDetailRemittanceClient").append(html);
    });
}