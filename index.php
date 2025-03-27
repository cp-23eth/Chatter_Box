<?php
    session_start();

    $_SESSION['imgSrc'] = "";
    $_SESSION['user'] = "";

    header("Location: login.php");
    exit();
?>
