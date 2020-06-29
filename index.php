<?php
    require "session_check.php";
    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
        exit();
    }
?>
Hola
<p><a href="login.php">Login</a></p>
<p><a href="registro.php">Registro</a></p>

