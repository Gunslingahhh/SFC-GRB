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
                <main class="col ps-md-0 main-content">
                <?php
                    $buttonText = "Add specimen";
                    $buttonLink = "addspecimen.php";
                    $searchPlaceholder = "Search for specimen";
                    $searchAction = "page1_search.php";
                    $navItems = [
                        ['text' => 'Home', 'href' => 'index.php'],
                        ['text' => 'About', 'href' => 'about.php'],
                    ];
                    include "topnav.php";
                ?>

                    <table class="table table-striped table-hover mt-5">
                        <thead>
                            <tr>
                                <th>Specimen ID</th>
                                <th>Field Sampling Collection Number</th>
                                <th>Class</th>
                                <th>Genus</th>
                                <th>Species</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userid = $_SESSION['userid'];
                            $detail_check = $conn->prepare("SELECT specimen_id, specimen_collectionNumber, specimen_class, specimen_genus, specimen_species FROM specimen WHERE user_id = $userid");
                            $detail_check->execute();
                            $detail_result = $detail_check->get_result();
                            
                            while ($user_row = $detail_result->fetch_assoc()) {
                                echo "<tr onclick='window.location.href = \"admin_row.php?user_id=" . $user_row['user_id'] . "\";'>";
                                echo "<td>" . $user_row['user_id'] . "</td>";
                                echo "<td>" . $user_row['user_username'] . "</td>";
                                echo "<td>" . $user_row['user_fullname'] . "</td>";
                                echo "<td>" . $user_row['user_email'] . "</td>";
                                echo "<td>" . $user_row['user_type'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </body>
</html>