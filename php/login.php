<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div id="body-container" class="center">
        <div id="header-bar"></div>
        <h1>Sarawak Forestry Corporation<br>Genetic Resource Bank</h1>
        <div id="login-container">
            <a href="../index.php"><img src="../assets/image/logo.png" alt="SFC Logo"></a>
            <h2>Welcome to SFC-GRB</h2>
            <form action="login_process.php" method="POST">
                <input type="text" name="username" id="" placeholder="Username" required>
                <input type="password" name="password" id="" placeholder="Password" required>
                <input type="submit" value="Log In">
            </form>
        </div>
        <div id="footer-bar"></div>
    </div>
</body>
</html>