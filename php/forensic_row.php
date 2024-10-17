<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['id'];

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
        $locationCapture=$user_row['specimen_locationCapture'];
        $latitude=$user_row['specimen_latitude'];
        $longitude=$user_row['specimen_longitude'];
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
        <link rel="stylesheet" href="../css/forensic_row.css">
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            </div>
            <div class="item2">
                <h1>Sample ID: SFC-GRB-<?php echo($id) ?></h1>
            </div>
            <div class="item3">
                <div id="info-container" class="center">
                    <p><b>Sampling collection number:</b> <?php echo($collectionNumber) ?></p>
                    <p><b>Location of capture:</b> <?php echo($locationCapture) ?></p>
                    <p><b>GPS of capture:</b> <?php echo($latitude . "&nbsp&nbsp" . $longitude) ?></p>
                    <p><b>Class:</b> <?php echo($class) ?></p>
                    <p><b>Genus:</b> <?php echo($genus) ?></p>
                    <p><b>Species:</b> <?php echo($species) ?></p>
                    <p><b>Sex:</b> <?php echo($sex) ?></p>
                    <p><b>Age:</b> <?php echo($age) ?></p>
                    <p><b>Weight:</b> <?php echo($weight) ?> kg</p>
                    <p><b>Vouchered?:</b> <?php echo($isVouchered) ?></p>
                    <p><b>Sampling Method:</b> <?php echo($sampleMethod) ?></p>
                </div>

                <a href="addsubsample.php" id="add-subsample-button">
                    Add Subsample
                </a>

                <form id="search-form">
                    <input type="text" id="search-box">
                    <input type="submit" id="search-button" value="Q">
                </form>

                <table class="center">
                    <tr>
                        <th>Subsample ID</th>
                        <th>Raw Sequence</th>
                        <th>Cleaned Sequence</th>
                        <th>Photo Identification</th>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>