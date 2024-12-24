<?php
    session_start();
    // Include the database connection file
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
        <script src="adminkit-main/static/js/app.js"></script>
    </head>
    <body>
        <?php include "php/index_header.php";
			$species_data = [];

			// Fetch all distinct species classes
			$stmt = $conn->prepare("SELECT DISTINCT specimen_class FROM specimen");
			$stmt->execute();
			$result = $stmt->get_result();

			while ($row = $result->fetch_assoc()) {
				$specimen_class = $row['specimen_class'];

				// Count total species for the current species class
				$count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM specimen WHERE specimen_class = ?");
				$count_stmt->bind_param("s", $specimen_class);
				$count_stmt->execute();
				$count_result = $count_stmt->get_result();
				$count_row = $count_result->fetch_assoc();
				$total_specimen = $count_row['total'];

				// Add species class and count to the 2D array
				$species_data[] = [
					'specimen_class' => $specimen_class,
					'total_specimen' => $total_specimen
				];
			}

			// Encode data as JSON for the chart
			$json_data = json_encode($species_data);

			// Output the HTML and JavaScript for the chart
			echo <<<HTML
			<div class="d-flex justify-content-center pie-chart-size">
				<div class="card w-100">
					<div class="card-body main-color d-flex justify-content-center p-4"> <!-- background-container -->
						<div class="card w-75 d-flex justify-content-center">
							<div class="card-body d-flex flex-column justify-content-center align-items-center">
								<div class="d-flex justify-content-center w-75">
									<canvas id="chartjs-dashboard-pie"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					const chartData = JSON.parse('$json_data'); // Parse the JSON data from PHP
		
					const labels = chartData.map(item => item.specimen_class);
					const dataValues = chartData.map(item => item.total_specimen);
		
					new Chart(document.getElementById("chartjs-dashboard-pie"), {
						type: "pie",
						data: {
							labels: labels,
							datasets: [{
								data: dataValues,
								backgroundColor: [
									"#007bff", // Blue (Bootstrap Primary)
									"#dc3545", // Red (Bootstrap Danger)
									"#ffc107", // Yellow (Bootstrap Warning)
									"#28a745", // Green (Bootstrap Success)
									"#17a2b8", // Cyan (Bootstrap Info)
									"#6f42c1", // Indigo
									"#e83e8c", // Pink
									"#fd7e14", // Orange
									"#6c757d", // Gray (Bootstrap Secondary)
									"#adb5bd", // Light Gray
									"#212529", // Dark Gray
									"#00FFFF", // Aqua
									"#8A2BE2", // Blue Violet
									"#A52A2A", // Brown
									"#DEB887", // BurlyWood
									"#5F9EA0", // Cadet Blue
									"#7FFF00", // Chartreuse
									"#D2691E", // Chocolate
									"#FF7F50", // Coral
									"#6495ED", // Cornflower Blue
									"#00CED1", // Dark Turquoise
									"#9400D3", // Dark Violet
									"#FFD700", // Gold
									"#808000", // Olive
									"#FFA07A", // Light Salmon
									"#DDA0DD", // Plum
									"#800080", // Purple
									"#FA8072", // Salmon
									"#008000", // Green
									"#4682B4", // Steel Blue
								],
								borderWidth: 0
							}]
						},
						options: {
							responsive: true,
							maintainAspectRatio: true,
							legend: {
								display: false // Display the legend (you can customize its position)
							},
							cutoutPercentage: 0 // Make it a full pie chart
						}
					});
				});
			</script>
		HTML;
		?>
    </body>
</html>