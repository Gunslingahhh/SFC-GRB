<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $userid = $_SESSION['userid'];

    $detail_check = $conn->prepare("SELECT user_contactNumber, user_email, user_organization FROM user WHERE user_id = $userid");
    $detail_check->execute();
    $detail_result = $detail_check->get_result();
    
    while ($user_row = $detail_result->fetch_assoc()) {
        $contactNumber = $user_row['user_contactNumber'];
        $email = $user_row['user_email'];
        $organization = $user_row['user_organization'];
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
            <div class="ms-4">
                <h2 class="fw-bold">Add a sub-sample</h2>
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">Sub-sample detail</p>
                        <p>Detail of sub-sample</p>
                    </div>
                    <div class="w-75">
                            
                        <p class="mt-3">Date collected <input type="date" class="form-control border border-1 border-dark w-50" id="date-collected" name="date-collected"></p>
                        <p class="mt-3">Storage location<input type="text" class="form-control border border-1 border-dark w-50 mb-5" id="storage_location" name="storage_location" value="" placeholder="Storage location"></p>
                    </div>
            </div>
            <hr class="border border-dark border-1">
            <div class="ms-4">
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">Sample type</p>
                        <p>What is the type of sample collected?</p>
                    </div>
                    <div class="w-75">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="fw-bold mb-0">Biopsy</p>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="1" required>
                                    <label class="form-check-label">Liver</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="2" required>
                                    <label class="form-check-label">Muscle</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="3" required>
                                    <label class="form-check-label">Kidney</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="4" required>
                                    <label class="form-check-label">Lung</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="5" required>
                                    <label class="form-check-label">Heart</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="6" required>
                                    <label class="form-check-label">Spleen</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="7" required>
                                    <label class="form-check-label">Small Intestine</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="8" required>
                                    <label class="form-check-label">Large Intestine</label>
                                </div>

                                <p class="fw-bold mt-4 mb-0">Blood</p>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="9" required>
                                    <label class="form-check-label">EDTA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="10" required>
                                    <label class="form-check-label">FTA Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="11" required>
                                    <label class="form-check-label">Plain</label>
                                </div>

                                <p class="fw-bold mt-4 mb-0">Swab</p>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="12" required>
                                    <label class="form-check-label">Rectal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="13" required>
                                    <label class="form-check-label">Urine</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="14" required>
                                    <label class="form-check-label">Throat</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold mb-0">Others</p>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="15" required>
                                    <label class="form-check-label">Hair</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="16" required>
                                    <label class="form-check-label">Fur</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="17" required>
                                    <label class="form-check-label">Feather</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="18" required>
                                    <label class="form-check-label">Antler</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="19" required>
                                    <label class="form-check-label">Scale</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="20" required>
                                    <label class="form-check-label">Fecal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="21" required>
                                    <label class="form-check-label">Skin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="22" required>
                                    <label class="form-check-label">Scute</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="23" required>
                                    <label class="form-check-label">Punch</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="24" required>
                                    <label class="form-check-label">Tooth</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="25" required>
                                    <label class="form-check-label">Nail / Claw</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="26" required>
                                    <label class="form-check-label">Skull</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="27" required>
                                    <label class="form-check-label">Stomach Content</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="28" required>
                                    <label class="form-check-label">Whole Body</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="29" required>
                                    <label class="form-check-label">Tick</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="30" required>
                                    <label class="form-check-label">Mite</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="31" required>
                                    <label class="form-check-label">Spike</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" value="32" required>
                                    <label class="form-check-label">Coral Tissue</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border border-dark border-1">
            <div class="ms-4">
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">DNA Extraction</p>
                    </div>
                    <div class="w-75">
                        <p class="fw-bold">Lab Analyst</p>
                        <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name"></p>
                        <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number"></p>

                        <p class="fw-bold">DNA Extraction Size (bp)</p>
                        <p class="mt-3"><input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="DNA Extraction Size (bp)"></p>
                    </div>
            </div>
            <hr class="border border-dark border-1">
            <div class="ms-4">
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">PCR</p>
                    </div>
                    <div class="w-75">
                        <p class="fw-bold">Lab Analyst</p>
                        <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name"></p>
                        <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number"></p>

                        <p class="fw-bold">PCR Amplification</p>
                        <p class="mt-3">Primer Used<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Primer Used"></p>
                        <p class="mt-3">Blast Result (%)<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Blast Result (%)"></p>
                    </div>
            </div>
            <hr class="border border-dark border-1">
            <div class="ms-4">
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">Cleaning Raw Sequence</p>
                    </div>
                    <div class="w-75">
                        <p class="fw-bold">Lab Analyst</p>
                        <p class="mt-3">Name<input type="text" class="form-control border border-1 border-dark w-50" placeholder="Lab analyst name"></p>
                        <p class="mt-3">Contact Number<input type="text" class="form-control border border-1 border-dark w-50 mb-5" placeholder="Lab analyst contact number"></p>

                        <div class="card w-50 p-3 border border-dark mt-4 mb-5">
                            <h6 class="card-title fw-bold">Raw Sequence</h6>
                            <div role="button" id="raw-sequence-container" class="p-5 card-body rounded border border-2 border-primary d-flex flex-column justify-content-center align-items-center text-center">
                                <p><span class="fw-bold text-success">Upload</span> your file here</p>
                                <p id="rawSequencefileName"></p>
                                <input type="file" id="raw-sequence" name="raw-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>

                        <div class="card w-50 p-3 border border-dark mt-4 mb-5">
                            <h6 class="card-title fw-bold">Cleaned Sequence</h6>
                            <div role="button" id="cleaned-sequence-container" class="p-5 card-body rounded border border-2 border-primary d-flex flex-column justify-content-center align-items-center text-center">
                                <p><span class="fw-bold text-success">Upload</span> your file here</p>
                                <p id="cleanedSequencefileName"></p>
                                <input type="file" id="cleaned-sequence" name="cleaned-sequence" accept=".txt" style="display:none;">
                            </div>
                        </div>
                    </div>
            </div>
            <hr class="border border-dark border-1">
        </main>
    </body>
</html>