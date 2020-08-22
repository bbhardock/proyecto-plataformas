<?php
$actividad1=array( "CodigoActividad" => "VCM221",
    "NombreActividad" => "Actividad1",
    "NombreUsuario" => "Brian Pardo",
    "RutUsuario" => "20006268k",
    "Unidad" => "Unidad act1",
    "AreaVinculacion" => "AreaVinculacion act1",
    "Servicio" => "Servicio act1",
    "Producto" => "Producto act1",
    "Periodo" => "2020",
    "FechaInicio" => "22-08-2020",
    "FechaTermino" => "09-10-2020",
    "EstadoActividad" => "Estado act1",
    "LugarRealizacion" =>
    array(array("Pais" => "Chile",
    "Comuna" => "Coquimbo",
    "CiudadLocalidad" => "Sindempart",
    "LugarRealizacion" => "Unimarc")),
"ListadoBeneficiariosInternos" => 
    array(array("DescripcionBeneficiarioInterno" => "Facultad de Medicina",
        "CantidadBeneficiariosDirectos" => "10"),
        array("DescripcionBeneficiarioInterno" => "Estudiantes",
        "CantidadBeneficiariosDirectos" => "40")),
"ListadoBeneficiariosExternos" =>
    array(array("DescripcionBeneficiarioExterno" => "Sector Productivo",
    "CantidadBeneficiariosDirectos" => "10",
    "CantidadBeneficiariosIndirectos" => "40"),
    array("DescripcionBeneficiarioExterno" => "Sector de servicios",
    "CantidadBeneficiariosDirectos" => "30",
    "CantidadBeneficiariosIndirectos" => "50")),
"ListaImpactosInternos" =>
    array(array("DescripcionImpacto" => "Impacto interno 1"),
    array("DescripcionImpacto" => "Impacto interno 2")),
"ListaImpactosExternos" =>
    array(array("DescripcionImpacto" => "Alianzas"),
    array("DescripcionImpacto" => "Estrategias")),
"ListadoSocios" =>
    array(array("DescripcionSocio"=> "Coquimbo Unido"))
);

$actividad2=array( "CodigoActividad" => "VCM1132",
"NombreActividad" => "Actividad2",
"NombreUsuario" => "Brian Pardo",
"RutUsuario" => "20006268k",
"Unidad" => "Unidad act2",
"AreaVinculacion" => "AreaVinculacion act2",
"Servicio" => "Servicio act2",
"Producto" => "Producto act2",
"Periodo" => "2020",
"FechaInicio" => "10-05-2020",
"FechaTermino" => "09-08-2020",
"EstadoActividad" => "Estado act2",
"LugarRealizacion" =>
    array(array("Pais" => "Chile",
    "Comuna" => "La Serena",
    "CiudadLocalidad" => "Las Compañias",
    "LugarRealizacion" => "Techado")),
"ListadoBeneficiariosInternos" => 
    array(array("DescripcionBeneficiarioInterno" => "Facultad de Medicina",
    "CantidadBeneficiariosDirectos" => "23"),
    array("DescripcionBeneficiarioInterno" => "Estudiantes",
    "CantidadBeneficiariosDirectos" => "56")),
"ListadoBeneficiariosExternos" =>
    array(array("DescripcionBeneficiarioExterno" => "Sector Productivo",
    "CantidadBeneficiariosDirectos" => "1",
    "CantidadBeneficiariosIndirectos" => "442"),
    array("DescripcionBeneficiarioExterno" => "Sector de servicios",
    "CantidadBeneficiariosDirectos" => "2",
    "CantidadBeneficiariosIndirectos" => "1000")),
"ListaImpactosInternos" =>
    array(array("DescripcionImpacto" => "Impacto interno 1"),
    array("DescripcionImpacto" => "Impacto interno 2")),
"ListaImpactosExternos" =>
    array(array("DescripcionImpacto" => "Impacto"),
    array("DescripcionImpacto" => "Superioridad tactica")),
"ListadoSocios" =>
    array(array("DescripcionSocio"=> "Deportes La Serena"))
);

