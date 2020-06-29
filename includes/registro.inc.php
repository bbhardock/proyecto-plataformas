<?php
if(isset($_POST['registrar-submit'])){

    require 'databaseHandler.inc.php';

    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    if(!preg_match("/^[0-9kK]*$/",$rut) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registro.php?error=rutemailinvalido&nombre=".$nombre."&telefono=".$telefono);
        exit();
    }
    else if(!preg_match("/^[0-9kK]*$/",$rut)){
        header("Location: ../registro.php?error=rutinvalido&nombre=".$nombre."&telefono=".$telefono."&email=".$email);
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registro.php?error=emailinvalido&rut=".$rut."&nombre=".$nombre."&telefono=".$telefono);
        exit();
    }else if(!preg_match("/^[0-9+ ]*$/",$telefono))   {
        header("Location: ../registro.php?error=telefonoinvalido&rut=".$rut."&nombre=".$nombre."&email=".$email);
        exit(); 
    }
    else{
        $sql = "SELECT id_code FROM usuarios WHERE UPPER(rut)=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../registro.php?error=errorsql");
            exit();    
        }else{
            mysqli_stmt_bind_param($stmt, "s", $rut);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../registro.php?error=rutyaingresado&nombre=".$nombre."&telefono=".$telefono."&email=".$email);
                exit();                
            }else{//pasó toda la validación, aquí pasa cuando todo es exitoso
                $stmt = mysqli_stmt_init($conn);
                if(isset($_POST['honorario'])){
                    $sql = "INSERT INTO usuarios(rut,nombre,telefono,correo_electronico,estado,es_admin,tipo_contrato,pass)
                    VALUES (?,?,?,?,'P','N','H',?)";
                    $hashedPwd = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../registro.php?error=errorsql");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssss", $rut, $nombre, $telefono, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                    }
                }else{
                    $sql = "INSERT INTO usuarios(rut,nombre,telefono,correo_electronico,estado,es_admin,tipo_contrato)
                    VALUES (?,?,?,?,'P','N','C')";    
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../registro.php?error=errorsql");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssss", $rut, $nombre, $telefono, $email);
                        mysqli_stmt_execute($stmt);
                    }                    
                }
                header("Location: ../login.php?signup=success");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else{
    header("Location ../registro.php");
    exit();
}

