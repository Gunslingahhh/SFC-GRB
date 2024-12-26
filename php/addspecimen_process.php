<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include "connection.php";

    // In current_page.php
    $sampling_number = $_POST['sampling_number'];
    $location_capture = $_POST['location_capture'];
    $coordinate_northsouth = $_POST['latitude_northsouth'];
    $latitude_degree = $_POST['latitude_degree'];
    $latitude_minutes = $_POST['latitude_minutes'];
    $latitude_seconds = $_POST['latitude_seconds'];
    $coordinate_eastwest = $_POST['longitude_eastwest'];
    $longitude_degree = $_POST['longitude_degree'];
    $longitude_minutes = $_POST['longitude_minutes'];
    $longitude_seconds = $_POST['longitude_seconds'];
    $sample_class = $_POST['sample_class'];
    $sample_genus = $_POST['sample_genus'];
    $sample_species = $_POST['sample_species'];
    $sample_sex = $_POST['sample_sex'];
    $sample_age = $_POST['sample_age'];
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