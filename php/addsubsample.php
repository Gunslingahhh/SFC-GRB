<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/addsubsample.css">
        <script src="../js/addsubsample.js"></script>
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            </div>
            <div class="item2">
                <h1>Add a sub-sample</h1>
            </div>
            <div class="item3">
                <p class="title-text">Sub-sample detail</p>
                <p class="subtitle-text">Detail of sub-sample</p>

                <p class="title-text" style="margin-top: 175px;">Sample type</p>
                <p class="subtitle-text">What is the type of sample collected?</p>
                
                <p class="title-text" style="margin-top: 530px;">DNA Extraction</p>
                
                <p class="title-text" style="margin-top: 295px;">PCR</p>
                
                <p class="title-text" style="margin-top: 390px;">Cleaning Raw Sequence</p>
                
                <p class="title-text" style="margin-top: 780px;">Attachments</p>
            </div>  
            <div class="item4"><div id="form-container">
                <form action="addsubsample_process.php" enctype="multipart/form-data" method="POST">
                    <div class="form-group one-flex">
                        <label class="top-label">Date collected</label>
                        <input required type="date" class="large-input one-flex" name="date-collected">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Storage location</label>
                        <input required type="text" class="large-input one-flex" name="storage-location" placeholder="Storage location">
                    </div>

                    <hr class="horizontal-line">

                    <div class="form-group two-flex">
                        <p><b>Biopsy</b></p>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Liver<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Muscle<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Kidney<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Lung<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Heart<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Spleen<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Small Intestine<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Large Intestine<br>
                        <br>
                        <p><b>Blood</b></p>
                        <input required type="radio" class="radio-input" name="sample-type" value="">EDTA<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">FTA Card<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Plain<br>
                        <br>
                        <p><b>Swab</b></p>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Rectal<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Urine<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Throat<br>
                    </div>

                    <div class="form-group two-flex">
                        <p><b>Others</b></p>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Hair<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Fur<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Feather<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Antler<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Scale<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Fecal<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Skin<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Scute<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Punch<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Tooth<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Nail / Claw<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Skull<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Stomach Content<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Whole Body<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Tick<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Mite<br>
                        <input required type="radio" class="radio-input" name="sample-type" value="">Spike<br>
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="dna-lab-name" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="dna-lab-number" placeholder="Contact Number">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>DNA Extraction Size (bp)</b></p>
                        <input required type="text" class="large-input one-flex" name="dna-extraction-size" placeholder="DNA Extraction Size (bp)">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="pcr-lab-name" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="pcr-lab-number" placeholder="Contact Number">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>PCR Amplification</b></p>
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Primer Used</label>
                        <input required type="text" class="large-input one-flex" name="primer-used" placeholder="Primer Used">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Blast Result (%)</label>
                        <input required type="text" class="large-input one-flex" name="blast-result" placeholder="Blast Result (%)">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="cleaning-lab-name" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="cleaning-lab-number" placeholder="Contact Number">
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Raw Sequence</b></p>
                            <div class="inner-file-upload" id="raw-sequence-container">
                                <p><span style="color: darkgreen;"><b>Upload</span> your file here</b></p>
                                <p class="file-name" id="rawSequencefileName"></p>
                                <input type="file" id="raw-sequence" name="raw-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Cleaned Sequence</b></p>
                            <div class="inner-file-upload" id="cleaned-sequence-container">
                                <p><span style="color: darkgreen;"><b>Upload</span> your file here</b></p>
                                <p class="file-name" id="cleanedSequencefileName"></p>
                                <input type="file" id="cleaned-sequence" name="cleaned-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal-line">

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Photo Identification</b></p>
                                <img class="inner-file-upload" id="photo-identification-container">
                                <p><span style="color: darkgreen;"><b>Upload</b></span> your file here</p>
                                <input type="file" id="photo-identification" name="photo-identification" accept="image/jpeg, image/png, image/jpg" style="display:none;">
                        </div>
                    </div>

                    <input type="submit" id="submit-button">
                </form>
            </div>
        </div>
    </body>
</html>