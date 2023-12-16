var listUnpaidsData = "";
var siren = "";
var companyName = "";
var idUnpaid = "";
var bael = "";
var beforeDate = "";
var afterDate = "";

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
                Highcharts.chart('container', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Répartition des raisons des impayés',
                        align: 'left'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Pourcentage',
                        data: seriesData,
                    }]
                });
            }
        },
        error: function (data) {
            console.log(data);
        },
    });

    siren = $('#siren').val();
    companyName = $('#companyName').val();
    idUnpaid = $('#idUnpaid').val();
    label = $('#label').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    listUnpaids(siren, companyName, idUnpaid, label, beforeDate, afterDate);

    $("#searchUnpaidsButton").on("click", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        idUnpaid = $('#idUnpaid').val();
        label = $('#label').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listUnpaids(siren, companyName, idUnpaid, label, beforeDate, afterDate);
    });

    $("#label").on("change", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        idUnpaid = $('#idUnpaid').val();
        label = $('#label').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        listUnpaids(siren, companyName, idUnpaid, label, beforeDate, afterDate);
    });

    // export
    $("#export_type").on("change", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        idUnpaid = $('#idUnpaid').val();
        label = $('#label').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        dataToExport = JSON.stringify(listUnpaidsData);
        $.ajax({
            url: "export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "siren": siren, "companyName": companyName, "numDossier": idUnpaid, "label": label, "beforeDate": beforeDate, "afterDate": afterDate, "context": context, "export_type": export_type, "dataToExport": dataToExport },
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

function listUnpaids(
    siren,
    companyName,
    idUnpaid,
    label,
    beforeDate,
    afterDate
) {
    $.ajax({
        url: "includes/listUnpaids.php",
        type: "POST",
        dataType: "JSON",
        data: { "siren": siren, "companyName": companyName, "numDossier": idUnpaid, "label": label, "beforeDate": beforeDate, "afterDate": afterDate },
        success: function (data) {
            listUnpaidsData = data.ListUnpaids;
            console.log(listUnpaidsData);
            $("#nbResults").text(listUnpaidsData.length);

            $("#container-unpaid-list").empty();
            $.map(listUnpaidsData, function (data, dataKey) {
                var html = "";
                html += '<div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="' + dataKey + '">';
                html += '<span class="col-12 col-sm-6 col-lg-1 siren">' + data.siren + '</span>';
                html += '<span class="col-12 col-sm-6 col-lg-3 companyName">' + data.companyName + '</span>';
                html += '<div class="d-flex flex-row justify-content-start justify-content-lg-center align-items-center col-12 col-sm-6 col-lg-4">';
                html += '<span class="col-auto me-2 me-lg-0 col-lg-4 amount">' + data.totalUnpaids + '</span>';
                html += '<span class="col-3 col-lg-2 currency">' + data.currency + '</span>';
                html += '</div>';
                html += '<div class="d-flex justify-content-end align-items-center col-12 col-sm-6 col-lg-2">';
                html += '<button class="btn btn-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDetailUnpaidClient" aria-controls="offcanvasDetailUnpaidClient" onclick="viewDetailUnpaid(' + dataKey + ');">Détail</button>';
                html += '</div>';
                html += '</div>';

                $("#container-unpaid-list").append(html);
            });

            if (listUnpaidsData.length == 0) {
                $("#container-unpaid-list").append('<div class="unpaid-element rounded-3 my-3 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center">Aucun résultat</div>');
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function viewDetailUnpaid(id) {
    var dataDetail = listUnpaidsData[id];
    console.log(dataDetail);
    $("#offcanvasDetailUnpaidClient #offcanvas-body").empty();
    $("#offcanvasDetailUnpaidClient #nameCompany").text(dataDetail.companyName);

    $.map(dataDetail.details, function (data, dataKey) {
        var html = "";
        html += '<div class="unpaid-element rounded-3 my-1 p-2 d-flex flex-row flex-wrap justify-content-between align-items-center" id="' + data.unpaidFileNumber + '">';
        html += '<span class="col-12 siren">Siren : ' + dataDetail.siren + '</span>';
        html += '<span class="col-12 dateTransac">Date de Transaction : ' + data.dateTransac + '</span>';
        html += '<span class="col-12 network">Réseau : ' + data.network + '</span>';
        html += '<span class="col-12 creditCardNumber">Carte : ' + data.creditCardNumber + '</span>';
        html += '<span class="col-12 idUnpaid">Numéro impayé : ' + data.unpaidFileNumber + '</span>';
        html += '<span class="col-12 total">Montant : ' + data.sign + ' ' + data.amount + ' (' + data.currency + ')</span>';
        html += '<span class="col-12 label">Raison : ' + data.unpaidName + '</span>';
        html += '</div>';

        $("#offcanvasDetailUnpaidClient #offcanvas-body").append(html);
    });

    hideCreditCardNumber();
    formatDate();
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
        $(this).text("Date de Transaction : " + formattedDate);
    });
}