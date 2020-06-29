<?php
    require "session_check.php";
    require "header.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang = "es">
    <body>
        <?php
            if(isset($_GET['login']) && $_GET['login'] == 'success'){
                echo "<p>"."Hola ".$_SESSION['user_name']."! Rut: ".$_SESSION['user_rut']."</p>";
            }
        ?>
        <p> Esta es la vista principal, donde se ven las actividades </p>
    </body>