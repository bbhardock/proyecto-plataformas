<?php
    require "session_check.php";
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Ingreso Academico</title>
        <link href="static/css/registrar.css?v1.2" rel="stylesheet"> 
    </head>
    <body>
        <div class="login-box">
            <?php
                if(isset($_GET['error'])){
                    $cod_error = $_GET['error'];
                    if($cod_error == "passincorrecta"){
                        echo '<p class="signuperror">Contraseña incorrecta</p>';
                    }if($cod_error == "sqlerror"){
                        echo '<p class="signuperror">Error del sistema</p>';
                    }if($cod_error == "usuarioPendiente"){
                        echo '<p class="signuperror">El usuario está pendiente de ser aceptado</p>';
                    }if($cod_error == "usuarioDenegado"){
                        echo '<p class="signuperror">Se le ha denegado el acceso al usuario</p>';
                    }if($cod_error == "nouser"){
                        echo '<p class="signuperror">El usuario no ha sido registrado</p>';
                    }
                }else if(isset($_GET['signup'])){
                    if($_GET['signup'] == "success"){
                        echo '<p class="signupsucess">Registro exitoso</p>';
                    }
                }
            ?>
            <img class="logo" src="static/images/logo.png">
            <h2>Ingreso Académico</h2>
            <form action="includes/login.inc.php" method="POST" id = "Ingresar">

                <label for="username">Usuario</label>
                <input maxlength="9" type="text" placeholder="Ingrese su RUT (Sin puntos ni guiones)" name="rut" required="">

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Ingrese su Contraseña" name="password" required="">

                <input type="submit" value="Ingresar" name="login-submit">
    
                <p> Si quieres volver al Inicio click en <a href="index.php">Inicio</a></p>
                <p>¿No te has registrado? <a href="registro.php">Click aqui</a></p>
            </form>
        </div>
    </body>

</html>