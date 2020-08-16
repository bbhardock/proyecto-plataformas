<?php
function insertarUsuario($rut){
    require 'databaseHandler.inc.php';
    $sql = "INSERT INTO usuarios(rut,estado,es_admin)
    VALUES (?,'A','N')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $rut);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);                
}
function obtener_datos_usuario($rut){
    require 'databaseHandler.inc.php';
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
        }else{
            return NULL;
        }
    }
    mysqli_close($conn);
}
function obtenerUsuariosPermitidos(){
    require 'databaseHandler.inc.php';
    $sql = "SELECT id_code,rut,es_admin FROM usuarios WHERE estado='A'";
    $stmt = mysqli_stmt_init($conn);
    $respuesta = new \stdClass();
    $JSONrespuesta;
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)){
            $rows[] = $r;
            //rows es una matriz tipo rows[0]['rut']
        }
        $JSONrespuesta = json_encode($rows);
        return $JSONrespuesta; 
    }
    mysqli_close($conn);
}
function obtenerUsuariosDenegados(){
    require 'databaseHandler.inc.php';
    $sql = "SELECT id_code,rut FROM usuarios WHERE estado='D'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result))  {
            $rows[] = $r;
        }
        $JSONrespuesta = json_encode($rows);
        return $JSONrespuesta; 
    }
    mysqli_close($conn);
}
function permitirAccesoUsuario($idUsuario){
    require 'databaseHandler.inc.php';
    $sql = "UPDATE usuarios SET estado='A' WHERE id_code=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_bind_param($stmt,"i",$idUsuario);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}
function denegarAccesoUsuario($idUsuario){
    require 'databaseHandler.inc.php';
    $sql = "UPDATE usuarios SET estado='D' WHERE id_code=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_bind_param($stmt,"i",$idUsuario);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}
function hacerAdminUsuarioPermitido($idUsuario){
    require 'databaseHandler.inc.php';
    $sql = "UPDATE usuarios SET es_admin='S' WHERE id_code=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_bind_param($stmt,"i",$idUsuario);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}
function deshacerAdminUsuarioPermitido($idUsuario){
    require 'databaseHandler.inc.php';
    $sql = "UPDATE usuarios SET es_admin='N' WHERE id_code=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_bind_param($stmt,"i",$idUsuario);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}
function eliminarUsuario($idUsuario){
    require 'databaseHandler.inc.php';
    $sql = "DELETE FROM usuarios WHERE id_code=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    }else{
        mysqli_stmt_bind_param($stmt,"i",$idUsuario);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}

function insertarActividad($code_activity,$nombre,$correo,$telefono,$requiere_reunion,$hour_reunion,$date_reunion,$number_participants,
    $requiere_apoyo_com,$apoyo_tecnico,$suplie_bandejas,$suplie_tapetes,$suplie_sillas,$suplie_paneles,$suplie_toldos,$suplie_otros,
    $pendon_famed,$pendon_enfermeria,$pendon_kine,$pendon_medi,$pendon_nutri,$constancia_impresa,$constancia_digital){
    
    require 'databaseHandler.inc.php';
    $sql = 'INSERT INTO actividades (id_vinculacion,nombre_solicitante,correo,telefono,logistica_pendon_famed_S_N,logistica_pendon_kine_S_N,
    logistica_pendon_medi_S_N,logistica_pendon_nutri_S_N,logistica_const_impresa_S_N,logistica_const_digital_S_N,requiere_reunion_S_N,fecha_reunion,
    hora_reunion,cantidad_aprox_participantes,cant_insumo_bandejas,cant_insumo_tapetes,cant_insumo_sillas,cant_insumo_paneles,
    cant_insumo_toldos,cant_insumo_otros) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return NULL;
    } else {
        mysqli_stmt_bind_param($stmt, "sssssssssssssiiiiiii", $code_activity,$nombre,$correo,$telefono,$pendon_famed,$pendon_kine,$pendon_medi,$pendon_nutri,
        $constancia_impresa,$constancia_digital,$requiere_reunion,$date_reunion,$hour_reunion,$number_participants,$suplie_bandejas,$suplie_tapetes,$suplie_sillas,
        $suplie_paneles,$suplie_toldos,$suplie_otros);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_error($stmt);
    }
    mysqli_close($conn);                
}


