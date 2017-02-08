@extends('layouts.app')

@section('contentheader_title', 'Mark')
@section('contentheader_description', 'Director dashboard')

@section('scripts')
@parent

  <script src="https://code.highcharts.com/stock/highstock.js"></script>
  <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


  <style type = text/css>
      .np {background-color: darkgrey;
          color: white;}
      .table {
          font-size: 16px;
      }
      .table th {
          background-color: black;
          color: white;
      }
      .table-hover tbody tr:hover td {
          background-color: #E6E6E6;
          color: black;
      }
  </style>

  <script>
      $(function () {
          Highcharts.setOptions({
              lang: {
                  thousandsSep: ','
              }
          });
          // Create the chart
          $('#code').highcharts('StockChart', {
              chart: {
                  type: 'line',
                  borderColor: '#000000',
                  borderWidth: 1,
                  borderRadius: 6
              },
              legend: {
                  enabled: true
              },
              credits: {
                  enabled: false
              },
              title: {
                  text: 'Audio Minutes'
              },
              yAxis: {
                  title: {
                      text: 'Minutes',
                      style: {
                          color: Highcharts.getOptions().colors[1],
                          "fontWeight": "bold"
                      }
                  },
                    plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                  }]
              },
              xAxis: {
                  type: 'datetime',
                  dateTimeLabelFormats: { // don't display the dummy year
                  day: '%m/%d'
                },
                title: {
                    text: 'Date'
                }
              },
              tooltip: {
                  dateTimeLabelFormats: {
                    second: '%b %Y',
                    minute: '%b %Y',
                    hour: '%b %Y',
                    day: '%b %Y',
                    week: '%b %Y',
                    month: '%b %Y',
                    year: '%Y'
                  }
              },
              series: [{
                  name: 'Minutes',
                  data: [[Date.UTC(2016,08,01), 59273348.0],
                        [Date.UTC(2016,08,02), 40201238.0],
                        [Date.UTC(2016,08,03), 5173979.0],
                        [Date.UTC(2016,08,04), 4118632.0],
                        [Date.UTC(2016,08,05), 14745221.0],
                        [Date.UTC(2016,08,06), 56488906.0],
                        [Date.UTC(2016,08,07), 66373626.0],
                        [Date.UTC(2016,08,08), 68023913.0],
                        [Date.UTC(2016,08,09), 52272087.0],
                        [Date.UTC(2016,08,10), 7412073.0],
                        [Date.UTC(2016,08,11), 5022464.0],
                        [Date.UTC(2016,08,12), 51533867.0],
                        [Date.UTC(2016,08,13), 65785976.0],
                        [Date.UTC(2016,08,14), 66002321.0],
                        [Date.UTC(2016,08,15), 66195880.0],
                        [Date.UTC(2016,08,16), 49169566.0],
                        [Date.UTC(2016,08,17), 7179586.0],
                        [Date.UTC(2016,08,18), 4894992.0],
                        [Date.UTC(2016,08,19), 54344247.0],
                        [Date.UTC(2016,08,20), 54250272.0],
                        [Date.UTC(2016,08,21), 68597695.0],
                        [Date.UTC(2016,08,22), 67980965.0],
                        [Date.UTC(2016,08,23), 50619051.0],
                        [Date.UTC(2016,08,24), 7049399.0],
                        [Date.UTC(2016,08,25), 5640446.0],
                        [Date.UTC(2016,08,26), 54174975.0],
                        [Date.UTC(2016,08,27), 50457443.0]],
                  pointStart: Date.UTC(2016, 0, 1),
                  pointInterval: 24 * 3600 * 1000, // one day
                  yAxis: 0,
                  marker: {
                      enabled: "true",
                      radius: 6
                  },
              }
              ]
          })
      });
  </script>

