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
                    <?php include "topnav.php"; ?> 
                </main>
            </div>
        </div>
    </body>
</html>