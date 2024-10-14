<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/admin_home.css">
    </head>
    <body>
        <div id="body-container" class="center">
            <?php 
                include "sidenav.php";
            ?>
            <div id="header-container">
                <a href="adduser.php" id="add-user-button">
                    Add User
                </a>
                <form id="search-form" method="GET">
                    <input type="text" id="search-box" placeholder="Search...">
                    <input type="submit" id="search-button" value="Q">
                </form>
            </div>
            <div id="content-container">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Profile Picture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $detail_check = $conn->prepare("SELECT * FROM user");
                        $detail_check->execute();
                        $detail_result = $detail_check->get_result();
                        
                        while ($user_row = $detail_result->fetch_assoc()) {
                            echo "<tr onclick='window.location.href = \"admin_row.php?id=" . $user_row['user_id'] . "\";'>";
                            echo "<td>" . $user_row['user_id'] . "</td>";
                            echo "<td>" . $user_row['user_username'] . "</td>";
                            echo "<td>" . $user_row['user_fullname'] . "</td>";
                            echo "<td>" . $user_row['user_email'] . "</td>";
                            echo "<td>" . $user_row['user_type'] . "</td>";
                            echo "<td><img src='" . $user_row['user_profilePicture'] . "' width='30'></td>";
                            echo "</tr></a>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>