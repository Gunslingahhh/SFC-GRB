<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['id'];

    // Check if user_id is set in session
    if (isset($_SESSION['userid'])) {
        $dateCollected = $_POST['date-collected'];
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
        $photoSequenceTemp = $_FILES['photo-identification']['tmp_name'];
        date_default_timezone_set('Asia/Kuching');
        $image_createdAt = date("dmYHis");

        $tube_label_sql = "SELECT sampleType_tube_label from sampleType WHERE sampleType_id = $sampleType";
        

        
        if ($rawSequenceTemp != ""){
            $raw_file_extension = strtolower(pathinfo($_FILES['raw-sequence']['name'], PATHINFO_EXTENSION));
            $raw_newfilename = "raw_sequence_" . $_SESSION['userid'] . "." . $raw_file_extension;
            $raw_target_dir = "../assets/uploads/raw_sequence/";
            $raw_target_file = $raw_target_dir . $raw_newfilename;
        }
        
        if ($cleanedSequenceTemp != ""){
            $cleaned_file_extension = strtolower(pathinfo($_FILES['cleaned-sequence']['name'], PATHINFO_EXTENSION));
            $cleaned_newfilename = "cleaned_sequence_" . $id . "." . $cleaned_file_extension;
            $cleaned_target_dir = "../assets/uploads/cleaned_sequence/";
            $cleaned_target_file = $cleaned_target_dir . $cleaned_newfilename;
        }
        
        if ($photoSequenceTemp != ""){
            $photo_file_extension = strtolower(pathinfo($_FILES['photo-identification']['name'], PATHINFO_EXTENSION));
            $photo_newfilename = "photo_identification_" . $_SESSION['userid'] . "." . $photo_file_extension;
            $photo_target_dir = "../assets/uploads/photo_identification/";
            $photo_target_file = $photo_target_dir . $photo_newfilename;
        }

        $sql = $conn->prepare("INSERT INTO subSample(
            specimen_id,
            sampleType_id,
            subSample_dateCollected,
            subSample_storageLocation,
            subSample_pcrLabName,
            subSample_pcrLabNumber,
            subSample_primerUsed,
            subSample_blastResult,
            subSample_cleaningLabName,
            subSample_cleaningLabNumber,
            subSample_rawSequence,
            subSample_cleanedSequence,
            subSample_photoIdentification) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

            echo $id . "<br>";
            echo $sampleType . "<br>";
            echo $dateCollected . "<br>";
            echo $storageLocation . "<br>";
            echo $pcrLabName . "<br>";
            echo $pcrLabNumber . "<br>";
            echo $primerUsed . "<br>";
            echo $blastResult . "<br>";
            echo $cleaningLabName . "<br>";
            echo $cleaningLabNumber . "<br>";
            echo $raw_newfilename . "<br>";
            echo $cleaned_newfilename . "<br>";
            echo $photo_newfilename . "<br>";

        $conn->close();
    }
?>