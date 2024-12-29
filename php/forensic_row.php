<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['specimen_id'];

    $detail_check = $conn->prepare("SELECT * FROM specimen WHERE specimen_id = $id");
    $detail_check->execute();
    $detail_result = $detail_check->get_result();

    while ($user_row = $detail_result->fetch_assoc()) {
        $collectionNumber=$user_row['specimen_collectionNumber'];
        $sex=$user_row['specimen_sex'];
        $age=$user_row['specimen_age'];
        $weight=$user_row['specimen_weight'];
        $isVouchered=$user_row['specimen_isVouchered'];
        $storageLocationVoucheredSpecimen=$user_row['specimen_storageLocationVoucheredSpecimen'];
        $class=$user_row['specimen_class'];
        $genus=$user_row['specimen_genus'];
        $species=$user_row['specimen_species'];
        $sampleMethod=$user_row['specimen_sampleMethod'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/adduser.css">
        <script src="../js/settings.js"></script>
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            <main class="col ps-md-0 main-content">
                <div class="ms-3">
                    <h2 class="fw-bold">SFC-GRB-<?php echo($id) ?></h2>
                    
                    <table class="table table-bordered mt-5">
                        <thead class="">
                            <tr>
                                <th>Specimen ID</th>
                                <th>Class</th>
                                <th>Genus</th>
                                <th>Species</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>E-mail</th>
                                <th>E-mail</th>
                                <th>E-mail</th>
                                <th>E-mail</th>
                                <th>E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                                <td>Testing</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
            </div>
        </div>
    </body>
</html>