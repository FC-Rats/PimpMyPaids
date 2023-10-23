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
});
