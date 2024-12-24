<?php  
    //Start the session
    session_start();

    // Include database connection
    include 'connection.php';

    $username = $_POST['username'];
    $password = hash('sha256',$_POST['password']);

    //Debug purpose
    //echo "Username: " . $username . "<br>" . "Password: " . $password;

    $detail_check = $conn->prepare("SELECT * FROM user WHERE BINARY user_username = ? AND user_password = ?");
    $detail_check->bind_param("ss", $username, $password);
    $detail_check->execute();
    $detail_result = $detail_check->get_result();
    $user_row = $detail_result->fetch_assoc();

    if ($detail_result->num_rows > 0){
        $user_id = $user_row['user_id'];
        $user_fullname = $user_row['user_fullname'];
        $user_username = $user_row['user_username'];
        $user_type = $user_row['user_type'];

        $_SESSION['userid'] = $user_id;
        $_SESSION['fullname'] = $user_fullname;
        $_SESSION['username'] = $user_username;
        $_SESSION['usertype'] = $user_type;
        

        if ($user_type == 'Admin'){
            header("Location: admin_home.php");
            exit();
        }
        else if ($user_type == 'Forensic'){
            header("Location: forensic_home.php");
            exit();
        }
        else {
            header("Location: user_home.php");
            exit();
        }
    }
    else{
        $_SESSION['message'] = "Please re-enter your login information!";
        header("Location: login.php");
        exit();
    }
?>