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
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <div id="body-container" class="center">
            <?php
                include "php/index_header.php";
            ?>
            <div id="information-container" class="center">
                <?php
                    
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

                    echo '<div id="information-container">';
                    foreach ($species_data as $data) {
                        echo '<div class="flex-item">' . $data['specimen_class'] . "<br><br>" . "<b>" . $data['total_specimen'] ."</b>" . '</div>';
                    }
                    echo '</div>';

                    $stmt->close();
                    $count_stmt->close();
                    $conn->close();
                ?>
            </div>
        </div>
    </body>
</html>