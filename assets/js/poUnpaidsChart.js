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