<script>
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });
        // Create the chart
        $('#code2').highcharts('StockChart', {
            chart: {
                type: 'line',
                borderColor: '#000000',
                borderWidth: 1,
                borderRadius: 6
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Audio Minutes by Product and Call Type'
            },
            yAxis: {
                title: {
                    text: 'Minutes',
                    style: {
                        color: Highcharts.getOptions().colors[1],
                        "fontWeight": "bold"
                    }
                },
                  plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
                }]
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                day: '%m/%d'
              },
              title: {
                  text: 'Date'
              }
            },
            tooltip: {
                dateTimeLabelFormats: {
                  second: '%b %Y',
                  minute: '%b %Y',
                  hour: '%b %Y',
                  day: '%b %Y',
                  week: '%b %Y',
                  month: '%b %Y',
                  year: '%Y'
                }
            },
            series: [{
                name: 'G2M-P',
                data: [[Date.UTC(2016,08,01), 15311026.0],
                      [Date.UTC(2016,08,02), 10775063.0],
                      [Date.UTC(2016,08,03), 300551.0],
                      [Date.UTC(2016,08,04), 286770.0],
                      [Date.UTC(2016,08,05), 1652158.0],
                      [Date.UTC(2016,08,06), 14492342.0],
                      [Date.UTC(2016,08,07), 16386368.0],
                      [Date.UTC(2016,08,08), 16492914.0],
                      [Date.UTC(2016,08,09), 14853268.0],
                      [Date.UTC(2016,08,10), 480076.0],
                      [Date.UTC(2016,08,11), 395755.0],
                      [Date.UTC(2016,08,12), 14037170.0],
                      [Date.UTC(2016,08,13), 15654887.0],
                      [Date.UTC(2016,08,14), 15466667.0],
                      [Date.UTC(2016,08,15), 15517020.0],
                      [Date.UTC(2016,08,16), 13498027.0],
                      [Date.UTC(2016,08,17), 454648.0],
                      [Date.UTC(2016,08,18), 378549.0],
                      [Date.UTC(2016,08,19), 14073348.0],
                      [Date.UTC(2016,08,20), 12677385.0],
                      [Date.UTC(2016,08,21), 15529760.0],
                      [Date.UTC(2016,08,22), 15702973.0],
                      [Date.UTC(2016,08,23), 13516387.0],
                      [Date.UTC(2016,08,24), 449584.0],
                      [Date.UTC(2016,08,25), 383301.0],
                      [Date.UTC(2016,08,26), 14158400.0],
                      [Date.UTC(2016,08,27), 11871619.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'G2M-V',
                data: [[Date.UTC(2016,08,01), 17348985.0],
                      [Date.UTC(2016,08,02), 13804230.0],
                      [Date.UTC(2016,08,03), 2530258.0],
                      [Date.UTC(2016,08,04), 1944880.0],
                      [Date.UTC(2016,08,05), 6104926.0],
                      [Date.UTC(2016,08,06), 17188751.0],
                      [Date.UTC(2016,08,07), 18583345.0],
                      [Date.UTC(2016,08,08), 18578046.0],
                      [Date.UTC(2016,08,09), 16044918.0],
                      [Date.UTC(2016,08,10), 3135236.0],
                      [Date.UTC(2016,08,11), 2288645.0],
                      [Date.UTC(2016,08,12), 15499169.0],
                      [Date.UTC(2016,08,13), 18163463.0],
                      [Date.UTC(2016,08,14), 18045817.0],
                      [Date.UTC(2016,08,15), 17646223.0],
                      [Date.UTC(2016,08,16), 15283749.0],
                      [Date.UTC(2016,08,17), 2999002.0],
                      [Date.UTC(2016,08,18), 2144499.0],
                      [Date.UTC(2016,08,19), 16281908.0],
                      [Date.UTC(2016,08,20), 15152785.0],
                      [Date.UTC(2016,08,21), 18592965.0],
                      [Date.UTC(2016,08,22), 18276828.0],
                      [Date.UTC(2016,08,23), 15812381.0],
                      [Date.UTC(2016,08,24), 3211848.0],
                      [Date.UTC(2016,08,25), 2507117.0],
                      [Date.UTC(2016,08,26), 16716870.0],
                      [Date.UTC(2016,08,27), 14487715.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'G2W-P',
                data: [[Date.UTC(2016,08,01), 1381816.0],
                      [Date.UTC(2016,08,02), 472060.0],
                      [Date.UTC(2016,08,03), 36268.0],
                      [Date.UTC(2016,08,04), 38150.0],
                      [Date.UTC(2016,08,05), 116431.0],
                      [Date.UTC(2016,08,06), 1106250.0],
                      [Date.UTC(2016,08,07), 2016861.0],
                      [Date.UTC(2016,08,08), 2269403.0],
                      [Date.UTC(2016,08,09), 1293458.0],
                      [Date.UTC(2016,08,10), 80300.0],
                      [Date.UTC(2016,08,11), 75604.0],
                      [Date.UTC(2016,08,12), 1055372.0],
                      [Date.UTC(2016,08,13), 2148075.0],
                      [Date.UTC(2016,08,14), 2243864.0],
                      [Date.UTC(2016,08,15), 2269505.0],
                      [Date.UTC(2016,08,16), 1130712.0],
                      [Date.UTC(2016,08,17), 63273.0],
                      [Date.UTC(2016,08,18), 64585.0],
                      [Date.UTC(2016,08,19), 1106352.0],
                      [Date.UTC(2016,08,20), 1766951.0],
                      [Date.UTC(2016,08,21), 2316494.0],
                      [Date.UTC(2016,08,22), 2318868.0],
                      [Date.UTC(2016,08,23), 1075448.0],
                      [Date.UTC(2016,08,24), 80976.0],
                      [Date.UTC(2016,08,25), 71807.0],
                      [Date.UTC(2016,08,26), 1045534.0],
                      [Date.UTC(2016,08,27), 1649419.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'G2W-V',
                data: [[Date.UTC(2016,08,01), 11557504.0],
                [Date.UTC(2016,08,02), 5898501.0],
                [Date.UTC(2016,08,03), 1820160.0],
                [Date.UTC(2016,08,04), 1512377.0],
                [Date.UTC(2016,08,05), 4110796.0],
                [Date.UTC(2016,08,06), 10458348.0],
                [Date.UTC(2016,08,07), 13548460.0],
                [Date.UTC(2016,08,08), 15302613.0],
                [Date.UTC(2016,08,09), 7935088.0],
                [Date.UTC(2016,08,10), 2971269.0],
                [Date.UTC(2016,08,11), 1749798.0],
                [Date.UTC(2016,08,12), 8339337.0],
                [Date.UTC(2016,08,13), 14555266.0],
                [Date.UTC(2016,08,14), 15166432.0],
                [Date.UTC(2016,08,15), 15835067.0],
                [Date.UTC(2016,08,16), 7923132.0],
                [Date.UTC(2016,08,17), 2986618.0],
                [Date.UTC(2016,08,18), 1776588.0],
                [Date.UTC(2016,08,19), 9241516.0],
                [Date.UTC(2016,08,20), 12077093.0],
                [Date.UTC(2016,08,21), 16092282.0],
                [Date.UTC(2016,08,22), 16369249.0],
                [Date.UTC(2016,08,23), 8332494.0],
                [Date.UTC(2016,08,24), 2631127.0],
                [Date.UTC(2016,08,25), 2196158.0],
                [Date.UTC(2016,08,26), 9031966.0],
                [Date.UTC(2016,08,27), 10845129.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'G2T-P',
                data: [[Date.UTC(2016,08,01), 244864.0],
                [Date.UTC(2016,08,02), 115470.0],
                [Date.UTC(2016,08,03), 6429.0],
                [Date.UTC(2016,08,04), 3221.0],
                [Date.UTC(2016,08,05), 22270.0],
                [Date.UTC(2016,08,06), 252350.0],
                [Date.UTC(2016,08,07), 338306.0],
                [Date.UTC(2016,08,08), 322233.0],
                [Date.UTC(2016,08,09), 219800.0],
                [Date.UTC(2016,08,10), 10287.0],
                [Date.UTC(2016,08,11), 5688.0],
                [Date.UTC(2016,08,12), 237870.0],
                [Date.UTC(2016,08,13), 356781.0],
                [Date.UTC(2016,08,14), 346478.0],
                [Date.UTC(2016,08,15), 364328.0],
                [Date.UTC(2016,08,16), 174132.0],
                [Date.UTC(2016,08,17), 7762.0],
                [Date.UTC(2016,08,18), 4506.0],
                [Date.UTC(2016,08,19), 237331.0],
                [Date.UTC(2016,08,20), 266951.0],
                [Date.UTC(2016,08,21), 390144.0],
                [Date.UTC(2016,08,22), 338709.0],
                [Date.UTC(2016,08,23), 203493.0],
                [Date.UTC(2016,08,24), 7048.0],
                [Date.UTC(2016,08,25), 5713.0],
                [Date.UTC(2016,08,26), 202521.0],
                [Date.UTC(2016,08,27), 233280.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'G2T-V',
                data: [[Date.UTC(2016,08,01), 1150105.0],
                [Date.UTC(2016,08,02), 754117.0],
                [Date.UTC(2016,08,03), 185637.0],
                [Date.UTC(2016,08,04), 111296.0],
                [Date.UTC(2016,08,05), 425002.0],
                [Date.UTC(2016,08,06), 1339191.0],
                [Date.UTC(2016,08,07), 1540589.0],
                [Date.UTC(2016,08,08), 1457417.0],
                [Date.UTC(2016,08,09), 943841.0],
                [Date.UTC(2016,08,10), 315144.0],
                [Date.UTC(2016,08,11), 182182.0],
                [Date.UTC(2016,08,12), 1036894.0],
                [Date.UTC(2016,08,13), 1757125.0],
                [Date.UTC(2016,08,14), 1589524.0],
                [Date.UTC(2016,08,15), 1598021.0],
                [Date.UTC(2016,08,16), 878693.0],
                [Date.UTC(2016,08,17), 219421.0],
                [Date.UTC(2016,08,18), 132792.0],
                [Date.UTC(2016,08,19), 1257853.0],
                [Date.UTC(2016,08,20), 1172030.0],
                [Date.UTC(2016,08,21), 1733582.0],
                [Date.UTC(2016,08,22), 1567209.0],
                [Date.UTC(2016,08,23), 1060226.0],
                [Date.UTC(2016,08,24), 281859.0],
                [Date.UTC(2016,08,25), 155975.0],
                [Date.UTC(2016,08,26), 1159561.0],
                [Date.UTC(2016,08,27), 896991.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFM-P',
                data: [[Date.UTC(2016,08,01), 3766479.0],
                [Date.UTC(2016,08,02), 2508020.0],
                [Date.UTC(2016,08,03), 35573.0],
                [Date.UTC(2016,08,04), 35896.0],
                [Date.UTC(2016,08,05), 418342.0],
                [Date.UTC(2016,08,06), 3431092.0],
                [Date.UTC(2016,08,07), 3922819.0],
                [Date.UTC(2016,08,08), 4035001.0],
                [Date.UTC(2016,08,09), 3350394.0],
                [Date.UTC(2016,08,10), 63686.0],
                [Date.UTC(2016,08,11), 59981.0],
                [Date.UTC(2016,08,12), 3290252.0],
                [Date.UTC(2016,08,13), 3716138.0],
                [Date.UTC(2016,08,14), 3799067.0],
                [Date.UTC(2016,08,15), 3812227.0],
                [Date.UTC(2016,08,16), 3134807.0],
                [Date.UTC(2016,08,17), 87779.0],
                [Date.UTC(2016,08,18), 61701.0],
                [Date.UTC(2016,08,19), 3240281.0],
                [Date.UTC(2016,08,20), 3117024.0],
                [Date.UTC(2016,08,21), 3842736.0],
                [Date.UTC(2016,08,22), 3855953.0],
                [Date.UTC(2016,08,23), 3164442.0],
                [Date.UTC(2016,08,24), 55192.0],
                [Date.UTC(2016,08,25), 62697.0],
                [Date.UTC(2016,08,26), 3308741.0],
                [Date.UTC(2016,08,27), 2932334.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFM-V',
                data: [[Date.UTC(2016,08,01), 3951248.0],
                [Date.UTC(2016,08,02), 3070059.0],
                [Date.UTC(2016,08,03), 180628.0],
                [Date.UTC(2016,08,04), 104413.0],
                [Date.UTC(2016,08,05), 1078429.0],
                [Date.UTC(2016,08,06), 3727431.0],
                [Date.UTC(2016,08,07), 4081142.0],
                [Date.UTC(2016,08,08), 4222224.0],
                [Date.UTC(2016,08,09), 3581622.0],
                [Date.UTC(2016,08,10), 190708.0],
                [Date.UTC(2016,08,11), 135764.0],
                [Date.UTC(2016,08,12), 3425586.0],
                [Date.UTC(2016,08,13), 3934964.0],
                [Date.UTC(2016,08,14), 4008048.0],
                [Date.UTC(2016,08,15), 3881549.0],
                [Date.UTC(2016,08,16), 3385382.0],
                [Date.UTC(2016,08,17), 228197.0],
                [Date.UTC(2016,08,18), 159838.0],
                [Date.UTC(2016,08,19), 3460075.0],
                [Date.UTC(2016,08,20), 3261175.0],
                [Date.UTC(2016,08,21), 3928902.0],
                [Date.UTC(2016,08,22), 4003571.0],
                [Date.UTC(2016,08,23), 3423841.0],
                [Date.UTC(2016,08,24), 180678.0],
                [Date.UTC(2016,08,25), 140673.0],
                [Date.UTC(2016,08,26), 3613358.0],
                [Date.UTC(2016,08,27), 3155003.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFW-P',
                data: [[Date.UTC(2016,08,01), 264788.0],
                [Date.UTC(2016,08,02), 77363.0],
                [Date.UTC(2016,08,03), 1.0],
                [Date.UTC(2016,08,04), 592.0],
                [Date.UTC(2016,08,05), 6288.0],
                [Date.UTC(2016,08,06), 195289.0],
                [Date.UTC(2016,08,07), 494687.0],
                [Date.UTC(2016,08,08), 385285.0],
                [Date.UTC(2016,08,09), 167513.0],
                [Date.UTC(2016,08,10), 2580.0],
                [Date.UTC(2016,08,11), 3232.0],
                [Date.UTC(2016,08,12), 199724.0],
                [Date.UTC(2016,08,13), 471994.0],
                [Date.UTC(2016,08,14), 436912.0],
                [Date.UTC(2016,08,15), 455657.0],
                [Date.UTC(2016,08,16), 205200.0],
                [Date.UTC(2016,08,17), 5272.0],
                [Date.UTC(2016,08,18), 320.0],
                [Date.UTC(2016,08,19), 217424.0],
                [Date.UTC(2016,08,20), 358241.0],
                [Date.UTC(2016,08,21), 521958.0],
                [Date.UTC(2016,08,22), 547878.0],
                [Date.UTC(2016,08,23), 227532.0],
                [Date.UTC(2016,08,24), 11351.0],
                [Date.UTC(2016,08,25), 1524.0],
                [Date.UTC(2016,08,26), 235237.0],
                [Date.UTC(2016,08,27), 395189.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFW-V',
                data: [[Date.UTC(2016,08,01), 786811.0],
                [Date.UTC(2016,08,02), 290189.0],
                [Date.UTC(2016,08,03), 6890.0],
                [Date.UTC(2016,08,04), 10007.0],
                [Date.UTC(2016,08,05), 447978.0],
                [Date.UTC(2016,08,06), 663541.0],
                [Date.UTC(2016,08,07), 1653966.0],
                [Date.UTC(2016,08,08), 1123917.0],
                [Date.UTC(2016,08,09), 545531.0],
                [Date.UTC(2016,08,10), 40223.0],
                [Date.UTC(2016,08,11), 7599.0],
                [Date.UTC(2016,08,12), 729582.0],
                [Date.UTC(2016,08,13), 1199256.0],
                [Date.UTC(2016,08,14), 1350203.0],
                [Date.UTC(2016,08,15), 1227418.0],
                [Date.UTC(2016,08,16), 451663.0],
                [Date.UTC(2016,08,17), 22483.0],
                [Date.UTC(2016,08,18), 12608.0],
                [Date.UTC(2016,08,19), 1491797.0],
                [Date.UTC(2016,08,20), 1298368.0],
                [Date.UTC(2016,08,21), 2119647.0],
                [Date.UTC(2016,08,22), 1412771.0],
                [Date.UTC(2016,08,23), 579755.0],
                [Date.UTC(2016,08,24), 44671.0],
                [Date.UTC(2016,08,25), 16196.0],
                [Date.UTC(2016,08,26), 1187061.0],
                [Date.UTC(2016,08,27), 1184657.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFT-P',
                data: [[Date.UTC(2016,08,01), 67366.0],
                [Date.UTC(2016,08,02), 31047.0],
                [Date.UTC(2016,08,03), 288.0],
                [Date.UTC(2016,08,04), 7.0],
                [Date.UTC(2016,08,05), 3798.0],
                [Date.UTC(2016,08,06), 44008.0],
                [Date.UTC(2016,08,07), 71182.0],
                [Date.UTC(2016,08,08), 76824.0],
                [Date.UTC(2016,08,09), 41225.0],
                [Date.UTC(2016,08,10), 1831.0],
                [Date.UTC(2016,08,11), 1053.0],
                [Date.UTC(2016,08,12), 62494.0],
                [Date.UTC(2016,08,13), 87033.0],
                [Date.UTC(2016,08,14), 86824.0],
                [Date.UTC(2016,08,15), 92069.0],
                [Date.UTC(2016,08,16), 54827.0],
                [Date.UTC(2016,08,17), 553.0],
                [Date.UTC(2016,08,18), 477.0],
                [Date.UTC(2016,08,19), 62467.0],
                [Date.UTC(2016,08,20), 65054.0],
                [Date.UTC(2016,08,21), 77129.0],
                [Date.UTC(2016,08,22), 72552.0],
                [Date.UTC(2016,08,23), 36781.0],
                [Date.UTC(2016,08,24), 1.0],
                [Date.UTC(2016,08,25), 391.0],
                [Date.UTC(2016,08,26), 55700.0],
                [Date.UTC(2016,08,27), 61123.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'ITFT-V',
                data: [[Date.UTC(2016,08,01), 170290.0],
                [Date.UTC(2016,08,02), 78110.0],
                [Date.UTC(2016,08,03), 3665.0],
                [Date.UTC(2016,08,04), 3749.0],
                [Date.UTC(2016,08,05), 19161.0],
                [Date.UTC(2016,08,06), 120338.0],
                [Date.UTC(2016,08,07), 185233.0],
                [Date.UTC(2016,08,08), 168097.0],
                [Date.UTC(2016,08,09), 109181.0],
                [Date.UTC(2016,08,10), 21045.0],
                [Date.UTC(2016,08,11), 8661.0],
                [Date.UTC(2016,08,12), 125964.0],
                [Date.UTC(2016,08,13), 209428.0],
                [Date.UTC(2016,08,14), 180851.0],
                [Date.UTC(2016,08,15), 205893.0],
                [Date.UTC(2016,08,16), 115891.0],
                [Date.UTC(2016,08,17), 5458.0],
                [Date.UTC(2016,08,18), 4116.0],
                [Date.UTC(2016,08,19), 160536.0],
                [Date.UTC(2016,08,20), 176692.0],
                [Date.UTC(2016,08,21), 179085.0],
                [Date.UTC(2016,08,22), 182115.0],
                [Date.UTC(2016,08,23), 114228.0],
                [Date.UTC(2016,08,24), 5772.0],
                [Date.UTC(2016,08,25), 12050.0],
                [Date.UTC(2016,08,26), 128288.0],
                [Date.UTC(2016,08,27), 110034.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'OV',
                data: [[Date.UTC(2016,08,01), 3186184.0],
                [Date.UTC(2016,08,02), 2244856.0],
                [Date.UTC(2016,08,03), 43388.0],
                [Date.UTC(2016,08,04), 45661.0],
                [Date.UTC(2016,08,05), 228069.0],
                [Date.UTC(2016,08,06), 3385058.0],
                [Date.UTC(2016,08,07), 3476925.0],
                [Date.UTC(2016,08,08), 3503843.0],
                [Date.UTC(2016,08,09), 3112397.0],
                [Date.UTC(2016,08,10), 82212.0],
                [Date.UTC(2016,08,11), 86939.0],
                [Date.UTC(2016,08,12), 3375425.0],
                [Date.UTC(2016,08,13), 3450699.0],
                [Date.UTC(2016,08,14), 3208047.0],
                [Date.UTC(2016,08,15), 3287240.0],
                [Date.UTC(2016,08,16), 2926968.0],
                [Date.UTC(2016,08,17), 85924.0],
                [Date.UTC(2016,08,18), 83097.0],
                [Date.UTC(2016,08,19), 3405686.0],
                [Date.UTC(2016,08,20), 2776078.0],
                [Date.UTC(2016,08,21), 3181646.0],
                [Date.UTC(2016,08,22), 3244533.0],
                [Date.UTC(2016,08,23), 2965796.0],
                [Date.UTC(2016,08,24), 67642.0],
                [Date.UTC(2016,08,25), 68400.0],
                [Date.UTC(2016,08,26), 3226727.0],
                [Date.UTC(2016,08,27), 2558010.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            }
            ]
        })
    });
</script>

<script>
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });
        // Create the chart
        $('#code3').highcharts('StockChart', {
            chart: {
                type: 'column',
                borderColor: '#000000',
                borderWidth: 1,
                borderRadius: 6
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Daily Calls Stacked by Call Type'
            },
            yAxis: {
                title: {
                    text: 'Minutes',
                    style: {
                        color: Highcharts.getOptions().colors[1],
                        "fontWeight": "bold"
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                }
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                day: '%m/%d'
              },
              title: {
                  text: 'Date'
              }
            },
            tooltip: {
                dateTimeLabelFormats: {
                  second: '%b %Y',
                  minute: '%b %Y',
                  hour: '%b %Y',
                  day: '%b %Y',
                  week: '%b %Y',
                  month: '%b %Y',
                  year: '%Y'
                }
            },
            plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                  }
                }
            },
            series: [{
                name: 'PSTN',
                data: [[Date.UTC(2016,08,01), 723725.0],
                [Date.UTC(2016,08,02), 498477.0],
                [Date.UTC(2016,08,03), 16577.0],
                [Date.UTC(2016,08,04), 15780.0],
                [Date.UTC(2016,08,05), 83999.0],
                [Date.UTC(2016,08,06), 709237.0],
                [Date.UTC(2016,08,07), 784148.0],
                [Date.UTC(2016,08,08), 795324.0],
                [Date.UTC(2016,08,09), 664329.0],
                [Date.UTC(2016,08,10), 22528.0],
                [Date.UTC(2016,08,11), 20999.0],
                [Date.UTC(2016,08,12), 672536.0],
                [Date.UTC(2016,08,13), 756017.0],
                [Date.UTC(2016,08,14), 746810.0],
                [Date.UTC(2016,08,15), 755299.0],
                [Date.UTC(2016,08,16), 629724.0],
                [Date.UTC(2016,08,17), 19644.0],
                [Date.UTC(2016,08,18), 19411.0],
                [Date.UTC(2016,08,19), 701170.0],
                [Date.UTC(2016,08,20), 648603.0],
                [Date.UTC(2016,08,21), 755358.0],
                [Date.UTC(2016,08,22), 765901.0],
                [Date.UTC(2016,08,23), 637173.0],
                [Date.UTC(2016,08,24), 21237.0],
                [Date.UTC(2016,08,25), 19817.0],
                [Date.UTC(2016,08,26), 682614.0],
                [Date.UTC(2016,08,27), 619212.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            },
            {
                name: 'VoIP',
                data: [[Date.UTC(2016,08,01), 870614.0],
                [Date.UTC(2016,08,02), 609306.0],
                [Date.UTC(2016,08,03), 99737.0],
                [Date.UTC(2016,08,04), 82630.0],
                [Date.UTC(2016,08,05), 298732.0],
                [Date.UTC(2016,08,06), 855434.0],
                [Date.UTC(2016,08,07), 972982.0],
                [Date.UTC(2016,08,08), 1048009.0],
                [Date.UTC(2016,08,09), 738163.0],
                [Date.UTC(2016,08,10), 129665.0],
                [Date.UTC(2016,08,11), 93970.0],
                [Date.UTC(2016,08,12), 746218.0],
                [Date.UTC(2016,08,13), 964042.0],
                [Date.UTC(2016,08,14), 980322.0],
                [Date.UTC(2016,08,15), 992749.0],
                [Date.UTC(2016,08,16), 698249.0],
                [Date.UTC(2016,08,17), 118979.0],
                [Date.UTC(2016,08,18), 94472.0],
                [Date.UTC(2016,08,19), 835001.0],
                [Date.UTC(2016,08,20), 882734.0],
                [Date.UTC(2016,08,21), 1033706.0],
                [Date.UTC(2016,08,22), 999854.0],
                [Date.UTC(2016,08,23), 718799.0],
                [Date.UTC(2016,08,24), 139117.0],
                [Date.UTC(2016,08,25), 105773.0],
                [Date.UTC(2016,08,26), 794479.0],
                [Date.UTC(2016,08,27), 812871.0]],
                pointStart: Date.UTC(2016, 0, 1),
                pointInterval: 24 * 3600 * 1000, // one day
                yAxis: 0,
                marker: {
                    enabled: "true",
                    radius: 6
                },
            }
            ]
        })
    });
</script>
@endsection

@section('main-content')

 
          <div id="code3"  class="col-md-6" style="height: 500px"></div>
          <div id="code" class="col-md-6" style="height: 500px"></div>
          <div id="code2" class="col-md-6" style="height: 500px; min-width: 300px"></div>

@endsection
