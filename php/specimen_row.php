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
        $stage=$user_row['specimen_stage'];
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
        <link href="../css/styles.css" rel="stylesheet">
        <script src="../js/settings.js"></script>
    </head>
    <body class="third-color">
        <div class="grid-container center">
            <?php 
                include "sidenav.php";
            ?>
            <main class="col ps-md-0 main-content">
                <div class="ms-3">
                    <?php
                        $buttonText = "Add subsample +";
                        $buttonLink = "addsubsample.php?specimen_id=" . $id; // Concatenate the string and $id
                        $searchPlaceholder = "Search for subsample";
                        $searchAction = "#";
                        include "topnav.php";
                    ?>
                    <h2 class="fw-bold">SFC-GRB-<?php echo($id) ?></h2>
                    
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr class="text-center">
                                <th>Collection Number</th>
                                <th>Sex</th>
                                <th>Stage</th>
                                <th>Weight</th>
                                <th>Vouchered?</th>
                                <th>Storage location of vouchered specimen</th>
                                <th>Class</th>
                                <th>Genus</th>
                                <th>Species</th>
                                <th>Sample Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td><?php echo $collectionNumber ?></td>
                                <td><?php echo $sex ?></td>
                                <td><?php echo $stage ?></td>
                                <td><?php echo $weight ?> kg</td>
                                <td><?php echo $isVouchered ?></td>
                                <td><?php echo $storageLocationVoucheredSpecimen ?></td>
                                <td><?php echo $class ?></td>
                                <td><?php echo $genus ?></td>
                                <td><?php echo $species ?></td>
                                <td><?php echo $sampleMethod ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover mt-5">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>Subsample ID</th>
                                <th>Raw Sequence</th>
                                <th>Cleaned Sequence</th>
                                <th>Photo Identification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = $conn->prepare("SELECT subSample_id, subSample_rawSequence, subSample_cleanedSequence, subSample_photoIdentification FROM subSample WHERE specimen_id = $id");
                                $sql->execute();
                                $result = $sql->get_result();

                                $rawSequence_status="../assets/image/wrong.png";
                                $cleanedSequence_status="../assets/image/wrong.png";
                                $photoIdentification_status="../assets/image/wrong.png";

                                while ($subsample_row = $result->fetch_assoc()){
                                    if($subsample_row['subSample_rawSequence']!=""){
                                        $rawSequence_status="../assets/image/correct.png";
                                    }else{
                                        $rawSequence_status="../assets/image/wrong.png";
                                    }
                                    
                                    if($subsample_row['subSample_cleanedSequence']!=""){
                                        $cleanedSequence_status="../assets/image/correct.png";
                                    }else{
                                        $cleanedSequence_status="../assets/image/wrong.png";
                                    }
        
                                    if($subsample_row['subSample_photoIdentification']!=""){
                                        $photoIdentification_status="../assets/image/correct.png";
                                    }else{
                                        $photoIdentification_status="../assets/image/wrong.png";
                                    }
                                    
                                    // echo "<tr onclick='window.location.href = \"editsubsample.php?subSample_id=" . $subsample_row['subSample_id'] . "\";'>";
                                    echo "<tr role='button' onclick='window.location.href = \"editsubsample.php?subSample_id=" . $subsample_row['subSample_id'] . "\";'>";
                                    echo "<td class='text-center'>" . $subsample_row['subSample_id'] . "</td>";
                                    echo "<td class='text-center'><img class='img-fluid rounded-circle' width='15px' src='" . $rawSequence_status . "'></td>";
                                    echo "<td class='text-center'><img class='img-fluid rounded-circle' width='15px' src='" . $cleanedSequence_status . "'></td>";
                                    echo "<td class='text-center'><img class='img-fluid rounded-circle' width='15px' src='" . $photoIdentification_status . "'></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </body>
</html>