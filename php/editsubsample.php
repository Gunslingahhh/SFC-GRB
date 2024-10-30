<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['subSample_id'];
    //get specimen id
    $sql = $conn->prepare("SELECT specimen_id FROM subSample WHERE subSample_id = $id;");
    $sql->execute();
    $result = $sql->get_result();

    while($specimen_row=$result->fetch_assoc()){
        $specimen_id = $specimen_row['specimen_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/addsubsample.css">
        <script src="../js/editsubsample.js"></script>
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";

                    $statement = $conn->prepare("SELECT subSample_dnaLabName, subSample_dnaLabNumber, subSample_dnaExtractionSize, subSample_pcrLabName, subSample_pcrLabNumber, subSample_primerUsed, subSample_blastResult, subSample_cleaningLabName, subSample_cleaningLabNumber, subSample_rawSequence, subSample_cleanedSequence, subSample_photoIdentification FROM subSample WHERE subSample_id=$id;");
                    $statement->execute();
                    $result = $statement->get_result();

                    while ($subsample_row = $result->fetch_assoc()){
                        $dnaLabName=$subsample_row['subSample_dnaLabName'];
                        $dnaLabNumber=$subsample_row['subSample_dnaLabNumber'];
                        $dnaExtractionSize=$subsample_row['subSample_dnaExtractionSize'];
                        $pcrLabName=$subsample_row['subSample_pcrLabName'];
                        $pcrLabNumber=$subsample_row['subSample_pcrLabNumber'];
                        $primerUsed=$subsample_row['subSample_primerUsed'];
                        $blastResult=$subsample_row['subSample_blastResult'];
                        $cleaningLabName=$subsample_row['subSample_cleaningLabName'];
                        $cleaningLabNumber=$subsample_row['subSample_cleaningLabNumber'];
                        $rawSequenceFilePath=$subsample_row['subSample_rawSequence'];
                        $cleanedSequenceFilePath=$subsample_row['subSample_cleanedSequence'];
                        $photoIdentificationFilePath=$subsample_row['subSample_photoIdentification'];

                        $rawSequenceFileName = basename($rawSequenceFilePath);
                        $cleanedSequenceFileName = basename($cleanedSequenceFilePath);
                        $photoIdentificationFileName = basename($photoIdentificationFilePath);
                    }
                ?>
            </div>
            <div class="item2">
                <h1>Edit sub-sample detail</h1>
            </div>
            <div class="item3">
                <p class="title-text" style="margin-top: 0px;">DNA Extraction</p>
                
                <p class="title-text" style="margin-top: 295px;">PCR</p>
                
                <p class="title-text" style="margin-top: 400px;">Cleaning Raw Sequence</p>
                
                <p class="title-text" style="margin-top: 750px;">Attachments</p>
            </div>  
            <div class="item4"><div id="form-container">
                <form action="editsubsample_process.php?specimen_id=<?php echo $specimen_id ?>" enctype="multipart/form-data" method="POST">
                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input type="text" class="large-input one-flex" name="dna-lab-name" placeholder="Name" value="<?php echo $dnaLabName ?>">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input type="text" class="large-input one-flex" name="dna-lab-number" placeholder="Contact Number" value="<?php echo $dnaLabNumber ?>">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>DNA Extraction Size (bp)</b></p>
                        <input type="number" step="0.01" class="large-input one-flex" name="dna-extraction-size" placeholder="DNA Extraction Size (bp)" value="<?php echo $dnaExtractionSize ?>">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input type="text" class="large-input one-flex" name="pcr-lab-name" placeholder="Name" value="<?php echo $pcrLabName ?>">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input type="text" class="large-input one-flex" name="pcr-lab-number" placeholder="Contact Number" value="<?php echo $pcrLabNumber ?>">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>PCR Amplification</b></p>
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Primer Used</label>
                        <input type="text" class="large-input one-flex" name="primer-used" placeholder="Primer Used" value="<?php echo $primerUsed ?>">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Blast Result (%)</label>
                        <input type="number" step="0.01" class="large-input one-flex" name="blast-result" placeholder="Blast Result (%)" value="<?php echo $blastResult ?>">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input type="text" class="large-input one-flex" name="cleaning-lab-name" placeholder="Name" value="<?php echo $cleaningLabName ?>">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input type="text" class="large-input one-flex" name="cleaning-lab-number" placeholder="Contact Number" value="<?php echo $cleaningLabNumber ?>">
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Raw Sequence</b></p>
                            <div class="inner-file-upload" id="raw-sequence-container">
                                <p><span style="color: darkgreen;"><b>Upload</span> your file here</b></p>
                                <p class="file-name" id="rawSequencefileName"><?php echo $rawSequenceFileName ?></p>
                                <input type="file" id="raw-sequence" name="raw-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Cleaned Sequence</b></p>
                            <div class="inner-file-upload" id="cleaned-sequence-container">
                                <p><span style="color: darkgreen;"><b>Upload</span> your file here</b></p>
                                <p class="file-name" id="cleanedSequencefileName"><?php echo $cleanedSequenceFileName ?></p>
                                <input type="file" id="cleaned-sequence" name="cleaned-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal-line">

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Photo Identification</b></p>
                            <img class="inner-file-upload" id="photo-identification-container" src="<?php echo $photoIdentificationFilePath ?>">
                            <input type="file" id="photo-identification" name="photo-identification" accept="image/jpeg, image/png, image/jpg" style="display:none;">
                        </div>
                    </div>

                    <input type="submit" id="submit-button">
                </form>
            </div>
        </div>
    </body>
</html>