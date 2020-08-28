<?php
if(isset($_POST['reporte-submit'])){
    require '..\static\SimpleXLSXGen\SimpleXLSXGen.php';
    require_once 'queries.inc.php';
    $periodo = $_POST['periodo'];

    $actividades = json_decode(apiListarTodasActividades($periodo));

    $SimpleXLSXGen = new SimpleXLSXGen();
    $data = [
        ['Periodo: ',$periodo],
        ['Departamento','Nombre Academico','Codigo actividad VCM','Nombre Actividad', 'Área de Vinculación', 'Servicio','Producto','Fecha Inicio - Fecha Termino', 'Lugar de Realizacion',
        'Listado Beneficiarios Internos','Listado Beneficiarios Externos (Directos e indirectos)','Impacto Interno','Impacto Externo','Socios Estratégicos','Estado'],
    ];
    foreach($actividades as $actividad){
        $filaNueva = [$actividad->Unidad, $actividad->NombreUsuario, $actividad->CodigoActividad, $actividad->NombreActividad, $actividad->AreaVinculacion, $actividad->Servicio, $actividad->Producto,
        $actividad->FechaInicio.' al '.$actividad->FechaTermino];  

        $lugaresRealizacion = "";
        if(isset($actividad->LugarRealizacion)){
            foreach($actividad->LugarRealizacion as $lugar){
                $lugaresRealizacion = $stringLugaresRealizacion.$lugar->LugarRealizacion.", ".$lugar->CiudadLocalidad.", ".$lugar->Comuna.", ".$lugar->Pais." / ";
            }            
        }
        $lugaresRealizacion = rtrim($lugaresRealizacion, " / ");
        $filaNueva[] = $lugaresRealizacion;

        $listadoBeneficiariosInternos = "";
        $listadoBeneficiariosExternos = "";
        $impactosInternos = "";
        $impactosExternos = "";
        $sociosEstrategicos = "";
        if(isset($actividad->ListadoBeneficiariosInternos)){
            foreach($actividad->ListadoBeneficiariosInternos as $benInternos){
                $listadoBeneficiariosInternos = $listadoBeneficiariosInternos.$benInternos->DescripcionBeneficiarioInterno." (".$benInternos->CantidadBeneficiariosDirectos.") / ";
            }
        }
        $filaNueva[] = $listadoBeneficiariosInternos;

        if(isset($actividad->ListadoBeneficiariosExternos)){
            foreach($actividad->ListadoBeneficiariosExternos as $benExternos){
                $listadoBeneficiariosExternos = $listadoBeneficiariosExternos.$benExternos->DescripcionBeneficiarioExterno." (".$benExternos->CantidadBeneficiariosDirectos." directos - ".
                $benExternos->CantidadBeneficiariosIndirectos." externos) / ";
            }
        }

        $filaNueva[] = $listadoBeneficiariosExternos;

        if(isset($actividad->ListaImpactoInternos)){
            foreach($actividad->ListaImpactosInternos as $impInternos){
                $impactosInternos = $impactosInternos.$impInternos->DescripcionImpacto." / ";
            }
        }
        $filaNueva[] = $impactosInternos;

        if(isset($actividad->ListaImpactosExternos)){
            foreach($actividad->ListaImpactosExternos as $impExternos){
                $impactosExternos = $impactosExternos.$impExternos->DescripcionImpacto." / ";
            }
        }
        $filaNueva[] = $impactosExternos;

        if(isset($actividad->ListadoSocios)){
            foreach($actividad->ListadoSocios as $socio){
                $sociosEstrategicos = $sociosEstrategicos.$socio->DescripcionSocio." / ";
            }
        }
        $filaNueva[] = $sociosEstrategicos;
        $filaNueva[] = $actividad->EstadoActividad;

        $data[] = $filaNueva;
    }
    SimpleXLSXGen::fromArray( $data )->downloadAs('Reporte SIVCM-FACMED '.date("d-m-yy").'.xlsx');
}else{
    header("Location ../dashboard.php");
    exit();
}