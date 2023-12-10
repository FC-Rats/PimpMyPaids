// clientColorValueBalance
var soldeElement = document.getElementById("clientBalance");
var remittanceElement = document.getElementById("clientRemittances");
var unpaidsElement = document.getElementById("clientUnpaids");
var solde = parseFloat(soldeElement.textContent);
var remittance = parseFloat(remittanceElement.textContent);
var unpaids = parseFloat(unpaidsElement.textContent);
if (solde < 0) {
    soldeElement.style.color = "#AE2A00";
}
if (remittance < 0) {
    remittanceElement.style.color = "#AE2A00";
}
if (unpaids < 0) {
    unpaidsElement.style.color = "#AE2A00";
}

// clientBalanceChart
$(function () {
    $.ajax({
        url: "includes/graphBalanceEvolution.php",
        type: "POST",
        dataType: "JSON",
        data: { },
        success: function (data) {
            if (data.GraphBalance) {
                console.log(data.GraphBalance);
                var keys = Object.keys(data.GraphBalance);
            
                // Triez les clés en fonction de leur valeur numérique
                keys.sort(function(a, b) {
                    return parseFloat(a) - parseFloat(b);
                });
            
                // Obtenez l'index du mois actuel (supposons que ce mois soit "MM")
                var currentMonth = new Date().getMonth() + 1; // +1 car les mois dans JavaScript sont indexés à partir de 0
                var currentIndex = keys.indexOf(currentMonth.toString());
            
                // Déplacez le mois actuel à la fin du tableau
                if (currentIndex !== -1) {
                    keys.push(keys.splice(currentIndex, 1)[0]);
                }
            
                var seriesData = keys.map(function(key) {
                    return {
                        name: key,
                        y: parseFloat(data.GraphBalance[key])
                    };
                });
            
                Highcharts.chart("container-soldes", {
                    chart: {
                        type: "column",
                    },
                    title: {
                        text: "Évolution de votre trésorerie",
                    },
                    xAxis: {
                        categories: keys,
                    },
                    credits: {
                        enabled: false,
                    },
                    plotOptions: {
                        column: {
                            borderRadius: "25%",
                        },
                    },
                    series: [
                        {
                            name: "Trésorerie",
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
});

/* // a supprimer 
Highcharts.chart("container-soldes", {
    chart: {
        type: "column",
    },
    title: {
        text: "Évolution de votre trésorerie",
    },
    xAxis: {
        categories: [
            "01",
            "02",
            "03",
            "04",
            "05",
            "06",
            "07",
            "08",
            "09",
            "10",
            "11",
            "12",
        ],
    },
    credits: {
        enabled: false,
    },
    plotOptions: {
        column: {
            borderRadius: "25%",
        },
    },
    series: [
        {
            name: "Trésorerie",
            data: [
                25000, 20000, 15000, 10000, 5000, 0, -5000, -2500, 3000, 10000, 20000,
                30000,
            ],
        },
    ],
}); */
