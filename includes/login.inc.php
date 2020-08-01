<?php
function login_tongoy($rut,$pass){
    $url = 'http://losvilos.ucn.cl/tongoy/a.php?op=auth';
    $data = array('u' => $rut, 'p' => $pass);
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        return 'sin_resultado';
    }
    $data = json_decode($result); //como llega en json hay que convertirlo
    return $data->status;
}
function iniciar_sesion($rut,$pass,$row){
    $resultado = login_tongoy($rut,$password);
    if($resultado == 'ok'){
        session_start();
        $_SESSION[user_id]= $row['id_code'];
        $_SESSION[user_rut]= $row['rut'];
        $_SESSION[user_admin_status]= $row['es_admin'];
        header("Location: ../dashboard.php");
        exit();
    }else{
        header("Location: ../login.php?error=passincorrecta");
        exit();
    }
}
function obtener_datos_usuario($rut){
    $sql = "SELECT * FROM usuarios WHERE rut=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../login.php?error=sqlerror");
        exit();
    }else{    
        mysqli_stmt_bind_param($stmt,"s",$rut);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        else{
            return null;
        }
}
if (isset($_POST['login-submit'])){
    require 'queries.inc.php';
    require 'databaseHandler.inc.php';

    $rut = $_POST['rut'];
    $password = $_POST['password'];

    $row = obtener_datos_usuario($rut);
    if(!is_null($datos_usuario)){//AQUÍ ENTRA SI EL USUARIO EXISTE
        $estado_usuario = $row['estado'];
        if($estado_usuario == 'A'){
            iniciar_sesion($rut,$pass,$row);
        }else if($estado_usuario == 'D'){
            header("Location: ../login.php?error=usuarioDenegado");
            exit();
        }
    }else{//SI NO ESTÁ INGRESADO, DEBERÍA SER INGRESADO A LA BASE DE DATOS
        insertarUsuario($rut);
        $row = obtener_datos_usuario($rut); //no revisar porque el usuario recien insertado tiene permisos
        iniciar_sesion($rut,$pass,$row);
    }

    }

}else{
    header("Location: ../index.php");
    exit();
}