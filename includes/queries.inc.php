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
}
/*
header("Location: ../index.php"); //redirige para que no se acceda a este archivo
exit();
*/