<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $specimen_id = $_GET['specimen_id'];

    // Check if user_id is set in session
    if (isset($_SESSION['userid'])) {
        $dateCollected = $_POST['date-collected'];
        $locationCapture = $_POST['location-capture'];
        $coordinate = $_POST['latitude-degree'] . "° " . $_POST['latitude-minutes'] . "' " . $_POST['latitude-seconds'] . '" ' . $_POST['latitude-northsouth'] . " " . $_POST['longitude-degree'] . "° " . $_POST['longitude-minutes'] . "' " . $_POST['longitude-seconds'] . '" ' . $_POST['longitude-eastwest'];
        $storageLocation = $_POST['storage-location'];
        $sampleType = $_POST['sample-type'];
        $dnaLabName = $_POST['dna-lab-name'];
        $dnaLabNumber = $_POST['dna-lab-number'];
        $dnaExtractionSize = $_POST['dna-extraction-size'];
        $pcrLabName = $_POST['pcr-lab-name'];
        $pcrLabNumber = $_POST['pcr-lab-number'];
        $primerUsed = $_POST['primer-used'];
        $blastResult = $_POST['blast-result'];
        $cleaningLabName = $_POST['cleaning-lab-name'];
        $cleaningLabNumber = $_POST['cleaning-lab-number'];
        $rawSequenceTemp = $_FILES['raw-sequence']['tmp_name'];
        $cleanedSequenceTemp = $_FILES['cleaned-sequence']['tmp_name'];
        $photoIdentificationTemp = $_FILES['photo-identification']['tmp_name'];
        date_default_timezone_set('Asia/Kuching');
        $image_createdAt = date("dmYHis");

        $tube_label_sql = $conn->prepare("SELECT sampleType_tube_label FROM sampleType WHERE sampleType_id = ?");
        $tube_label_sql->bind_param("i", $sampleType);
        $tube_label_sql->execute();

        $result = $tube_label_sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tube_label = $row['sampleType_tube_label'];
        } else {
            echo "No tube label found for the given sample type.";
        }

        $tube_label_sql->close();

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
        
        // Check if a new file was uploaded
        if ($photoIdentificationTemp != "") {
            $photo_file_extension = strtolower(pathinfo($_FILES['photo-identification']['name'], PATHINFO_EXTENSION));
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

        $sql = $conn->prepare("INSERT INTO subSample(
            specimen_id,
            sampleType_id,
            subSample_dateCollected,
            subSample_locationCapture,
            subSample_coordinate,
            subSample_storageLocation,
            subSample_dnaLabName,
            subSample_dnaLabNumber,
            subSample_dnaExtractionSize,
            subSample_pcrLabName,
            subSample_pcrLabNumber,
            subSample_primerUsed,
            subSample_blastResult,
            subSample_cleaningLabName,
            subSample_cleaningLabNumber,
            subSample_rawSequence,
            subSample_cleanedSequence,
            subSample_photoIdentification) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $sql->bind_param("iissssssdsssdsssss", 
            $specimen_id,
            $sampleType,
            $dateCollected,
            $locationCapture,
            $coordinate,
            $storageLocation,
            $dnaLabName,
            $dnaLabNumber,
            $dnaExtractionSize,
            $pcrLabName,
            $pcrLabNumber,
            $primerUsed,
            $blastResult,
            $cleaningLabName,
            $cleaningLabNumber,
            $raw_target_file,
            $cleaned_target_file,
            $photo_target_file);

        if ($sql->execute()) {
            $_SESSION['message'] = "Task posted successfully!";
            header("Location: specimen_row.php?specimen_id=$specimen_id");
            exit();
        } else {
            $_SESSION['error'] = "Error registering subsample: " . $sql->error;
            header("Location: specimen_row.php?specimen_id=$specimen_id");
            exit();
        }

        $conn->close();
    }
?>