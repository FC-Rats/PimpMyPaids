var listClientUnpaidsData = "";
var beforeDate = "";
var afterDate = "";
var label = "";
var idUnpaid = "";

$(function () {
    $.ajax({
        url: "../../includes/graphUnpaid.php",
        type: "POST",
        dataType: "JSON",
        data: {},
        success: function (data) {
            if (data.GraphUnpaids) {
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
    listClientUnpaids(beforeDate, afterDate, label, idUnpaid, $("#formSortClientUnpaids").val());

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
        context = $('#context').val();
        export_type = $('#export_type').val();
        $.ajax({
            url: "../../export/export_data.php",
            type: "POST",
            dataType: "JSON",
            data: { "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "idUnpaid": idUnpaid, "context": context, "export_type": export_type },
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

function listClientUnpaids(
    beforeDate,
    afterDate,
    label,
    idUnpaid,
    sort
) {
    $.ajax({
        url: "../../includes/listUnpaids.php",
        type: "POST",
        dataType: "JSON",
        data: { "beforeDate": beforeDate, "afterDate": afterDate, "label": label, "numDossier": idUnpaid, "formSortClientUnpaids": sort },
        success: function (data) {
            listClientUnpaidsData = data.ListUnpaidsClient;
            console.log(listClientUnpaidsData);
            $("#countResults").text(listClientUnpaidsData.length);
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
