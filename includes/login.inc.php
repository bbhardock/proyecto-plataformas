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
function iniciar_sesion($rut,$password,$row){
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

if (isset($_POST['login-submit'])){
    require 'queries.inc.php';

    $rut = $_POST['rut'];
    $password = $_POST['password'];

    $row = obtener_datos_usuario($rut);

    if(isset($row)){//AQUÍ ENTRA SI EL USUARIO EXISTE
        $estado_usuario = $row['estado'];
        if($estado_usuario == 'A'){
            iniciar_sesion($rut,$password,$row);
        }else if($estado_usuario == 'D'){
            header("Location: ../login.php?error=usuarioDenegado");
            exit();
        }
    }else{//SI NO ESTÁ INGRESADO, DEBERÍA SER INGRESADO A LA BASE DE DATOS
        $status = login_tongoy($rut,$password);
        if($status == 'ok'){
            insertarUsuario($rut);
            $row = obtener_datos_usuario($rut); //no revisar porque el usuario recien insertado tiene permiso
            iniciar_sesion($rut,$password,$row);
        }else{
            header("Location: ../login.php?error=passincorrecta");
            exit();
        }
    }

}else{
    header("Location: ../index.php");
    exit();
}