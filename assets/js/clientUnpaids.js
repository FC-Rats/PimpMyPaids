var listClientUnpaidsData = "";
var beforeDate = "";
var afterDate = "";
var label = "";
var idUnpaid = "";

var unpaidsElement = document.getElementById("clientSumUnpaids");
var unpaids = parseFloat(unpaidsElement.textContent);
if (unpaids < 0) {
    unpaidsElement.style.color = "#AE2A00";
}

var codeRGB = (9, 210, 60);

$(function () {
    $.ajax({
        url: "includes/graphUnpaid.php",
        type: "POST",
        dataType: "JSON",
        data: {},
        success: function (data) {
            if (data.GraphUnpaids) {
                console.log(data.GraphUnpaids);
                var jsonData = data.GraphUnpaids;
                var seriesData = jsonData.map(function (item) {
                    return {
                        name: item.motif_impaye,
                        y: parseInt(item.nombre_impayes)
                    };
                });
                Highcharts.chart("container", {
                    chart: {
                        type: "pie",
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0,
                        },
                    },
                    title: {
                        text: "Répartition des raisons des vos impayés",
                        align: "left",
                    },
                    accessibility: {
                        point: {
                            valueSuffix: "%",
                        },
                    },
                    tooltip: {
                        pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: "pointer",
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: "{point.name}",
                            },
                        },
                    },
                    series: [
                        {
                            type: "pie",
                            name: "Pourcentage",
                            data: seriesData,
                        },
                    ],
                });
            }
        },
        error: function (data) {
            console.log(data);
        },
    });

    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    label = $('#label').val();
    idUnpaid = $('#idUnpaid').val();
    listClientUnpaids(beforeDate, afterDate, label, idUnpaid, $("#formSortClientUnpaids").val());

    $("#label").on("change", function () {
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        listClientUnpaids(
            beforeDate,
            afterDate,
            label,
            idUnpaid,
            $("#formSortClientUnpaids").val()
        );
    });

    $("#formSortClientUnpaids").on("change", function () {
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        listClientUnpaids(
            beforeDate,
            afterDate,
            label,
            idUnpaid,
            $("#formSortClientUnpaids").val()
        );
    });

    $("#searchUnpaidsButton").on("click", function () {
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        listClientUnpaids(beforeDate, afterDate, label, idUnpaid, $("#formSortClientUnpaids").val());
    });

    // export
    $("#export_type").on("change", function () {
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        var sorting = $('#formSortClientUnpaids').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        dataToExport = JSON.stringify(listClientUnpaidsData);
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "idUnpaid": idUnpaid, "sort": sorting, "context": context, "export_type": export_type, "dataToExport": dataToExport },
            success: function (data) {
                window.location.href = data.fileUrl; // Cela déclenchera le téléchargement du fichier
                $("#export_type").val("noExport");
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});

function listClientUnpaids(
    beforeDate,
    afterDate,
    label,
    idUnpaid,
    sort
) {
    $.ajax({
        url: "includes/listUnpaids.php",
        type: "POST",
        dataType: "JSON",
        data: { "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "numDossier": idUnpaid, "formSortClientUnpaids": sort },
        success: function (data) {
            listClientUnpaidsData = data.ListUnpaidsClient;
            console.log(listClientUnpaidsData);
            $("#countResults").text(listClientUnpaidsData.length);
            $("#container-unpaid-list").empty();
            $.map(listClientUnpaidsData, function (data, dataKey) {
                var html = "";
                html += '<div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="' + data.idUnpaid + '">';
                html += '<span class="col-12 col-sm-6 col-lg-1 dateTransac">' + data.dateTransac + '</span>';
                html += '<span class="col-2 col-lg-1 network">' + data.network + '</span>';
                html += '<span class="col-10 col-lg-2 creditCardNumber">' + data.creditCardNumber + '</span>';
                html += '<span class="col-12 col-sm-6 col-lg-2 idUnpaid">' + data.unpaidFileNumber + '</span>';
                html += '<span class="col-12 col-sm-6 col-lg-3 sign fw-bold" style="color:' + calculateRGB(data.amount) + ' ;">' + data.sign + ' ' + data.amount + ' (' + data.currency + ')</span>';
                html += '<span class="col-12 col-sm-6 col-lg-2 label">' + data.unpaidName + '</span>';
                html += "</div>";

                $("#container-unpaid-list").append(html);
            });

            if (listClientUnpaidsData.length == 0) {
                $("#container-unpaid-list").append('<div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center">Aucun résultat</div>');
            }

            hideCreditCardNumber();
            formatDate();
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function calculateRGB(amount) {
    switch (true) {
        case (amount >= 0 && amount < 100):
            return "rgb(30,180,0)";
        case (amount >= 100 && amount < 200):
            return "rgb(163,190,0)";
        case (amount >= 200 && amount < 300):
            return "rgb(170,170,0)";
        case (amount >= 300 && amount < 400):
            return "rgb(210,150,0)";
        case (amount >= 400 && amount < 500):
            return "rgb(210,90,0)";
        case (amount >= 500 && amount < 600):
            return "rgb(210,30,0)";
        case (amount >= 600 && amount < 700):
            return "rgb(150,0,0)";
        default:
            return "rgb(0,0,0)"; // Default case if none of the ranges match
    }
}

function hideCreditCardNumber() {
    $(".creditCardNumber").each(function () {
        var creditCardNumber = $(this).text();
        var creditCardNumberHide = creditCardNumber.replace(/\d(?=\d{4})/g, "*");
        $(this).text(creditCardNumberHide);
    });
}

function formatDate() {
    $(".dateTransac").each(function () {
        var dateTransac = $(this).text();
        var date = new Date(dateTransac);
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();
        $(this).text(formattedDate);
    });
}