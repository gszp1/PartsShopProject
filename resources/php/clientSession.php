<?php
    session_start();
    if(!isset($_SESSION["userName"])) {
        header("Location: loginPage.php");
        exit();
    }
?>
