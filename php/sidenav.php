<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include "connection.php";
    // Retrieve user information from the database
    $userId = $_SESSION['userid'];
    $sql = "SELECT user_profilePicture FROM user WHERE user_id = $userId";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Get the profile picture path
    $profilePicturePath = $row['user_profilePicture'];

    // Check if a profile picture exists
    if ($profilePicturePath == "") {
        $profilePictureSrc = "";
    } else {
        // Use a default profile picture
        $profilePictureSrc = $profilePicturePath;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/sidenav.css">
</head>
<body>
    <div id="sidenav">
        <img src="<?php echo $profilePictureSrc; ?>" id="user-photo" class="center">
        <p id="user-name"><strong><?php echo $_SESSION['fullname']?></strong></p>
        <ul>
            <li><a href="redirect.php"><strong>Home</strong></a></li>
            <li><a href="settings.php"><strong>Settings</strong></a></li>
            <li><a href="logout.php"><strong>Logout</strong></a></li>
        </ul>
    </div>
</body>
</html>