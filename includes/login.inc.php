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
    require_once 'queries.inc.php';
    $resultado = login_tongoy($rut,$password);

    $verificacionPeriodoPasado = strcmp(json_decode(apiverificarActividad($rut,date('Y')))->RespuestaSolicitud,"True") == 0; //si tiene actividades este año
    $verificacionPeriodoAnterior = strcmp(json_decode(apiverificarActividad($rut,date('Y',strtotime('-1 year'))))->RespuestaSolicitud,"True") == 0; //si tiene actividades el año pasado

    $estadoActividades = $verificacionPeriodoPasado || $verificacionPeriodoAnterior;
    if(($resultado == 'ok' && $estadoActividades) || ($resultado == 'ok' && $row['es_admin'] == 'S')){ //Pasadas todas las comprobaciones, iniciar sesión.
        session_start();
        $_SESSION[user_id]= $row['id_code'];
        $_SESSION[user_rut]= $row['rut'];
        $_SESSION[user_admin_status]= $row['es_admin'];
        header("Location: ../dashboard.php");
        exit();
    }else if ($resultado != 'ok'){ //La api de tongoy no autenticó, credenciales incorrectas
        header("Location: ../login.php?error=passincorrecta");
        exit();
    }else if (!$estadoActividades){//No existen actividades, se deniega el acceso. Esto se puede revocar por un administrador en su pantalla de administradores.
        denegarAccesoUsuario($row['id_code']);
        header("Location: ../login.php?error=noactividades");
        exit();
    }
}

if (isset($_POST['login-submit'])){
    require_once 'queries.inc.php';

    $rut = $_POST['rut'];
    $password = $_POST['password'];
    if(!preg_match("/^[0-9kK]*$/",$rut)){ //el rut debe ser ingresado sin puntos ni guión
        header("Location: ../login.php?error=formatoincorrecto");
        exit();
    }

    $row = obtener_datos_usuario($rut); //fila representativa de la base de datos de usuarios

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