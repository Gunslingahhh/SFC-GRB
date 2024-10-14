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
                    $stmt = $conn->prepare("SELECT DISTINCT species_class FROM species");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $species_class = $row['species_class'];

                        // Count total species for the current species class
                        $count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM species WHERE species_class = ?");
                        $count_stmt->bind_param("s", $species_class);
                        $count_stmt->execute();
                        $count_result = $count_stmt->get_result();
                        $count_row = $count_result->fetch_assoc();
                        $total_species = $count_row['total'];

                        // Add species class and count to the 2D array
                        $species_data[] = [
                            'species_class' => $species_class,
                            'total_species' => $total_species
                        ];
                    }

                    echo '<div id="information-container">';
                    foreach ($species_data as $data) {
                        echo '<div class="flex-item">' . $data['species_class'] . "<br><br>" . "<b>" . $data['total_species'] ."</b>" . '</div>';
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