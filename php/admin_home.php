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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../adminkit-main/static/js/app.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>
    </head>

    <body class="third-color">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php include "sidenav.php"; ?> 
                <main class="col ps-md-0 main-content">
                <?php
                    $buttonText = "Add user +";
                    $buttonLink = "adduser.php";
                    $searchPlaceholder = "Search for user";
                    $searchAction = "#";
                    include "topnav.php";
                ?>

                    <table class="table table-striped table-bordered table-hover mt-5 ms-2 text-center">
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
                            echo "<tr role='button' onclick='window.location.href = \"admin_row.php?user_id=" . $user_row['user_id'] . "\";'>";
                            echo "<td>" . $user_row['user_id'] . "</td>";
                            echo "<td>" . $user_row['user_username'] . "</td>";
                            echo "<td>" . $user_row['user_fullname'] . "</td>";
                            echo "<td>" . $user_row['user_email'] . "</td>";
                            echo "<td>" . $user_row['user_type'] . "</td>";
                            echo "<td><img src='" . $user_row['user_profilePicture'] . "' width='30'></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </body>
</html>