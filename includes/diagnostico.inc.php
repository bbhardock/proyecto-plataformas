<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


function saltarLinea(){
    echo "<br><br><br><br>";
}

function apiListarTodasActividades($periodo){
    require_once 'apiSIVCM.inc.php';
    
    
    $resultadoLlamadaApi = listarTodasActividades($periodo);
    echo "<b>Resultado api</b>";
    print_r($resultadoLlamadaApi);
    saltarLinea();
    
    return $resultadoLlamadaApi;
}

function obtenerDatosBeneficiariosResumen($periodo){
    $actividadesJson = apiListarTodasActividades($periodo);

    echo "<b> Datos dentro de query, 1) String json </b>";
    print_r($actividadesJson);
    saltarLinea();

    $actividades = json_decode($actividadesJson);
    echo "<b> 2) Json de actividades decodificado </b>";
    print_r($actividades);
    saltarLinea();

    $datosBeneficiarios = array();
    foreach($actividades as $actividad){
        if(isset($actividad->AreaVinculacion) && $actividad->AreaVinculacion != ""){
            print_r($actividad);
            saltarLinea();
            $indice = ucwords(strtolower($actividad->AreaVinculacion)); //para que no haya conflictos del tipo AReA != Area. El formato queda , por ejemplo como "Area De Vinculacion"
            print_r($indice);
            saltarLinea(); 
            if(!array_key_exists($indice,$datosBeneficiarios) && (isset($actividad->ListadoBeneficiariosInternos) || isset($actividad->ListadoBeneficiariosExternos))){
                $datosBeneficiarios[$indice] = array("BeneficiariosInternos" => 0, "BeneficiariosExternos" => 0);
            }
            if(isset($actividad->ListadoBeneficiariosInternos)){
                foreach($actividad->ListadoBeneficiariosInternos as $benInternos){
                    if(isset($benInternos->CantidadBeneficiariosDirectos)){
                        $datosBeneficiarios[$indice]["BeneficiariosInternos"] += $benInternos->CantidadBeneficiariosDirectos;
                    }
                }
            }
            if(isset($actividad->ListadoBeneficiariosExternos)){
                foreach($actividad->ListadoBeneficiariosExternos as $benExternos){
                    if(isset($benExternos->CantidadBeneficiariosDirectos)  && isset($benExternos->CantidadBeneficiariosIndirectos)){
                        $datosBeneficiarios[$indice]["BeneficiariosExternos"] += $benExternos->CantidadBeneficiariosDirectos + $benExternos->CantidadBeneficiariosIndirectos;
                    }
                }
            }
        }
    }

    $stringRetornoQuery = json_encode($datosBeneficiarios);
    echo "<b> 3)string retorno de query </b>";
    print_r($stringRetornoQuery);
    saltarLinea();

    return $stringRetornoQuery;
}

function limpiarStringJSON ($stringJson){
    //elimina caracteres no válidos
    for ($i = 0; $i <= 31; ++$i) { 
        $stringJson = str_replace(chr($i), "", $stringJson); 
    }
    $stringJson = str_replace(chr(127), "", $stringJson);

    //Algunos archivos comienzan con 'efbbbf' para marcar el inicio del archivo (nivel binario)
    //basicamente son los primeros tres caracteres, si están ahí, los elimina
    if (0 === strpos(bin2hex($stringJson), 'efbbbf')) {
        $stringJson = substr($stringJson, 3);
    }

    
    $datos = json_decode($stringJson);

    return $datos;
}



$periodo = "2020";
$resumenBeneficiarios = limpiarStringJson(obtenerDatosBeneficiariosResumen($periodo));
echo "<b> Resumen beneficiarios como aparece en index </b>";
print_r($resumenBeneficiarios);
saltarLinea();


$errorBeneficiarios = json_last_error_msg();
echo "<b> Error en beneficiarios al decodificar JSON </b>";
print_r($errorBeneficiarios);
saltarLinea();

/*
function quitar_tildes($cadena) {
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $cadena = strtr( $cadena, $unwanted_array );
}

echo "<b> BONUS, ahora filtrado por tildes </b>";
$resumenBeneficiariosSinTilde = limpiarStringJson(quitar_tildes(obtenerDatosBeneficiariosResumen($periodo)));
print_r($resumenBeneficiariosSinTilde);
saltarLinea();
*/

