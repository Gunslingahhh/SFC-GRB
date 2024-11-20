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
        <link rel="stylesheet" href="../css/user_home.css">
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
            <h1>Add a sample</h1>
        </div>
        <div class="item3">
            <p class="title-text">Specimen</p>
            <p class="subtitle-text">Detail of specimen</p>

            <p class="title-text" style="margin-top: 443px;">Sampling method</p>
            <p class="subtitle-text">How did the sample got collected?</p>
        </div>  
        <div class="item4"><div id="form-container">
                    <form action="user_process.php">
                        <div class="form-group one-flex">
                            <label class="top-label">Sampling collection number</label>
                            <input required type="text" class="large-input one-flex" name="sampling_number" placeholder="Sampling collection number">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Location of capture</label>
                            <input required type="text" class="large-input one-flex" name="location_capture" placeholder="Location of capture">
                        </div>
                        <div class="form-group one-flex">
                            <label class="side-label">Latitude</label>

                            <input type="radio" class="radio-input" name="latitude_northsouth" value="N" required><strong>N</strong>
                            <input type="radio" class="radio-input" name="latitude_northsouth" value="S" required><strong>S</strong>

                            <input required type="number" class="coordinate-input" name="latitude_degree"><strong>°</strong>
                            <input required type="number" class="coordinate-input" name="latitude_minutes"><strong>'</strong>
                            <input required type="number" class="coordinate-input" name="latitude_seconds"><strong>''</strong>
                        </div>
                        <div class="form-group one-flex">
                            <label class="side-label">Longitude</label>

                            <input type="radio" class="radio-input" name="longitude_eastwest" value="E" required><strong>E</strong>
                            <input type="radio" class="radio-input" name="longitude_eastwest" value="W" required><strong>W</strong>

                            <input required type="number" class="coordinate-input" name="longitude_degree"><strong>°</strong>
                            <input required type="number" class="coordinate-input" name="longitude_minutes"><strong>'</strong>
                            <input required type="number" class="coordinate-input" name="longitude_seconds"><strong>''</strong>
                        </div>
                        <div class="form-group one-flex">
                            <?php
                                include "connection.php";
                                
                                $sql = "SELECT DISTINCT species_class FROM species ORDER BY species_class ASC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $options = array();
                                    while($row = $result->fetch_assoc()) {
                                        $options[] = $row['species_class'];
                                    }
                                } else {
                                    echo "No results found.";
                                }

                                $conn->close();
                            ?>
                            <label class="top-label">Class</label>
                            <select required name="sample_class" id="sample_class" class="large-input">
                                <option value=""> Class </option>
                                <?php
                                    foreach ($options as $option) {
                                        echo "<option value='$option'>$option</option>";
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group two-flex">
                            <?php
                                include "connection.php";
                                
                                $sql = "SELECT DISTINCT species_genus FROM species ORDER BY species_genus ASC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $options = array();
                                    while($row = $result->fetch_assoc()) {
                                        $options[] = $row['species_genus'];
                                    }
                                } else {
                                    echo "No results found.";
                                }

                                $conn->close();
                            ?>
                            <label class="top-label">Genus</label>
                            <select required class="large-input" name="sample_genus">
                                <option value=""> Genus </option>
                                <?php
                                    foreach ($options as $option) {
                                        echo "<option value='$option'>$option</option>";
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group two-flex">
                            <?php
                                    include "connection.php";
                                    
                                    $sql = "SELECT DISTINCT species_species FROM species ORDER BY species_species ASC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $options = array();
                                        while($row = $result->fetch_assoc()) {
                                            $options[] = $row['species_species'];
                                        }
                                    } else {
                                        echo "No results found.";
                                    }

                                    $conn->close();
                                ?>
                                <label class="top-label">Species</label>
                                <select required class="large-input" name="sample_species">
                                    <option value=""> Species </option>
                                    <?php
                                        foreach ($options as $option) {
                                            echo "<option value='$option'>$option</option>";
                                        }
                                    ?>
                                </select> 
                        </div>
                        <div class="form-group three-flex">
                            <label class="top-label">Sex</label>
                                <select required name="sample_sex" class="small-input">
                                    <option value=""> Sex </option>
                                    <option value="Male">MALE</option>
                                    <option value="Female">FEMALE</option>
                                </select> 
                        </div>
                        <div class="form-group three-flex">
                            <label class="top-label">Stage</label>
                                <select required name="sample_age" class="small-input">
                                    <option value=""> Stage </option>
                                    <option value="Subadult">SUBADULT</option>
                                    <option value="Juvenile">JUVENILE</option>
                                    <option value="Adult">ADULT</option>
                                    <option value="Larva">LARVA</option>
                                </select> 
                        </div>
                        <div class="form-group three-flex">
                            <label class="top-label">Weight</label>
                            <input required type="number" class="small-input" name="sample_weight" placeholder="Weight (kg)">
                        </div>

                        <hr class="horizontal-line">  

                        <div class="form-group one-flex" style="margin-top:30px;">
                            <label class="side-label">Is your sample vouchered?</label>
                            <div id="button-container" onclick="buttonClicked()">
                                <div id="button-button"></div>
                                <input type="hidden" id="isVouchered" name="isVouchered" value="No">
                            </div>
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Storage location of vouchered specimen</label>
                            <input type="text" class="large-input one-flex" id="storage_location" name="storage_location" value="" placeholder="Storage location of vouchered specimen" disabled>
                        </div>
                        <div class="form-group two-flex">
                            <input required type="radio" class="radio-input" name="sample_method" value="Handing over / Release">Handing over / Release<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Confiscated">Confiscated<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Cases">Cases<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Stranded">Stranded<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Caught in Fish Net">Caught in Fish Net<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Captivity">Captivity<br>
                        </div>
                        <div class="form-group two-flex">
                            <input required type="radio" class="radio-input" name="sample_method" value="Roadkill">Roadkill<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Electric Shock">Electric Shock<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Dog Bite">Dog Bite<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="Biomaterial Specimen">Biomaterial Specimen<br>
                            <input required type="radio" class="radio-input" name="sample_method" value="From Researcher">From Researcher<br>
                        </div>
                        <input type="submit" id="submit-button">
                    </form>
                </div>
            </div>
        </div>
        </div>
        
    </body>
</html>