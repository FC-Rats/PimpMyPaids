var listRemittancesData = "";
var listRemittancesDetailsData = "";
var siren = "";
var companyName = "";
var remittanceNumber = "";
var beforeDate = "";
var afterDate = "";
var rowsPerPage = 3;
var pageToShow = 1;
var listRemittancesData = [
    "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"
];

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
        rowsPerPage=$(this).val();
        listRemittances(siren, companyName, remittanceNumber, beforeDate, afterDate);
    });
    $("#pageToShow").on("input", function () {
        pageToShow=$(this).val();
        listRemittances(siren, companyName, remittanceNumber, beforeDate, afterDate);
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
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "siren": siren, "companyName": companyName, "remittanceNumber": remittanceNumber, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type },
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
            listRemittancesDetailsData = data.ListRemittancesDetails;
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

function viewDetailRemittance(id) {
    var dataDetail = listRemittancesDetailsData[id];
    $("#offcanvasDetailRemittance").empty();
    $.map(dataDetail, function (data, dataKey) {
        html = "";
        // html += "to Add";
        // à changer : 
        // + changer le label offcanvas
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.dateTransac").val(data.dateTransac);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.network").val(data.network);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.creditCardNumber").val(data.creditCardNumber);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.numAutorisation").val(data.numAutorisation);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.sign").val(data.sign);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.amount").val(data.amount);
        $("#offcanvasDetailRemittance\\#" + data.id + "\\.currency").val(data.currency);
        $("#offcanvasDetailRemittance").append(html);
    });
}