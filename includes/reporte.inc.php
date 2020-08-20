<?php
if(isset($_POST['reporte-submit'])){
    require 'SimpleXLSXGen.php';
    $SimpleXLSXGen = new SimpleXLSXGen();
    $data = [
        ['Codigo','Responsable','Nombre Actividad','Fecha Ejecucion'],
        ['Datos1','Datos2','Datos3','Datos4'],
    ];
    SimpleXLSXGen::fromArray( $data )->downloadAs('Reporte.xlsx');
}else{
    header("Location ../dashboard.php");
    exit();
}