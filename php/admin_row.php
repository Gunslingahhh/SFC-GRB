<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $id = $_GET['user_id'];

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
        <link rel="stylesheet" href="../css/adduser.css">
        <script src="../js/settings.js"></script>
    </head>
    <body class="third-color">
        <div class="grid-container center">
            <div class="item1">
                <?php 
                    include "sidenav.php";
                ?>
            <main class="col ps-md-0 main-content">
                <div class="ms-4 d-flex p-2">
                    <div class="card w-50">
                        <div class="card-body">
                            <h4>User information</h4>
                            <img src="<?php echo $profilePicture; ?>" class="rounded-circle mx-auto mt-3 bg- border border-3 border-dark" style="width: 150px; height: 150px; object-fit: cover;">
                            <p class="fw-bold mt-4"><span class="text-secondary">Username: </span><?php echo($userName) ?></p>
                            <p class="fw-bold"><span class="text-secondary">Email: </span><?php echo($email) ?></p>
                            <p class="fw-bold"><span class="text-secondary">Full Name: </span><?php echo($fullName) ?></p>
                            <p class="fw-bold"><span class="text-secondary">Contact Number: </span><?php echo($contactNumber) ?></p>
                            <p class="fw-bold"><span class="text-secondary">Role: </span><?php echo($role) ?></p>
                            <p class="fw-bold"><span class="text-secondary">Organization: </span><?php echo($organization) ?></p>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped w-75 h-100 ms-4">
                        <thead>
                            <tr class="text-center">
                                <th>Specimen ID</th>
                                <th>Class</th>
                                <th>Genus</th>
                                <th>Species</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = $conn->prepare("SELECT specimen_id, specimen_class, specimen_genus, specimen_species FROM specimen WHERE user_id = $id");
                                $sql->execute();
                                $result = $sql->get_result();
                                
                                while ($specimen_row = $result->fetch_assoc()) {
                                    echo "<tr class='text-center'>";
                                    echo "<td>" . $specimen_row['specimen_id'] . "</td>";
                                    echo "<td>" . $specimen_row['specimen_class'] . "</td>";
                                    echo "<td>" . $specimen_row['specimen_genus'] . "</td>";
                                    echo "<td>" . $specimen_row['specimen_species'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>    
            </main>
            </div>
        </div>
    </body>
</html>