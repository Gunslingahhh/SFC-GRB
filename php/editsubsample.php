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

    $detail_check = $conn->prepare("SELECT s.subSample_dateCollected, s.subSample_storageLocation, s.subSample_coordinate, 
                                        s.subSample_dnaLabName, s.subSample_dnaLabNumber, s.subSample_dnaExtractionSize, 
                                        s.subSample_pcrLabName, s.subSample_pcrLabNumber, s.subSample_primerUsed, 
                                        s.subSample_blastResult, s.subSample_cleaningLabName, s.subSample_cleaningLabNumber, 
                                        s.subSample_rawSequence, s.subSample_cleanedSequence, s.subSample_photoIdentification,
                                        st.sampleType_id  -- Select the sampleType_id from the sampleType table
                                    FROM subSample AS s  -- Alias subSample as s for brevity
                                    INNER JOIN sampleType AS st ON s.sampleType_id = st.sampleType_id -- Join based on the common column
                                    WHERE s.subSample_id = $id;");
    $detail_check->execute();
    $detail_result = $detail_check->get_result();
    
    while ($user_row = $detail_result->fetch_assoc()) {
        $dateCollected = $user_row['subSample_dateCollected'];
        $storageLocation = $user_row['subSample_storageLocation'];
        $coordinate = $user_row['subSample_coordinate'];
        $dnaLabName = $user_row['subSample_dnaLabName'];
        $dnaLabNumber = $user_row['subSample_dnaLabNumber'];
        $dnaExtractionSize = $user_row['subSample_dnaExtractionSize'];
        $pcrLabName = $user_row['subSample_pcrLabName'];
        $pcrLabNumber = $user_row['subSample_pcrLabNumber'];
        $primerUsed = $user_row['subSample_primerUsed'];
        $blastResult = $user_row['subSample_blastResult'];
        $cleaningLabName = $user_row['subSample_cleaningLabName'];
        $cleaningLabNumber = $user_row['subSample_cleaningLabNumber'];
        $rawSequence = $user_row['subSample_rawSequence'];
        $cleanedSequence = $user_row['subSample_cleanedSequence'];
        $photoIdentification = $user_row['subSample_photoIdentification'];
        $sampleTypeId = $user_row['sampleType_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../adminkit-main/static/js/app.js"></script>
        <script src="../js/app.js"></script>
    </head>
    <body>
        <?php 
            include "sidenav.php";
        ?>
        <main class="col ps-md-0 main-content third-color">
            <form action="addsubsample_process.php?specimen_id=<?php echo $id ?>" enctype="multipart/form-data" method="POST">
                <div class="ms-4">
                    <h2 class="fw-bold">Edit a sub-sample</h2>
                    <div class="d-flex w-100 mt-5 pt-5">
                        <div class="w-50">
                            <p class="fw-bold">Sub-sample detail</p>
                            <p>Detail of sub-sample</p>
                        </div>
                        <div class="w-75">
                                
                            <p class="mt-3">Date collected <input type="date" class="form-control border border-1 border-dark w-50" id="date-collected" name="date-collected" value="<?php echo $dateCollected; ?>" disabled></p>
                            <p class="mt-3">Storage location<input type="text" class="form-control border border-1 border-dark w-50 mb-5" id="storage_location" name="storage-location" value="<?php echo $storageLocation; ?>" placeholder="Storage location" disabled></p>
                        </div>
                </div>
                <hr class="border border-dark border-1">
                <div>
                    <div class="d-flex w-100 mt-5">
                        <div class="w-50">
                            <p class="fw-bold">Sample type</p>
                            <p>What is the type of sample collected?</p>
                        </div>
                        <div class="w-75">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="fw-bold mb-0">Biopsy</p>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="1" <?php if ($sampleTypeId == 1) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Liver</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="2" <?php if ($sampleTypeId == 2) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Muscle</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="3" <?php if ($sampleTypeId == 3) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Kidney</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="4" <?php if ($sampleTypeId == 4) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Lung</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="5" <?php if ($sampleTypeId == 5) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Heart</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="6" <?php if ($sampleTypeId == 6) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Spleen</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="7" <?php if ($sampleTypeId == 7) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Small Intestine</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="8" <?php if ($sampleTypeId == 8) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Large Intestine</label>
                                    </div>

                                    <p class="fw-bold mt-4 mb-0">Blood</p>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="9" <?php if ($sampleTypeId == 9) echo "checked"; ?> disabled>
                                        <label class="form-check-label">EDTA</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="10" <?php if ($sampleTypeId == 10) echo "checked"; ?> disabled>
                                        <label class="form-check-label">FTA Card</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="11" <?php if ($sampleTypeId == 11) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Plain</label>
                                    </div>

                                    <p class="fw-bold mt-4 mb-0">Swab</p>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="12" <?php if ($sampleTypeId == 12) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Rectal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="13" <?php if ($sampleTypeId == 13) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Urine</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="14" <?php if ($sampleTypeId == 14) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Throat</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bold mb-0">Others</p>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="15" <?php if ($sampleTypeId == 15) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Hair</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="16" <?php if ($sampleTypeId == 16) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Fur</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="17" <?php if ($sampleTypeId == 17) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Feather</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="18" <?php if ($sampleTypeId == 18) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Antler</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="19" <?php if ($sampleTypeId == 19) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Scale</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="20" <?php if ($sampleTypeId == 20) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Fecal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="21" <?php if ($sampleTypeId == 21) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Skin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="22" <?php if ($sampleTypeId == 22) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Scute</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="23" <?php if ($sampleTypeId == 23) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Punch</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="24" <?php if ($sampleTypeId == 24) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Tooth</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="25" <?php if ($sampleTypeId == 25) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Nail / Claw</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="26" <?php if ($sampleTypeId == 26) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Skull</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="27" <?php if ($sampleTypeId == 27) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Stomach Content</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="28" <?php if ($sampleTypeId == 28) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Whole Body</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="29" <?php if ($sampleTypeId == 29) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Tick</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="30" <?php if ($sampleTypeId == 30) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Mite</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="31" <?php if ($sampleTypeId == 31) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Spike</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample-type" value="32" <?php if ($sampleTypeId == 32) echo "checked"; ?> disabled>
                                        <label class="form-check-label">Coral Tissue</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border border-dark border-1">
                <div>
                    <div class="d-flex w-100 mt-5">
                        <div class="w-50">
                            <p class="fw-bold">DNA Extraction</p>
                        </div>
                        <div class="w-75">
                            <p class="fw-bold">Lab Analyst</p>
                            <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name" name="dna-lab-name" value="<?php echo $dnaLabName; ?>"></p>
                            <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number" name="dna-lab-number" value="<?php echo $dnaLabNumber; ?>"></p>

                            <p class="fw-bold">DNA Extraction Size (bp)</p>
                            <p class="mt-3"><input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="DNA Extraction Size (bp)" name="dna-extraction-size" value="<?php echo $dnaExtractionSize; ?>"></p>
                        </div>
                </div>
                <hr class="border border-dark border-1">
                <div>
                    <div class="d-flex w-100 mt-5">
                        <div class="w-50">
                            <p class="fw-bold">PCR</p>
                        </div>
                        <div class="w-75">
                            <p class="fw-bold">Lab Analyst</p>
                            <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name" name="pcr-lab-name" value="<?php echo $pcrLabName; ?>"></p>
                            <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number" name="pcr-lab-number" value="<?php echo $pcrLabNumber; ?>"></p>

                            <p class="fw-bold">PCR Amplification</p>
                            <p class="mt-3">Primer Used<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Primer Used" name="primer-used" value="<?php echo $primerUsed; ?>"></p>
                            <p class="mt-3">Blast Result (%)<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Blast Result (%)" name="blast-result" value="<?php echo $blastResult; ?>"></p>
                        </div>
                </div>
                <hr class="border border-dark border-1">
                <div>
                    <div class="d-flex w-100 mt-5">
                        <div class="w-50">
                            <p class="fw-bold">Cleaning Raw Sequence</p>
                        </div>
                        <div class="w-75">
                            <p class="fw-bold">Lab Analyst</p>
                            <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name" name="cleaning-lab-name" value="<?php echo $cleaningLabName; ?>"></p>
                            <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number" name="cleaning-lab-number" value="<?php echo $cleaningLabNumber; ?>"></p>

                            <div class="card w-50 p-3 border border-dark mt-4 mb-5">
                                <h6 class="card-title fw-bold">Raw Sequence</h6>
                                <div role="button" id="raw-sequence-container" class="p-5 card-body rounded border border-2 border-primary d-flex flex-column justify-content-center align-items-center text-center">
                                    <p><span class="fw-bold text-success">Replace</span> your file here</p>
                                    <p id="rawSequencefileName" class="text-break"><?php echo $rawSequence ?></p>
                                    <input type="file" id="raw-sequence" name="raw-sequence" accept=".txt" style="display:none;">
                                </div>
                            </div>

                            <div class="card w-50 p-3 border border-dark mt-4 mb-5">
                                <h6 class="card-title fw-bold">Cleaned Sequence</h6>
                                <div role="button" id="cleaned-sequence-container" class="p-5 card-body rounded border border-2 border-primary d-flex flex-column justify-content-center align-items-center text-center">
                                    <p><span class="fw-bold text-success">Replace</span> your file here</p>
                                    <p id="cleanedSequencefileName" class="text-break"><?php echo $cleanedSequence ?></p>
                                    <input type="file" id="cleaned-sequence" name="cleaned-sequence" accept=".txt" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border border-dark border-1">
                <div>
                    <div class="d-flex w-100 mt-5">
                        <div class="w-50">
                            <p class="fw-bold">Attachments</p>
                        </div>
                        <div class="w-75">
                            <div class="card w-50 p-3 border border-dark mt-4 mb-5">
                                <h6 class="card-title fw-bold">Photo Identification</h6>
                                <img role="button" id="photo-identification-container" src="<?php echo $photoIdentification ?>" class="card-body rounded border border-2 border-primary" style="object-fit: contain; display: block; min-height: 200px; max-height: 200px;">
                                <input type="file" id="photo-identification" name="photo-identification" accept="image/jpeg, image/png, image/jpg" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="d-flex w-100">
                        <div class="w-50">
                        </div>
                        <div class="w-75">
                            <button type="submit" name="info_submit" class="btn btn-primary w-50">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>