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
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row w-100 text-center">
                <div class="col d-flex justify-content-start">
                    <a class="ms-5 ps-5 navbar-brand" href="#">
                        <img src="assets/image/logo.png" alt="SFC-GRB System" height="100">
                    </a>
                </div>
                <div class="col-6 d-flex align-items-center">
                    <h3 class="header-text fw-semibold">Sarawak Forestry Corporation Genetic Resource Bank (SFC-GRB)</h3>
                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <a class="navbar-brand" href="#">
                        <img class="me-5" src="assets/image/SWIF LOGO.png" alt="SWIF LOGO" height="90">
                    </a>
                    <form class="me-5" action="php/login.php">
                        <button class="btn btn-primary" type="submit">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>