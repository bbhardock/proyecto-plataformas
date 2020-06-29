<?php
    require "session_check.php";
    require "header_dashboard.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
    echo "<p>"."Hola ".$_SESSION['user_name']."! Rut: ".$_SESSION['user_rut']."</p>";
?>