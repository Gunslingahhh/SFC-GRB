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

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>
    </head>

    <body class="bg-light">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php include "sidenav.php"; ?> 
                <main class="col ps-md-5 mt-md-5 main-content">
                    <h1 class="mb-4">Settings</h1>
                    <h5>Edit profile</h5>
                    <div class="d-flex justify-content-center w-50 bg-warning">
                        <form action="settings_process.php" enctype="multipart/form-data" method="POST" class="w-75">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Profile Picture</label>
                                    <div class="rounded-circle overflow-hidden border border-3 border-dark" style="width: 150px; height: 150px; background-color: #eee;">
                                        <img id="user-photo" src="<?php echo $user_photo; ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                    </div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div>
                                        <input class="form-control form-control-sm d-none" type="file" id="user-photo-filename" name="user-photo-filename" accept="image/jpeg, image/png, image/jpg">
                                        <?php if (isset($_GET['error'])): ?>
                                            <div class="text-danger mt-2"><?php echo $_GET['error']; ?></div>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('user-photo-filename').click();">Upload Photo</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="contact-number" class="form-label">Contact Number:</label>
                                <input type="text" class="form-control" id="contact-number" name="contact_number" value="<?php echo $user_contactNumber; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_email; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="organization" class="form-label">Organization:</label>
                                <input type="text" class="form-control" id="organization" name="organization" value="<?php echo $user_organization; ?>">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>