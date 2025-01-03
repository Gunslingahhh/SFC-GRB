<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}

include "connection.php";

// Query for Genus
$sql_genus = "SELECT specimen_genus FROM specimen UNION SELECT species_genus FROM species ORDER BY specimen_genus ASC";
$stmt_genus = $conn->prepare($sql_genus);
if (!$stmt_genus) { die("Prepare genus failed: " . $conn->error); }
$stmt_genus->execute();
if (!$stmt_genus) { die("Execute genus failed: " . $stmt_genus->error); }
$result_genus = $stmt_genus->get_result();
$genus_options = [];
if ($result_genus->num_rows > 0) {
    while ($row = $result_genus->fetch_assoc()) {
        $genus_options[] = $row['specimen_genus'];
    }
}
$stmt_genus->close();


// Query for Class (assuming you have a specimen_class and species_class)
$sql_class = "SELECT specimen_class FROM specimen UNION SELECT species_class FROM species ORDER BY specimen_class ASC";
$stmt_class = $conn->prepare($sql_class);
if (!$stmt_class) { die("Prepare class failed: " . $conn->error); }
$stmt_class->execute();
if (!$stmt_class) { die("Execute class failed: " . $stmt_class->error); }
$result_class = $stmt_class->get_result();
$class_options = [];
if ($result_class->num_rows > 0) {
    while ($row = $result_class->fetch_assoc()) {
        $class_options[] = $row['specimen_class'];
    }
}
$stmt_class->close();

// Query for Species (assuming you have a specimen_class and species_class)
$sql_species = "SELECT specimen_species FROM specimen UNION SELECT species_species FROM species ORDER BY specimen_species ASC";
$stmt_species = $conn->prepare($sql_species);
if (!$stmt_species) { die("Prepare class failed: " . $conn->error); }
$stmt_species->execute();
if (!$stmt_species) { die("Execute class failed: " . $stmt_species->error); }
$result_species = $stmt_species->get_result();
$species_options = [];
if ($result_species->num_rows > 0) {
    while ($row = $result_species->fetch_assoc()) {
        $species_options[] = $row['specimen_species'];
    }
}
$stmt_species->close();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../adminkit-main/static/js/app.js"></script>
    <script src="../js/app.js"></script>
    </head>
