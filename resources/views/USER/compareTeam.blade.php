<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FAS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css">

        <style>
            #chartdiv {
              width: 85%;
              height: 500px;
              margin-left: 75px;
              margin-bottom: 25px;
              margin-top: 25px;
            }
            </style>

            <!-- Resources -->
            <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/themes/Dark.js"></script>

            <!-- Chart code -->
            <script>
            am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
              am5themes_Dark.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(
              am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.verticalLayout,
                arrangeTooltips: false
              })
            );

            // Use only absolute numbers
            chart.getNumberFormatter().set("numberFormat", "#.#s");

            // Add legend
            // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
            var legend = chart.children.push(
              am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
              })
            );

            // Data
            var data = [
                {
                Category: "Played",
                '@php echo $f_team->team @endphp': -@php echo $f_team->played @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->played @endphp
              },
                {
                Category: "Wins",
                '@php echo $f_team->team @endphp': -@php echo $f_team->wins @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->wins @endphp
              },
              {
                Category: "Draws",
                '@php echo $f_team->team @endphp': -@php echo $f_team->ties @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->ties @endphp
              },
                {
                Category: "Loses",
                '@php echo $f_team->team @endphp': -@php echo $f_team->loses @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->loses @endphp
              },
                {
                Category: "Goals",
                '@php echo $f_team->team @endphp': -@php echo $f_team->goals @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->goals @endphp
              },
              {
                Category: "Clean sheets",
                '@php echo $f_team->team @endphp': -@php echo $f_team->clean_sheets @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->clean_sheets @endphp
              },
              {
                Category: "Yellow cards",
                '@php echo $f_team->team @endphp': -@php echo $f_team->yellow_cards @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->yellow_cards @endphp
              },
              {
                Category: "Red cards",
                '@php echo $f_team->team @endphp': -@php echo $f_team->red_cards @endphp,
                '@php echo $s_team->team @endphp': @php echo $s_team->red_cards @endphp
              },
            ];

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var yAxis = chart.yAxes.push(
              am5xy.CategoryAxis.new(root, {
                categoryField: "Category",
                renderer: am5xy.AxisRendererY.new(root, {
                  inversed: true,
                  cellStartLocation: 0.1,
                  cellEndLocation: 0.9
                })
              })
            );

            yAxis.data.setAll(data);

            var xAxis = chart.xAxes.push(
              am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererX.new(root, {
                  strokeOpacity: 0.1
                })
              })
            );

            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            function createSeries(field, labelCenterX, pointerOrientation, rangeValue) {
              var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                  xAxis: xAxis,
                  yAxis: yAxis,
                  valueXField: field,
                  categoryYField: "Category",
                  sequencedInterpolation: true,
                  clustered: false,
                  tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: pointerOrientation,
                    labelText: "{categoryY}: {valueX}"
                  })
                })
              );

              series.columns.template.setAll({
                height: am5.p100,
                strokeOpacity: 0,
                fillOpacity: 0.8
              });

              series.bullets.push(function() {
                return am5.Bullet.new(root, {
                  locationX: 1,
                  locationY: 0.5,
                  sprite: am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "{valueX}",
                    populateText: true,
                    centerX: labelCenterX
                  })
                });
              });

              series.data.setAll(data);
              series.appear();

              var rangeDataItem = xAxis.makeDataItem({
                value: rangeValue
              });
              xAxis.createAxisRange(rangeDataItem);
              rangeDataItem.get("grid").setAll({
                strokeOpacity: 1,
                stroke: series.get("stroke")
              });

              var label = rangeDataItem.get("label");
              label.setAll({
                text: field.toUpperCase(),
                fontSize: "1.1em",
                fill: series.get("stroke"),
                paddingTop: -15,
                isMeasured: false,
                centerX: labelCenterX
              });
              label.adapters.add("dy", function() {
                return -chart.plotContainer.height();
              });

              return series;
            }

            createSeries('@php echo $f_team->team @endphp', am5.p100, "right", -5);
            createSeries('@php echo $s_team->team @endphp', 0, "left", 5);

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
              behavior: "zoomY"
            }));
            cursor.lineY.set("forceHidden", true);
            cursor.lineX.set("forceHidden", true);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            chart.appear(1000, 100);

            }); // end am5.ready()
            </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="FootBall" width="70" height="70"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="/">Main</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/teams">Teams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/leagues">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/players">Players</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/fixtures">Fixtures</a>
                    </li>
                  </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link" href="/login">Sign in</a>
                      </li>
                  </ul>
                </div>
              </div>
          </nav>
          <div class="container">
            <div class="row">
                <div class="col">
                    <h2>@php echo $f_team->team @endphp vs @php echo $s_team->team @endphp</h2>
                </div>
            </div>
          </div>

          <div id="chartdiv"></div>
          <div class="overlay"></div>
    </body>
</html>
