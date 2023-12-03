var listUnpaidsData = "";
var listUnpaidsDetailsData = "";
var siren = "";
var companyName = "";
var beforeDate = "";
var afterDate = "";
var label = "";
var idUnpaid = "";

$(function () {
    $.ajax({
        url: "../../includes/graphUnpaid.php",
        type: "POST",
        dataType: "JSON",
        data: { },
        success: function (data) {
            if (data.GraphUnpaids) {
                //TODO: fill chart
            }
        },
        error: function (data) {
            console.log(data);
        },
    });

    siren = $('#siren').val();
    companyName = $('#companyName').val();
    beforeDate = $('#beforeDate').val();
    afterDate = $('#afterDate').val();
    label = $('#label').val();
    idUnpaid = $('#idUnpaid').val();
    listUnpaids(siren, companyName, beforeDate, afterDate, label, idUnpaid);

    $("#searchUnpaidsButton").on("click", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        listUnpaids(siren, companyName, beforeDate, afterDate, label, idUnpaid);
    });

    // export
    $("#export_type").on("change", function () {
        siren = $('#siren').val();
        companyName = $('#companyName').val();
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        context = $('#context').val();
        export_type = $('#export_type').val();
        $.ajax({
            url: "../../export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "siren": siren, "companyName": companyName, "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "idUnpaid": idUnpaid, "context": context, "export_type": export_type },
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

function listUnpaids(
    siren,
    companyName,
    beforeDate,
    afterDate,
    label,
    idUnpaid
) {
    $.ajax({
        url: "../../includes/listUnpaids.php",
        type: "POST",
        dataType: "JSON",
        data: { "siren": siren, "companyName": companyName, "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "numDossier": idUnpaid },
        success: function (data) {
            listUnpaidsData = data.ListUnpaids;
            listUnpaidsDetailsData = data.ListUnpaidsDetails;
            console.log(listUnpaidsData);
            console.log(listUnpaidsDetailsData);
            $("#nbResults").text(listUnpaidsData.length);
        },
        error: function (data) {
            console.log(data);
        },
    });

    $("#container-unpaid-list").empty();
    $.map(listUnpaidsData, function (data, dataKey) {
        html = "";
        // html += "to Add";

        $("#container-unpaid-list").append(html);
    });
}

function viewData(id) {
    var dataDetail = listUnpaidsDetailsData[id];
    $.map(dataDetail, function (data, dataKey) {
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.siren").val(data.siren);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.dateTransac").val(data.dateTransac);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.dateRemittance").val(data.dateRemittance);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.network").val(data.network);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.creditCardNumber").val(data.creditCardNumber);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.idUnpaid").val(data.idUnpaid);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.sign").val(data.sign);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.amount").val(data.amount);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.currency").val(data.currency);
        $("#offcanvasDetailUnpaidClient\\#" + data.id + "\\.label").val(data.label);
    });
}

// a supprimer
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
        data: [
            ['Fraude à la carte', 23],
            ['Compte à découvert', 18],
            {
                name: 'Compte clôturé',
                y: 12,
                sliced: true,
                selected: true
            },
            ['Compte bloqué', 9],
            ['Provision insuffisante', 8],
            ['Opération constestée par le débiteur', 5],
            ['Titulaire décédé', 10],
            ['Raison non communiquée, contactez la banque du client', 15]
        ]
    }]
});