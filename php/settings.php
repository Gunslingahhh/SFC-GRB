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
        <link rel="stylesheet" href="../css/settings.css">
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
                <h1>Settings</h1>
            </div>
            <div class="item3">
                <p class="title-text">Edit profile</p>
            </div>
            <div class="item4">
                <div id="form-container">
                    <form action="settings_process.php" enctype="multipart/form-data" method="POST">
                        <div class="form-group two-flex" style="flex: 1 1 50px;">
                            <label class="top-label">Profile picture</label>
                            <div id="profile-picture-container">
                                <img id="profile-picture" src="<?php echo $profilePictureSrc; ?>">
                            </div>
                        </div>
                        <div class="form-group two-flex" style="flex: 1 1 300px; padding-top: 20px;">
                            <div id="upload-button">
                                <p>Upload Photo</p>
                                <input type="file" id="image-file" name="image-file" accept="image/jpeg, image/png, image/jpg" style="display: none;">
                            </div>
                            <div id="remove-button"><p>Remove Photo</p></div>
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Contact number (<?php echo $contactNumber; ?>)</label>
                            <input type="text" class="large-input one-flex" name="contact-number" placeholder="Contact number">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">E-mail (<?php echo $email; ?>)</label>
                            <input type="text" class="large-input one-flex" name="email" placeholder="E-mail">
                        </div>
                        <div class="form-group one-flex">
                            <label class="top-label">Organization (<?php echo $organization; ?>)</label>
                            <input type="text" class="large-input one-flex" name="organization" placeholder="Organization">
                        </div>

                        <input type="submit" id="submit-button">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>