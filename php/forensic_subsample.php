<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
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
        <link rel="stylesheet" href="../css/forensic_subsample.css">
        <script src="../js/user_home.js"></script>
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            </div>
            <div class="item2">
                <h1>Sub-Sample ID:</h1>
            </div>
            <div class="item3">
                <p class="title-text">Sub-sample Detail</p>
                <p class="subtitle-text">Detail of sub-sample</p>

                <p class="title-text" style="margin-top: 184px;">Sample Type</p>
                <p class="subtitle-text">What is the type of sample collected</p>

                <p class="title-text" style="margin-top: 650px;">DNA Extraction</p>

                <p class="title-text" style="margin-top: 350px;">PCR</p>

                <p class="title-text" style="margin-top: 430px;">Cleaning Raw Sequence</p>

                <p class="title-text" style="margin-top: 410px;">Attachments</p>
            </div>  
            <div class="item4">
                <div id="form-container">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="form-group one-flex">
                            <label class="top-label">Date collected</label>
                            <input type="date" class="large-input one-flex" name="date_collected">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Storage location</label>
                            <input type="text" class="large-input one-flex" name="storage_location" placeholder="Storage location">
                        </div>
                        
                        <hr class="horizontal-line">
                        
                        <div class="form-group two-flex checkboxes" style="padding-top: 30px;">
                            <p class="title-text" style="margin: 0px 0px 0px 0px;">Biopsy</p>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="1">Liver</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="2">Muscle</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="3">Kidney</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="4">Lung</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="5">Heart</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="6">Spleen</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="7">Small Intestine</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="8">Large Intestine</div>

                            <p class="title-text" style="margin: 30px 0px 0px 0px;">Blood</p>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="9">EDTA</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="10">FTA Card</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="11">Plain</div>

                            <p class="title-text" style="margin: 30px 0px 0px 0px;">Swab</p>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="12">Rectal</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="13">Urine</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="14">Throat</div>
                        </div>

                        <div class="form-group two-flex checkboxes" style="padding-top: 30px;">
                            <p class="title-text" style="margin: 0px 0px 0px 0px;">Others</p>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="15">Hair</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="16">Fur</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="17">Feather</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="18">Antler</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="19">Scale</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="20">Fecal</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="21">Skin</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="22">Scute</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="23">Punch</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="24">Tooth</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="25">Nail / Claw</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="26">Skull</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="27">Stomach Content</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="28">Whole Body</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="29">Tick</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="30">Mite</div>
                            <div class="checkboxes"><input type="radio" class="radio-input" name="sample_type" value="31">Spike</div>
                        </div>
                        
                        <hr class="horizontal-line">

                        <div class="form-group one-flex">
                            <p class="title-text" style="margin:50px 0 0 0; ">Lab Analyst</p>
                            <label class="top-label" style="margin-top: 10px;">Name</label>
                            <input type="text" class="large-input one-flex" name="dnaExtraction_name" placeholder="Name">
                            <label class="top-label" style="margin-top: 10px;">Contact Number</label>
                            <input type="text" class="large-input one-flex" name="dnaExtraction_contact" placeholder="Contact Number">

                            <p class="title-text" style="margin:50px 0 10px 0; ">DNA Extraction Size (bp)</p>
                            <input type="text" class="large-input one-flex" name="dnaExtraction_size" placeholder="DNA Extraction Size (bp)">
                        </div>
                        
                        <hr class="horizontal-line">

                        <div class="form-group one-flex">
                            <p class="title-text" style="margin:50px 0 0 0; ">Lab Analyst</p>
                            <label class="top-label" style="margin-top: 10px;">Name</label>
                            <input type="text" class="large-input one-flex" name="pcr_name" placeholder="Name">
                            <label class="top-label" style="margin-top: 10px;">Contact Number</label>
                            <input type="text" class="large-input one-flex" name="pcr_contact" placeholder="Contact Number">

                            <p class="title-text" style="margin:50px 0 0 0; ">PCR Amplification</p>
                            <label class="top-label" style="margin-top: 10px;">Primer Used</label>
                            <input type="text" class="large-input one-flex" name="pcr_primer" placeholder="Primer Used">
                            <label class="top-label" style="margin-top: 10px;">Blast Result (%)</label>
                            <input type="text" class="large-input one-flex" name="pcr_blast" placeholder="Blast Result (%)">
                        </div>
                        
                        <hr class="horizontal-line">

                        <div class="form-group one-flex">
                            <p class="title-text" style="margin:50px 0 0 0; ">Lab Analyst</p>
                            <label class="top-label" style="margin-top: 10px;">Name</label>
                            <input type="text" class="large-input one-flex" name="cleaningRaw_name" placeholder="Name">
                            <label class="top-label" style="margin-top: 10px;">Contact Number</label>
                            <input type="text" class="large-input one-flex" name="cleaningRaw_contact" placeholder="Contact Number">

                            <p class="title-text" style="margin:50px 0 0 0; ">Raw Sequence</p>
                            <input type="file" name="cleaningRaw_rawSequence" accept=".txt" class="file-upload">
                            <p class="title-text" style="margin:50px 0 0 0; ">Cleaned Sequence</p>
                            <input type="file" name="cleaningRaw_cleanedSequence" accept=".txt" class="file-upload">
                        </div>
                        
                        <hr class="horizontal-line">

                        <div class="form-group one-flex">
                            <p class="title-text" style="margin:50px 0 0 0; ">Photo Identification</p>
                            <input type="file" name="attachments_photoIdentification" accept=".txt" class="file-upload">
                        </div>

                        <input type="submit" id="submit-button">
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>