<body class="third-color">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "sidenav.php"; ?>
            <main class="col ps-md-0 main-content">
                <div class="ms-4">
                <h2 class="fw-bold">Add a sample</h2>
                <div class="d-flex w-100 mt-5 pt-5">
                    <div class="w-50">
                        <p class="fw-bold">Sample receive</p>
                        <p>How did the sample received?</p>
                    </div>
                    <div class="w-75">
                        <label>Is your sample vouchered?</label>
                        <div id="button-container" onclick="buttonClicked()">
                            <div id="button-button"></div>
                            <input type="hidden" id="isVouchered" name="isVouchered" value="No">
                        </div>
                            
                        <p class="mt-3">Storage location of vouchered specimen <input type="text" class="form-control border border-1 border-dark w-50" id="storage_location" name="storage_location" value="" placeholder="Storage location of vouchered specimen" disabled></p>

                        <div class="mb-3">
                            <label class="form-label">Sample Method:</label><br>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="handingOver" value="Handing over / Release" required>
                                        <label class="form-check-label" for="handingOver">Handing over / Release</label>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="confiscated" value="Confiscated" required>
                                        <label class="form-check-label" for="confiscated">Confiscated</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="cases" value="Cases" required>
                                        <label class="form-check-label" for="cases">Cases</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="stranded" value="Stranded" required>
                                        <label class="form-check-label" for="stranded">Stranded</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="fishNet" value="Caught in Fish Net" required>
                                        <label class="form-check-label" for="fishNet">Caught in Fish Net</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="captivity" value="Captivity" required>
                                        <label class="form-check-label" for="captivity">Captivity</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="roadkill" value="Roadkill" required>
                                        <label class="form-check-label" for="roadkill">Roadkill</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="electricShock" value="Electric Shock" required>
                                        <label class="form-check-label" for="electricShock">Electric Shock</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="dogBite" value="Dog Bite" required>
                                        <label class="form-check-label" for="dogBite">Dog Bite</label>
                                    </div></div>
                                    <div class="col-md-6"> <div class="form-check">
                                        <input class="form-check-input border-1 border-dark" type="radio" name="sample_method" id="biomaterialSpecimen" value="Biomaterial Specimen" required>
                                        <label class="form-check-label" for="biomaterialSpecimen">Biomaterial Specimen</label>
                                        </div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border border-dark border-1">

                    <div class="d-flex w-100 mt-5 pt-5">
                        <div class="w-50">
                            <p class="fw-bold">Specimen</p>
                            <p>Detail of specimen</p>
                        </div>
                        <div class="w-75">
                            
                                <p>Sampling collection number <input type="text" name="sampling_number" class="form-control border border-1 border-dark w-50" placeholder="Sampling collection number"></p>
                                <p>Location of Capture <input type="text" name="location_capture" class="form-control border border-1 border-dark w-50" placeholder="Location of Capture"></p>
                                <p>Latitude
                                    <input type="radio" class="form-control-m" name="latitude_northsouth" value="N" required><strong>N</strong>
                                    <input type="radio" class="form-control-m" name="latitude_northsouth" value="S" required><strong>S</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="latitude_degree"><strong>°</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="latitude_minutes"><strong>'</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="latitude_seconds"><strong>''</strong>
                                </p>
                                <p>Longitude
                                    <input type="radio" class="form-control-m" name="longitude_eastwest" value="E" required><strong>E</strong>
                                    <input type="radio" class="form-control-m" name="longitude_eastwest" value="W" required><strong>W</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="longitude_degree"><strong>°</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="longitude_minutes"><strong>'</strong>
                                    <input required type="number" class="form-control-sm border-1 border-dark" name="longitude_seconds"><strong>''</strong>
                                </p>
                                <p>Class
                                    <select required name="sample_class" id="sample_class" class="form-control form-control-sm w-50 border border-1 border-dark">
                                        <option value="">Class</option>
                                        <?php if (!empty($class_options)): ?>
                                            <?php foreach ($class_options as $option): ?>
                                                <option value="<?php echo htmlspecialchars($option); ?>"><?php echo htmlspecialchars($option); ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>No class available</option>
                                        <?php endif; ?>
                                    </select>
                                </p>
                                <div style="display: flex; align-items: center;">
                                    <div style="display: inline-block; margin-right: 10px;"> <p>Genus
                                        <select required name="sample_genus" id="sample_genus" class="form-control form-control-sm border border-1 border-dark" style="width: 300px;">
                                            <option value="">Genus</option>
                                            <?php if (!empty($genus_options)): ?>
                                                <?php foreach ($genus_options as $option): ?>
                                                    <option value="<?php echo htmlspecialchars($option); ?>"><?php echo htmlspecialchars($option); ?></option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option value="" disabled>No genus available</option>
                                            <?php endif; ?>
                                        </select></p>
                                    </div>
                                    <div style="display: inline-block;">
                                        <p>Species
                                            <select required name="sample_species" id="sample_species" class="form-control form-control-sm border border-1 border-dark" style="width: 300px;">
                                                <option value="">Species</option>
                                                <?php if (!empty($species_options)): ?>
                                                    <?php foreach ($species_options as $option): ?>
                                                        <option value="<?php echo htmlspecialchars($option); ?>"><?php echo htmlspecialchars($option); ?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="" disabled>No species available</option>
                                                <?php endif; ?>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div style="display: inline-block; margin-right: 10px;"> <p>Sex
                                        <select required name="sample_genus" id="sample_genus" name="sample_sex" class="form-control form-control-sm border border-1 border-dark" style="width: 200px;">
                                            <option value="">Sex</option>
                                            <option value="Male">MALE</option>
                                            <option value="Female">FEMALE</option>
                                        </select></p>
                                    </div>
                                    <div style="display: inline-block; margin-right: 10px;"> <p>Stage
                                        <select required name="sample_genus" id="sample_genus" name="sample_age" class="form-control form-control-sm border border-1 border-dark" style="width: 200px;">
                                        <option value=""> Stage </option>
                                        <option value="Subadult">SUBADULT</option>
                                        <option value="Juvenile">JUVENILE</option>
                                        <option value="Adult">ADULT</option>
                                        <option value="Larva">LARVA</option>
                                        </select></p>
                                    </div>
                                    <div style="display: inline-block;">
                                        <p>Weight <input type="text" name="sample_weight" class="form-control form-control-sm border border-1 border-dark" style="width:200px;" placeholder="Weight(kg)"></p>
                                    </div>
                                </div>         
                                
                                <input type="submit" class="btn bg-primary text-white">
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>