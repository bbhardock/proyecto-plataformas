<?php
    require "session_check.php";
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Ingreso Academico</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="static/css/registrar.css?v1.2" rel="stylesheet"> 
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="login-box">
            <?php
                if(isset($_GET['error'])){
                    $cod_error = $_GET['error'];
                    if($cod_error == "passincorrecta"){
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Contraseña incorrecta!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "sqlerror"){
                        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error del sistema!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "usuarioPendiente"){
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>El usuario está pendiente!</strong> espere a ser aceptado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "usuarioDenegado"){
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Se le ha denegado el acceso</strong> al usuario.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "nouser"){
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    El usuario no ha <strong>sido registrado.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }
                }else if(isset($_GET['signup'])){
                    if($_GET['signup'] == "success"){
                        echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Registro exitoso.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
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
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>    
    </body>

</html>