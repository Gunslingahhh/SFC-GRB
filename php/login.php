<?php
    session_start();
    // Include the database connection file
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SFC-GRB System</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../adminkit-main/static/js/app.js"></script>
    </head>
    <body>
        <div class="mt-5">
            <div class="d-flex wallpaper w-100 bg-light border-0">
                <div class="w-50 mt-5 p-5 text-white text-center d-flex justify-content-center align-items-center" style="min-height: 100px;">
                    <h2 class="card-title d-flex flex-column text-black fw-bold justify-content-center">
                        <span>Sarawak Forestry Corporation</span>
                        <span>Genetic Resource Bank</span>
                    </h2>
                </div>
                <div class="w-50 mt-5 p-5 text-white text-center d-flex justify-content-center">
                    <div class="w-50 card bg-white"> <!-- body-container-card-->
                        <div class="card-body"> <!-- body-container-card-body -->
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <a href="../index.php" class="d-flex justify-content-center">
                                    <img src="../assets/image/logo.png" width="20%" alt="Your Logo Alt Text">
                                </a>
                                <form action="login_process.php" method="POST" class="p-3">
                                    <p class="text-center fw-bold">Welcome to SFC-GRB</p>
                                    <input type="text" class="border-1 border-dark form-control mt-2 text-center" name="username" placeholder="Username">
                                    <input type="password" class="border-1 border-dark form-control mt-2 text-center" name="password" placeholder="Password">
                                    <?php
                                        if (isset($_SESSION['message'])) {
                                            echo "<div class='alert alert-danger mt-3 text-center'>" . $_SESSION['message'] . "</div>";
                                            unset($_SESSION['message']);
                                        }
                                    ?>
                                    <button type="submit" class="form-control mt-4 text-center text-bg-primary">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>