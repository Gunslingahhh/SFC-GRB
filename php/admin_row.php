<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['id'];

    $detail_check = $conn->prepare("SELECT * FROM user WHERE user_id = $id");
    $detail_check->execute();
    $detail_result = $detail_check->get_result();
    
    while ($user_row = $detail_result->fetch_assoc()) {
        $profilePicture = $user_row['user_profilePicture'];
        $userName = $user_row['user_username'];
        $fullName = $user_row['user_fullname'];
        $email = $user_row['user_email'];
        $contactNumber = $user_row['user_contactNumber'];
        $role = $user_row['user_type'];
        $organization = $user_row['user_organization'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/admin_row.css">
    </head>
    <body>
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            </div>
            <div class="item2">
                <h1>User ID: <?php echo($id) ?></h1>
            </div>
            <div class="item3">
                <div id="info-container" class="center">
                <img src="<?php echo $profilePicture; ?>" id="profile-picture">
                <p><b>Username: </b><?php echo($userName) ?></p>
                <p><b>Full Name: </b><?php echo($fullName) ?></p>
                <p><b>Email: </b><?php echo($email) ?></p>
                <p><b>Contact Number: </b><?php echo($contactNumber) ?></p>
                <p><b>Role: </b><?php echo($role) ?></p>
                <p><b>Organization: </b><?php echo($organization) ?></p>
                </div>
            </div>
            <div class="item4">
                <table class="center">
                    <tr>
                        <th>Subsample ID</th>
                        <th>Raw Sequence</th>
                        <th>Cleaned Sequence</th>
                        <th>Photo Identification</th>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>