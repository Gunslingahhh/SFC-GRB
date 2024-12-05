<?php
    session_start();
    include "connection.php";

    // Check if user_id is set in session
    if (isset($_SESSION['userid'])) {
        $contactNumber=$_POST['contact-number'];
        $email=$_POST['email'];
        $organization=$_POST['organization'];
        date_default_timezone_set('Asia/Kuching');
        $image_createdAt = date("dmYHis");

        $sql = "UPDATE user
                SET user_profilePicture = ?, user_contactNumber = ?, user_email = ?, user_organization = ?
                WHERE user_id = ?";

        // Handle file upload
        $allowed_types = array('jpg', 'png', 'jpeg');

        if (($_FILES["image-file"]["tmp_name"]) != "") {
            // Get file extension
            $file_extension = strtolower(pathinfo($_FILES['image-file']['name'], PATHINFO_EXTENSION));

            $newfilename = "profile_picture_user_" . $_SESSION['userid'] . "." . $file_extension;

            // Check if file type is allowed
            if(in_array($file_extension, $allowed_types)) {
                // Set target directory and filename
                $target_dir = "../assets/uploads/profile_picture/";
                $target_file = $target_dir . $newfilename;

                // Move uploaded file to target directory
                if(move_uploaded_file($_FILES['image-file']['tmp_name'], $target_file)) {
                    $data = array(
                        $target_file,
                        $contactNumber,
                        $email,
                        $organization,
                        $_SESSION['userid']
                    );

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssi", ...$data);
                    $stmt->execute();

                    header("Location: settings.php");
                    exit();
                } 
                else {
                    echo "Error uploading file.";
                    header("Location: settings.php");
                    exit();
                }
            } 
            else {
                echo "Invalid file type. Only JPG and PNG are allowed.";
                header("Location: settings.php");
                exit();
            }
        } 
        else {
            // No image selected
            $target_file = "";
            $data = array(
                $target_file,
                $contactNumber,
                $email,
                $organization,
                $_SESSION['userid']
            );

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", ...$data);
            $stmt->execute();
            header("Location: settings.php");
            exit();
        }
    }
    else {
        echo "User ID is not set in session.";
    }
    $stmt->close();
    $conn->close();
?>