$actividad3=array( "CodigoActividad" => "VCM999",
"NombreActividad" => "Actividad3",
"NombreUsuario" => "Otra Persona",
"RutUsuario" => "1111",
"Unidad" => "Unidad act2",
"AreaVinculacion" => "AreaVinculacion act3",
"Servicio" => "Servicio act3",
"Producto" => "Producto act3",
"Periodo" => "2020",
"FechaInicio" => "10-05-2020",
"FechaTermino" => "09-08-2020",
"EstadoActividad" => "Estado act3",
"LugarRealizacion" =>
    array(array("Pais" => "Chile",
    "Comuna" => "La Serena",
    "CiudadLocalidad" => "Las Compañias",
    "LugarRealizacion" => "Techado")),
"ListadoBeneficiariosInternos" => 
    array(array("DescripcionBeneficiarioInterno" => "Profesores",
    "CantidadBeneficiariosDirectos" => "23"),
    array("DescripcionBeneficiarioInterno" => "Estudiantes",
    "CantidadBeneficiariosDirectos" => "56")),
"ListadoBeneficiariosExternos" =>
    array(array("DescripcionBeneficiarioExterno" => "Sector Manufacturero",
    "CantidadBeneficiariosDirectos" => "1",
    "CantidadBeneficiariosIndirectos" => "442"),
    array("DescripcionBeneficiarioExterno" => "Sindicatos",
    "CantidadBeneficiariosDirectos" => "2",
    "CantidadBeneficiariosIndirectos" => "1000")),
"ListaImpactosInternos" =>
    array(array("DescripcionImpacto" => "Impacto interno 1"),
    array("DescripcionImpacto" => "Impacto interno 2")),
"ListaImpactosExternos" =>
    array(array("DescripcionImpacto" => "Impacto1"),
    array("DescripcionImpacto" => "Impacto2")),
"ListadoSocios" =>
    array(array("DescripcionSocio"=> "Escuela de Ingenieria"))
);
/*
$actividad1json = json_encode($actividad1);
echo $actividad1json."<br> <br>";

$json_decoded = json_decode($actividad1json);

foreach ($json_decoded->ListadoBeneficiariosExternos as $beneficiariosExternos ){
    echo $beneficiariosExternos->DescripcionBeneficiarioExterno."<br>";
}
*/

$datosBase=array($actividad1,$actividad2,$actividad3);
$datosJson = json_encode($datosBase);

$datosJsonConvertidos = json_decode($datosJson);
/*
foreach($datosJsonConvertidos as $actividad){
    echo $actividad->NombreActividad."<br><br>";
}
*/

function listarActividadesXRut($rut,$periodo){
    global $datosJsonConvertidos;
    
    $respuesta=array();
    foreach($datosJsonConvertidos as $actividad){
        if($actividad->RutUsuario==$rut && $actividad->Periodo==$periodo){
            $respuesta[] = $actividad;
        }
    }
    return json_encode($respuesta);
}

function listarTodasActividades($periodo){
    global $datosJsonConvertidos;
    
    $respuesta=array();
    foreach($datosJsonConvertidos as $actividad){
        if($actividad->Periodo==$periodo){
            $respuesta[] = $actividad;
        }
    }
    return json_encode($respuesta);
}
function verificarActividad($rut,$periodo){
    global $datosJsonConvertidos;
    
    $respuesta=array();
    foreach($datosJsonConvertidos as $actividad){
        if($actividad->RutUsuario==$rut && $actividad->Periodo==$periodo){
            return true;
        }
    }
    return false;
}

echo listarActividadesXRut("20006268k","2020");
echo "<br><br><br>";
echo listarTodasActividades("2020");
echo "<br><br><br>";
if(verificarActividad("1111","2020")){
    echo "Si tiene actividad";
}else{
    echo "No tiene actividad";
}
