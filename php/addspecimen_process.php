<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include "connection.php";

    $id = $_GET['user_id'];

    // In current_page.php
    $sampling_number = $_POST['sampling_number'];
    $sample_class = $_POST['sample_class'];
    $sample_genus = $_POST['sample_genus'];
    $sample_species = $_POST['sample_species'];
    $sample_sex = $_POST['sample_sex'];
    $sample_stage = $_POST['sample_stage'];
    $sample_weight = $_POST['sample_weight'];
    $isVouchered = $_POST['isVouchered'];
    $sample_method = $_POST['sample_method'];

    // Assuming $userData is the array containing the "storage_location" key
    if (isset($_POST['storage_location'])) {
        $storage_location = $_POST['storage_location'];
    } else {
        // Handle missing or empty key (e.g., set a default value)
        $storage_location = '';
    }
    
    $sql = "INSERT INTO specimen (
        user_id,
        specimen_collectionNumber,
        specimen_sex,
        specimen_stage,
        specimen_weight,
        specimen_isVouchered,
        specimen_storageLocationVoucheredSpecimen,
        specimen_class,
        specimen_genus,
        specimen_species,
        specimen_sampleMethod
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $data = array(
        $_SESSION['userid'],
        $sampling_number,
        $sample_sex,
        $sample_stage,
        $sample_weight,
        $isVouchered,
        $storage_location,
        $sample_class,
        $sample_genus,
        $sample_species,
        $sample_method
    );
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issssssssss",
        $_SESSION['userid'],
        $sampling_number,
        $sample_sex,
        $sample_stage,
        $sample_weight,
        $isVouchered,
        $storage_location,
        $sample_class,
        $sample_genus,
        $sample_species,
        $sample_method
    );
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        header("Location: user_home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: user_home.php");
        exit();
    }
    
    $stmt->close();
    $conn->close();

?>