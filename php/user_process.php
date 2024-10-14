<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include "connection.php";

    // In current_page.php
    $sampling_number = $_GET['sampling_number'];
    $location_capture = $_GET['location_capture'];
    $coordinate_northsouth = $_GET['latitude_northsouth'];
    $latitude_degree = $_GET['latitude_degree'];
    $latitude_minutes = $_GET['latitude_minutes'];
    $latitude_seconds = $_GET['latitude_seconds'];
    $coordinate_eastwest = $_GET['longitude_eastwest'];
    $longitude_degree = $_GET['longitude_degree'];
    $longitude_minutes = $_GET['longitude_minutes'];
    $longitude_seconds = $_GET['longitude_seconds'];
    $sample_class = $_GET['sample_class'];
    $sample_genus = $_GET['sample_genus'];
    $sample_species = $_GET['sample_species'];
    $sample_sex = $_GET['sample_sex'];
    $sample_age = $_GET['sample_age'];
    $sample_weight = $_GET['sample_weight'];
    $isVouchered = $_GET['isVouchered'];
    $sample_method = $_GET['sample_method'];

    // Assuming $userData is the array containing the "storage_location" key
    if (isset($_GET['storage_location'])) {
        $storage_location = $_GET['storage_location'];
    } else {
        // Handle missing or empty key (e.g., set a default value)
        $storage_location = '';
    }

    $latitude = $coordinate_northsouth . " " . $latitude_degree . "° " . $latitude_minutes . "' " . $latitude_seconds . "''";
    $longitude = $coordinate_eastwest . " " . $longitude_degree . "° " . $longitude_minutes . "' " . $longitude_seconds . "''";
    
    $sql = "INSERT INTO specimen (
        user_id,
        specimen_collectionNumber,
        specimen_sex, 
        specimen_age,
        specimen_weight, 
        specimen_isVouchered,
        specimen_storageLocationVoucheredSpecimen,
        specimen_locationCapture,
        specimen_latitude,
        specimen_longitude,
        specimen_class,
        specimen_genus,
        specimen_species,
        specimen_sampleMethod
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $data = array(
        $_SESSION['userid'],
        $sampling_number,
        $sample_sex,
        $sample_age,
        $sample_weight,
        $isVouchered,
        $storage_location,
        $location_capture,
        $latitude,
        $longitude,
        $sample_class,
        $sample_genus,
        $sample_species,
        $sample_method
    );
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", ...$data);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        header("Location: user_home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: settings.php");
        exit();
    }
    
    $stmt->close();
    $conn->close();

?>