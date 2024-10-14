<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['usertype']=='Admin'){
        header("Location: admin_home.php");
    }
    else if($_SESSION['usertype']=='Forensic'){
        header("Location: forensic_home.php");
    }
    else{
        header("Location: user_home.php");
    }
?>