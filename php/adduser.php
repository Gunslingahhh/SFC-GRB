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
            </div>
            <div class="item2">
                <h1>Add New User</h1>
            </div>
            <div class="item3">
                <p class="title-text">User Information</p>
            </div>
            <div class="item4">
                <div id="form-container">
                    <form action="adduser_process.php" method="POST">
                        <div class="form-group one-flex">
                            <label class="top-label">Full Name</label>
                            <input type="text" class="large-input one-flex" name="fullname" placeholder="Full name">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Username</label>
                            <input type="text" class="large-input one-flex" name="username" placeholder="Username">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Password</label>
                            <input type="text" class="large-input one-flex" name="password" placeholder="Password">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Age</label>
                                    <select required name="user_role" class="large-input">
                                        <option value=""> ========== Role ========== </option>
                                        <option value="User">USER</option>
                                        <option value="Forensic">FORENSIC</option>
                                        <option value="Admin">ADMIN</option>
                                    </select> 
                        </div>
                        <input type="submit" id="submit-button" value="Add user">
                    </form>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }

                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>