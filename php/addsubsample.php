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
                
                <p class="title-text" style="margin-top: 550px;">DNA Extraction</p>
                
                <p class="title-text" style="margin-top: 295px;">PCR</p>
                
                <p class="title-text" style="margin-top: 390px;">Cleaning Raw Sequence</p>
                
                <p class="title-text" style="margin-top: 660px;">Attachments</p>
            </div>  
            <div class="item4"><div id="form-container">
                <form action="user_process.php">
                    <div class="form-group one-flex">
                        <label class="top-label">Date collected</label>
                        <input required type="date" class="large-input one-flex" name="sampling_number">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Storage location</label>
                        <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Storage location">
                    </div>

                    <hr class="horizontal-line">

                    <div class="form-group two-flex">
                        <p><b>Biopsy</b></p>
                        <input required type="radio" class="radio-input" name="" value="">Liver<br>
                        <input required type="radio" class="radio-input" name="" value="">Muscle<br>
                        <input required type="radio" class="radio-input" name="" value="">Kidney<br>
                        <input required type="radio" class="radio-input" name="" value="">Lung<br>
                        <input required type="radio" class="radio-input" name="" value="">Heart<br>
                        <input required type="radio" class="radio-input" name="" value="">Spleen<br>
                        <input required type="radio" class="radio-input" name="" value="">Small Intestine<br>
                        <input required type="radio" class="radio-input" name="" value="">Large Intestine<br>
                        <br>
                        <p><b>Blood</b></p>
                        <input required type="radio" class="radio-input" name="" value="">EDTA<br>
                        <input required type="radio" class="radio-input" name="" value="">FTA Card<br>
                        <input required type="radio" class="radio-input" name="" value="">Plain<br>
                        <br>
                        <p><b>Swab</b></p>
                        <input required type="radio" class="radio-input" name="" value="">Rectal<br>
                        <input required type="radio" class="radio-input" name="" value="">Urine<br>
                        <input required type="radio" class="radio-input" name="" value="">Throat<br>
                    </div>

                    <div class="form-group two-flex">
                        <p><b>Others</b></p>
                        <input required type="radio" class="radio-input" name="" value="">Hair<br>
                        <input required type="radio" class="radio-input" name="" value="">Fur<br>
                        <input required type="radio" class="radio-input" name="" value="">Feather<br>
                        <input required type="radio" class="radio-input" name="" value="">Antler<br>
                        <input required type="radio" class="radio-input" name="" value="">Scale<br>
                        <input required type="radio" class="radio-input" name="" value="">Fecal<br>
                        <input required type="radio" class="radio-input" name="" value="">Skin<br>
                        <input required type="radio" class="radio-input" name="" value="">Scute<br>
                        <input required type="radio" class="radio-input" name="" value="">Punch<br>
                        <input required type="radio" class="radio-input" name="" value="">Tooth<br>
                        <input required type="radio" class="radio-input" name="" value="">Nail / Claw<br>
                        <input required type="radio" class="radio-input" name="" value="">Skull<br>
                        <input required type="radio" class="radio-input" name="" value="">Stomach Content<br>
                        <input required type="radio" class="radio-input" name="" value="">Whole Body<br>
                        <input required type="radio" class="radio-input" name="" value="">Tick<br>
                        <input required type="radio" class="radio-input" name="" value="">Mite<br>
                        <input required type="radio" class="radio-input" name="" value="">Spike<br>
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Contact Number">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>DNA Extraction Size (bp)</b></p>
                        <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="DNA Extraction Size (bp)">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Contact Number">
                    </div>
                    <div class="form-group one-flex">
                        <p style="margin-bottom: 0px;"><b>PCR Amplification</b></p>
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Primer Used</label>
                        <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="Primer Used">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Blast Result (%)</label>
                        <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Blast Result (%)">
                    </div>

                    <hr class="horizontal-line">

                    <p style="margin-top: 0px; margin-bottom: 10px;"><b>Lab Analyst</b></p>
                    <div class="form-group one-flex">
                        <label class="top-label">Name</label>
                        <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="Name">
                    </div>
                    <div class="form-group one-flex">
                        <label class="top-label">Contact Number</label>
                        <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Contact Number">
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Raw Sequence</b></p>
                            <div class="inner-file-upload">
                            <p><span style="color: darkgreen;"><b>Upload</b></span> your file here</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Cleaned Sequence</b></p>
                            <div class="inner-file-upload">
                            <p><span style="color: darkgreen;"><b>Upload</b></span> your file here</p>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal-line">

                    <div class="form-group one-flex">
                        <div class="file-upload">
                            <p><b>Photo Identification</b></p>
                            <div class="inner-file-upload">
                            <p><span style="color: darkgreen;"><b>Upload</b></span> your file here</p>
                            </div>
                        </div>
                    </div>

                    <input type="submit" id="submit-button">
                </form>
            </div>
        </div>
    </body>
</html>