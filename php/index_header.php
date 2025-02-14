<?php
// Include the database connection file
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="adminkit-main/static/js/app.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-body-tertiary p-0">
        <div class="container-fluid">    
            <a class="ps-5 ms-5 navbar-brand d-flex align-items-center" href="#">
                <img src="assets/image/logo.png" alt="SFC-GRB System" height="100">
            </a>
            <div class="pe-5 me-5 d-flex flex-column header-text fw-semibold">
                <h3 class="header-text fw-semibold text-center">Sarawak Forestry Corporation Genetic Resource Bank (SFC-GRB)</h3>
            </div>
            <div class="d-flex">
                <form class="d-flex" action="php/login.php">
                    <button class="btn btn-primary me-2" type="submit">Log In</button>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>