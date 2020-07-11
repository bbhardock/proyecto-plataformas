<?php
    session_start();
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Registrar Academico</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="static/css/registrar.css?v1.3" rel="stylesheet">
    </head>
    <body>
        <div class="login-box">
            <?php
                $rut = "";
                $nombre = "";
                $telefono = "";
                $correo_electronico = "";
                if(isset($_GET['error'])){
                    $cod_error = $_GET['error'];
                    if($cod_error == "rutemailinvalido"){
                        $nombre = $_GET['nombre'];
                        $telefono = $_GET['telefono'];
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Rut y email inválidos!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "rutinvalido"){
                        $nombre = $_GET['nombre'];
                        $telefono = $_GET['telefono'];
                        $correo_electronico = $_GET['email'];
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Rut Inválido!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "emailinvalido"){
                        $rut = $_GET['rut'];
                        $telefono = $_GET['telefono'];
                        $correo_electronico = $_GET['email'];
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Email inválido!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "telefonoinvalido"){
                        $rut = $_GET['rut'];
                        $nombre = $_GET['nombre'];
                        $correo_electronico = $_GET['email'];
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Número de teléfono inválido!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "rutyaingresado"){
                        $nombre = $_GET['nombre'];
                        $telefono = $_GET['telefono'];
                        $correo_electronico = $_GET['email'];
                        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>El rut ya está ingresado!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }if($cod_error == "errorsql"){
                        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error del sistema!</strong>
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
            <h2>Registro de Académico</h2>
            <form action="includes/registro.inc.php" method="POST" id = "Ingresar">

                <label for="username">Usuario</label>
                <input maxlength="9" type="text" placeholder="Ingrese su RUT (Sin puntos ni guiones)" required="" name="rut" value="<?php echo $rut; ?>">

                <label for="name">Nombre</label>
                <input type="text" placeholder="Ingrese su Nombre" required="" name="nombre" value="<?php echo $nombre; ?>" >

                <label for="telefono">Teléfono</label>
                <input maxlength="12" minlength="8" type="text" placeholder="Numero telefonico" required="" name="telefono" value="<?php echo $telefono; ?>">

                <label for="correo">Correo Electrónico</label>
                <input type="text" placeholder="Ingrese su correo" required="" name="email" value="<?php echo $correo_electronico; ?>">

                <input type="checkbox" name="honorario" id="btn-pass">
                <label for="btn-pass">¿No posee cuenta online UCN?</label>

                <div class="password">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" placeholder="Ingrese su contraseña" name="contraseña">    
                </div>

                <input type="submit" value="Registrar" name="registrar-submit">

                <p> Si quieres volver al Inicio click en <a href="index.php">Inicio</a></p>
                <p>¿Ya estas registrado? <a href="login.php">Click aqui</a></p>

            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>  
    </body>

</html>