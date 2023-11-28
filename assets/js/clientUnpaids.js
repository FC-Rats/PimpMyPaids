var listClientUnpaidsData = "";
var beforeDate = "";
var afterDate = "";
var label = "";
var idUnpaid = "";

$(function () {
    $.ajax({
        url: "Path/to/file.php",
        type: "POST",
        dataType: "JSON",
        data: { siren },
        success: function (data) {
            if (data.clientUnpaidsGroupByReason) {
                //TODO: fill chart
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
    listClientUnpaids(siren, beforeDate, afterDate, label, idUnpaid, $("#formSortClientUnpaids").val());

    $("#formSortClientUnpaids").on("change", function () {
        beforeDate = $('#beforeDate').val();
        afterDate = $('#afterDate').val();
        label = $('#label').val();
        idUnpaid = $('#idUnpaid').val();
        listClientUnpaids(
            siren,
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
        listClientUnpaids(siren, beforeDate, afterDate, label, idUnpaid, $("#formSortClientUnpaids").val());
    });
});

function listClientUnpaids(
    siren,
    beforeDate,
    afterDate,
    label,
    idUnpaid,
    sort
) {
    $.ajax({
        url: "Path/to/file.php",
        type: "POST",
        dataType: "JSON",
        data: { siren, beforeDate, afterDate, label, idUnpaid, sort },
        success: function (data) {
            listClientUnpaidsData = data.ListClientUnpaids;
        },
        error: function (data) {
            console.log(data);
        },
    });

    $("#container-unpaid-list").empty();
    $.map(listClientUnpaidsData, function (data, dataKey) {
        html = "";
        // html += "to Add";

        $("#container-unpaid-list").append(html);
    });
}

// a supprimer
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
            data: [
                ["Fraude à la carte", 23],
                ["Compte à découvert", 18],
                {
                    name: "Compte clôturé",
                    y: 12,
                    sliced: true,
                    selected: true,
                },
                ["Compte bloqué", 9],
                ["Provision insuffisante", 8],
                ["Opération constestée par le débiteur", 5],
                ["Titulaire décédé", 10],
                ["Raison non communiquée, contactez la banque du client", 15],
            ],
        },
    ],
});
