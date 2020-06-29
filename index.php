<?php
    require "session_check.php";
    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
        exit();
    }
    require "header.php";
?>
Hola

