<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/forensic_home.css">
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            </div>
            <div class="item2">
                <form id="search-form">
                    <input type="text" name="search-box" id="search-box">
                    <input type="submit" id="search-button" value="Q">
                </form>
            </div>
            <div class="item3">
                <table class="center">
                    <thead>
                        <tr>
                            <th>Specimen ID</th>
                            <th>Class</th>
                            <th>Genus</th>
                            <th>Species</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $forensic_sql = "SELECT specimen.specimen_id, specimen.specimen_class, specimen.specimen_genus, specimen.specimen_species, user.user_id, user.user_fullname, user.user_contactNumber, user.user_email
                            FROM specimen
                            JOIN user ON specimen.user_id = user.user_id";

                            $forensic_stmt = $conn->prepare($forensic_sql);
                            $forensic_stmt->execute();
                            $forensic_result = $forensic_stmt->get_result();

                            while ($forensic_row = $forensic_result->fetch_assoc()) {
                                echo "<tr onclick='window.location.href = \"forensic_row.php?id=" . $forensic_row['specimen_id'] . "\";'>";
                                    echo "<td>" . $forensic_row['specimen_id'] . "</td>";
                                    echo "<td>" . $forensic_row['specimen_class'] . "</td>";
                                    echo "<td>" . $forensic_row['specimen_genus'] . "</td>";
                                    echo "<td>" . $forensic_row['specimen_species'] . "</td>";
                                    echo "<td>" . $forensic_row['user_fullname'] . "</td>";
                                    echo "<td>" . $forensic_row['user_contactNumber'] . "</td>";
                                    echo "<td>" . $forensic_row['user_email'] . "</td>";
                                echo "</tr></a>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </body>
</html>