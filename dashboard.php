<?php
    require "session_check.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
    echo "<p>"."Hola ".$_SESSION['user_name']."! Rut: ".$_SESSION['user_rut']."</p>";
    if($_SESSION['user_admin_status']=='S'){
        echo '<a href="adminUser.php">Vista Administrador</a>';
    }
?>
<form action="includes/logout.inc.php" method="post">
    <button type="submit" name="logout-submit">Logout</button>
</form>