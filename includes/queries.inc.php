<?php
function obtenerUsuariosPermitidos(){
    require 'databaseHandler.inc.php';
    $sql = "SELECT rut,nombre,correo_electronico FROM usuarios WHERE estado='A'";
    $stmt = mysqli_stmt_init($conn);
    $respuesta = new \stdClass();
    $JSONrespuesta;
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return null;
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
function obtenerUsuariosPendientes(){
    require 'databaseHandler.inc.php';
    $sql = "SELECT rut,nombre,correo_electronico FROM usuarios WHERE estado='P'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return null;
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
/*
header("Location: ../index.php"); //redirige para que no se acceda a este archivo
exit();
*/