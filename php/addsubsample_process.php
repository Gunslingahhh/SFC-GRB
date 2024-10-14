<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
        exit();
    }

    include "connection.php";

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = hash('sha256',$_POST['password']);
    $role = $_POST['user_role'];

     // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username already exists.";
        header("Location: ../php/adduser.php");
        exit();
    }
    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO user(user_fullname, user_username, user_password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $password, $role);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: ../php/adduser.php");
        exit();
    } else {
        $_SESSION['error'] = "Error registering user: " . $stmt->error;
        header("Location: ../php/adduser.php");
        exit();
    }

    $stmt->close();
?>