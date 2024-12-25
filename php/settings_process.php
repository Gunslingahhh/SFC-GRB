<?php
    session_start();
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['photo_submit'])) {
            date_default_timezone_set('Asia/Kuching');
            $image_createdAt = date("dmYHis");
            $user_id = $_SESSION['userid'];

            $sql = "UPDATE user
                    SET user_profilePicture = ?
                    WHERE user_id = ?";

            //Handle file upload
            $allowed_types = array('jpg', 'png', 'jpeg');

            if (($_FILES["user-photo-filename"]["tmp_name"]) == ""){
                $target_file = "";
                
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $target_file, $user_id);
                $stmt->execute();
                $_SESSION['message'] = "Your profile picture has been updated.";
                header("Location: settings.php");
            }
            else{
                //Get file extension
                $file_extension = strtolower(pathinfo($_FILES['user-photo-filename']['name'], PATHINFO_EXTENSION));
                $newfilename = "profilePicture_user_" . $user_id . "." . $file_extension;
                
                if (!in_array($file_extension, $allowed_types)) {
                $_SESSION['message'] = "Invalid file type. Only JPG and PNG are allowed.";
                header("Location: settings.php");
            }
            else{
                //Set target directory and filename
                $target_dir = "../assets/uploads/profile_picture/";
                $target_file = $target_dir . $newfilename;

                if (!move_uploaded_file($_FILES['user-photo-filename']['tmp_name'], $target_file)){
                    $_SESSION['message'] = "Error uploading file.";
                    header("Location: settings.php");
                }
                else{
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $target_file, $user_id);
                    $stmt->execute();
                    $_SESSION['message'] = "Your profile picture has been updated.";
                    header("Location: settings.php");
                }
            }
        }
        $stmt->close();
        $conn->close();
        } elseif (isset($_POST['info_submit'])) {
            $contactNumber = $_POST['contact-number'];
            $email = $_POST['email'];
            $organization = $_POST['organization'];
            $user_id = $_SESSION['userid'];

            $sql = "UPDATE user
                    SET user_contactNumber = ?, user_email = ?, user_organization = ?
                    WHERE user_id = ?";

            $data=array(
                $contactNumber,
                $email,
                $organization,
                $user_id
            );

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", ...$data);
            $stmt->execute();

            $_SESSION['message'] = "Information uploaded successfully.";
            header("Location: settings.php");
        } else {
            echo "No form submitted.";
        }
    }
    
?>

