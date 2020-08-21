<?php
if(isset($_POST['reporte-submit'])){
    require '..\static\SimpleXLSXGen\SimpleXLSXGen.php';
    $periodo=$_POST['periodo'];
    $SimpleXLSXGen = new SimpleXLSXGen();
    $data = [
        ['Periodo',$periodo],
        ['Codigo','Responsable','Nombre Actividad','Fecha Ejecucion'],
        ['Datos1','Datos2','Datos3','Datos4'],
    ];
    SimpleXLSXGen::fromArray( $data )->downloadAs('Reporte SIVCM-FACMED '.date("d-m-yy").'.xlsx');
}else{
    header("Location ../dashboard.php");
    exit();
}