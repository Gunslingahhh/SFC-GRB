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
        <link rel="stylesheet" href="../css/adduser.css">
        <script src="../js/settings.js"></script>
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            <main class="col ps-md-0 main-content">
                <form class="ms-4" action="adduser_process.php" method="POST">
                    <h2 class="fw-bold">Add a user</h2>
                    <div class="d-flex w-100 mt-5 pt-5">
                        <div class="w-50">
                            <p class="fw-bold">User info</p>
                            <p>User login information</p>
                        </div>
                        <div class="w-75">
                            <p class="mt-3">Full name <input type="text" class="form-control border border-2 border-dark w-50" name="fullname" placeholder="Name" required></p>
                            <p class="mt-3">Username <input type="text" class="form-control border border-2 border-dark w-50" name="username" placeholder="Username" required></p>
                            <p class="mt-3">Password <input type="text" class="form-control border border-2 border-dark w-50" name="password" placeholder="Password" required></p>

                            <div><p>Stage
                                <select required name="user_role" id="sample_genus" name="sample_age" class="form-control form-control border border-2 border-dark w-50">
                                <option value=""> Select a role </option>
                                <option value="User">USER</option>
                                <option value="Forensic">FORENSIC</option>
                                <option value="Admin">ADMIN</option>
                                </select></p>
                            </div>
                            <?php
                                if (isset($_SESSION['error'])) {
                                    echo "<div class='alert alert-danger mt-3 text-center w-50'>" . $_SESSION['error'] . "</div>";
                                    unset($_SESSION['error']);
                                }

                                if (isset($_SESSION['message'])) {
                                    echo "<div class='alert alert-primary mt-3 text-center w-50'>" . $_SESSION['message'] . "</div>";
                                    unset($_SESSION['message']);
                                }
                            ?>
                            <div class="d-flex justify-content-center w-50">
                                <input type="submit" class="btn bg-primary text-white">
                            <div>
                        </div>
                    </div>
                </form>
                    
            </main>
            </div>
        </div>
    </body>
</html>