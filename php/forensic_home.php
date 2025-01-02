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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../adminkit-main/static/js/app.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>
    </head>

    <body class="bg-light">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php include "sidenav.php"; ?> 
                <main class="col ps-md-0 main-content third-color">
                    <div class="ms-3">
                        <form class="d-flex justify-content-end me-2" role="search" action="<?php echo $searchAction; ?>" method="GET">
                            <input class="form-control me-2 w-25" type="search" name="search" placeholder="Search for sample" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <table class="table table-striped table-hover mt-5">
                            <thead>
                                <tr class="text-center">
                                    <th>Specimen ID</th>
                                    <th>Collection Number</th>
                                    <th>Class</th>
                                    <th>Genus</th>
                                    <th>Species</th>
                                    <th>Name</th>
                                    <th>Contact Number</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $forensic_sql = "SELECT specimen.specimen_id, specimen.specimen_collectionNumber, specimen.specimen_class, specimen.specimen_genus, specimen.specimen_species, user.user_id, user.user_fullname, user.user_contactNumber, user.user_email
                                FROM specimen
                                JOIN user ON specimen.user_id = user.user_id";

                                $forensic_stmt = $conn->prepare($forensic_sql);
                                $forensic_stmt->execute();
                                $forensic_result = $forensic_stmt->get_result();

                                while ($forensic_row = $forensic_result->fetch_assoc()) {
                                    echo "<tr class='text-center' role='button' onclick='window.location.href = \"forensic_row.php?specimen_id=" . $forensic_row['specimen_id'] . "\";'>";
                                        echo "<td>" . $forensic_row['specimen_id'] . "</td>";
                                        echo "<td>" . $forensic_row['specimen_collectionNumber'] . "</td>";
                                        echo "<td>" . $forensic_row['specimen_class'] . "</td>";
                                        echo "<td>" . $forensic_row['specimen_genus'] . "</td>";
                                        echo "<td>" . $forensic_row['specimen_species'] . "</td>";
                                        echo "<td>" . $forensic_row['user_fullname'] . "</td>";
                                        echo "<td>" . $forensic_row['user_contactNumber'] . "</td>";
                                        echo "<td>" . $forensic_row['user_email'] . "</td>";
                                    echo "</tr></a>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>