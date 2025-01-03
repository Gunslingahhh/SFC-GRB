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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../adminkit-main/static/js/app.js"></script>
        <script src="../js/app.js"></script>
    </head>
    <body class="third-color">
        <?php 
            include "sidenav.php";
        ?>
        <main class="col ps-md-0 main-content">
            
        </main>
    </body>
</html>