<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}

include "connection.php";

$specimen_id = $_GET['specimen_id'];
$subSample_id = $_GET['subSample_id'];

if (isset($_SESSION['userid'])) {
    //Getting data from user input
    $dnaLabName = $_POST['dna-lab-name'];
    $dnaLabNumber = $_POST['dna-lab-number'];
    $dnaExtractionSize = $_POST['dna-extraction-size'];
    $pcrLabName = $_POST['pcr-lab-name'];
    $pcrLabNumber = $_POST['pcr-lab-number'];
    $primerUsed = $_POST['primer-used'];
    $blastResult = $_POST['blast-result'];
    $cleaningLabName = $_POST['cleaning-lab-name'];
    $cleaningLabNumber = $_POST['cleaning-lab-number'];

    //File input from user
    $rawSequenceTemp = $_FILES['raw-sequence']['tmp_name'];
    $cleanedSequenceTemp = $_FILES['cleaned-sequence']['tmp_name'];
    $photoIdentificationTemp = $_FILES['photo-identification']['tmp_name'];

    date_default_timezone_set('Asia/Kuching');
    $image_createdAt = date("dmYHis");

    // Get sampleType_id from subSample
    $detail_check = $conn->prepare(
        "SELECT s.subSample_rawSequence, s.subSample_cleanedSequence, s.subSample_photoIdentification, st.sampleType_id 
         FROM subSample AS s
         INNER JOIN sampleType AS st ON s.sampleType_id = st.sampleType_id
         WHERE s.subSample_id = ?"
    );
    $detail_check->bind_param("i", $subSample_id);
    $detail_check->execute();
    $result = $detail_check->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rawSequence = $row['subSample_rawSequence'];
        $cleanedSequence = $row['subSample_cleanedSequence'];
        $photoIdentification = $row['subSample_photoIdentification'];
        $sampleType = $row['sampleType_id'];
    } else {
        echo "Sample type not found for this subSample.";
        exit();
    }
    $detail_check->close();

    // Get tube label based on sampleType_id
    $tube_label_sql = $conn->prepare("SELECT sampleType_tube_label FROM sampleType WHERE sampleType_id = ?");
    $tube_label_sql->bind_param("i", $sampleType);
    $tube_label_sql->execute();
    $result = $tube_label_sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tube_label = $row['sampleType_tube_label'];
    } else {
        echo "No tube label found for the given sample type.";
        exit();
    }
    $tube_label_sql->close();

    echo '$dnaLabName: ' . $dnaLabName . "<br><br>";
    echo '$dnaLabNumber: ' . $dnaLabNumber . "<br><br>";
    echo '$dnaExtractionSize: ' . $dnaExtractionSize . "<br><br>";
    echo '$pcrLabName: ' . $pcrLabName . "<br><br>";
    echo '$pcrLabNumber: ' . $pcrLabNumber . "<br><br>";
    echo '$primerUsed: ' . $primerUsed . "<br><br>";
    echo '$blastResult: ' . $blastResult . "<br><br>";
    echo '$cleaningLabName: ' . $cleaningLabName . "<br><br>";
    echo '$cleaningLabNumber: ' . $cleaningLabNumber . "<br><br>";
    echo '$rawSequenceTemp: ' . $rawSequenceTemp . "<br><br>";
    echo '$cleanedSequenceTemp: ' . $cleanedSequenceTemp . "<br><br>";
    echo '$photoIdentificationTemp: ' . $photoIdentificationTemp . "<br><br>";
    echo '$rawSequence: ' . $rawSequence . "<br><br>";
    echo '$cleanedSequence: ' . $cleanedSequence . "<br><br>";
    echo '$photoIdentification: ' . $photoIdentification . "<br><br>";
    echo '$sampleType: ' . $sampleType . "<br><br>";
    echo '$tube_label: ' . $tube_label . "<br><br>";

    // Handle file uploads
    if ($rawSequence == "") {
        // Check if a new file was uploaded
        if ($rawSequenceTemp != "") {
            $raw_file_extension = strtolower(pathinfo($_FILES['raw-sequence']['name'], PATHINFO_EXTENSION));
            $raw_newfilename = "rawSequence_SFC-GRB-" . $specimen_id . "_" . $tube_label . "." . $raw_file_extension;
            $raw_target_dir = "../assets/uploads/raw_sequence/";
            $raw_target_file = $raw_target_dir . $raw_newfilename;

            if (move_uploaded_file($rawSequenceTemp, $raw_target_file)) {
                // Success: file is moved
                echo "File successfully moved!";
            } else {
                // Error moving file
                echo "Error uploading file.";
                $raw_target_file = "";
            }
        } else {
            // No file uploaded
            echo "No file selected.";
            $raw_target_file = "";
        }
    } else {
        // File already exists in DB
        $raw_target_file = $rawSequence;
        echo "File exists in database.";
    }

    
    if ($cleanedSequence == "") {
        // Check if a new file was uploaded
        if ($cleanedSequenceTemp != "") {
            $cleaned_file_extension = strtolower(pathinfo($_FILES['cleaned-sequence']['name'], PATHINFO_EXTENSION));
            $cleaned_newfilename = "cleanedSequence_SFC-GRB-" . $specimen_id . "_" . $tube_label . "." . $cleaned_file_extension;
            $cleaned_target_dir = "../assets/uploads/cleaned_sequence/";
            $cleaned_target_file = $cleaned_target_dir . $cleaned_newfilename;

            if (move_uploaded_file($cleanedSequenceTemp, $cleaned_target_file)) {
                // Success: file is moved
                echo "File successfully moved!";
            } else {
                // Error moving file
                echo "Error uploading file.";
                $cleaned_target_file = "";
            }
        } else {
            // No file uploaded
            echo "No file selected.";
            $cleaned_target_file = "";
        }
    } else {
        // File already exists in DB
        $cleaned_target_file = $cleanedSequence;
        echo "File exists in database.";
    }
    
    if ($photoIdentification == "") {
        // Check if a new file was uploaded
        if ($photoIdentificationTemp != "") {
            $photo_file_extension = strtolower(pathinfo($_FILES['photo-sequence']['name'], PATHINFO_EXTENSION));
            $photo_newfilename = "photoIdentification_SFC-GRB-" . $specimen_id . "_" . $tube_label . "." . $photo_file_extension;
            $photo_target_dir = "../assets/uploads/photo_identification/";
            $photo_target_file = $photo_target_dir . $photo_newfilename;

            if (move_uploaded_file($photoIdentificationTemp, $photo_target_file)) {
                // Success: file is moved
                echo "File successfully moved!";
            } else {
                // Error moving file
                echo "Error uploading file.";
                $photo_target_file = "";
            }
        } else {
            // No file uploaded
            echo "No file selected.";
            $photo_target_file = "";
        }
    } else {
        // File already exists in DB
        $photo_target_file = $photoIdentification;
        echo "File exists in database.";
    }

    // Update the subSample record
    $sql = $conn->prepare(
        "UPDATE subSample
         SET subSample_dnaLabName = ?, 
             subSample_dnaLabNumber = ?, 
             subSample_dnaExtractionSize = ?, 
             subSample_pcrLabName = ?, 
             subSample_pcrLabNumber = ?, 
             subSample_primerUsed = ?, 
             subSample_blastResult = ?, 
             subSample_cleaningLabName = ?, 
             subSample_cleaningLabNumber = ?, 
             subSample_rawSequence = ?, 
             subSample_cleanedSequence = ?, 
             subSample_photoIdentification = ?
         WHERE subSample_id = ?"
    );

    $sql->bind_param(
        "ssdsssdsssssi", 
        $dnaLabName, $dnaLabNumber, $dnaExtractionSize, 
        $pcrLabName, $pcrLabNumber, $primerUsed, $blastResult, 
        $cleaningLabName, $cleaningLabNumber, 
        $raw_target_file, $cleaned_target_file, $photo_target_file, 
        $subSample_id
    );

    if ($sql->execute()) {
        $_SESSION['message'] = "Task posted successfully!";
        header("Location: specimen_row.php?specimen_id={$specimen_id}&subSample_id={$subSample_id}");
        exit();
    } else {
        $_SESSION['error'] = "Error updating record: " . $sql->error;
        header("Location: specimen_row.php?specimen_id={$specimen_id}&subSample_id={$subSample_id}");
        exit();
    }

    $sql->close();
    $conn->close();
}
?>