<?php
session_start();
include "php/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFC-GRB System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <?php include "php/index_header.php";
        $species_data = [];

        $stmt = $conn->prepare("SELECT DISTINCT specimen_class FROM specimen");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $specimen_class = $row['specimen_class'];

            $count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM specimen WHERE specimen_class = ?");
            $count_stmt->bind_param("s", $specimen_class);
            $count_stmt->execute();
            $count_result = $count_stmt->get_result();
            $count_row = $count_result->fetch_assoc();
            $total_specimen = $count_row['total'];

            $species_data[] = [
                'specimen_class' => $specimen_class,
                'total_specimen' => $total_specimen
            ];
        }

        $json_data = json_encode($species_data);

        echo <<<HTML
        <div class="d-flex justify-content-center pie-chart-size">
            <div class="card w-100">
                <div class="card-body wallpaper d-flex justify-content-center p-4">
                    <div class="card w-50 d-flex justify-content-center">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex justify-content-center w-100">
                                <div id="myChart" class=""></div>  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                const speciesData = JSON.parse('$json_data');

                const dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Specimen Class');
                dataTable.addColumn('number', 'Total Specimens');

                speciesData.forEach(item => {
                    dataTable.addRow([item.specimen_class, item.total_specimen]);
                });

                const options = {
                    title: 'Biomaterial Specimens Collected by Taxa',
                    titlePosition: 'out',
                    is3D: true,
                    legend: {
                        position: 'right',
                        alignment: 'center',
                        textStyle: {
                            color: 'black',
                            fontSize: 25
                        }
                    },
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 30,
                        bold: true,
                        textAlign: 'center'
                    },
                    chartArea: {
                        left: 20,      // Padding on the left side (pixels or percentage)
                        top: 50,       // Padding on the top side
                        right: 90,     // Padding on the right side
                        bottom: 10,    // Padding on the bottom side
                    },
                };

                const chart = new google.visualization.PieChart(document.getElementById('myChart'));
                console.log(options);
                chart.draw(dataTable, options);
            }
        </script>
        HTML;
    ?>
</body>
</html>