<?php
    $URL = 'http://webservice.net.desa.ucn.cl/Web_Api_Sivcm_Famed/';
    $USER = 'usuariowebApiSivcmFamed';
    $PWD = 'testFamed';

    $VALUE_AUTH = base64_encode($USER.':'.$PWD);


    function obtenerDatos($query){
        global $URL, $VALUE_AUTH;
        $url_query = $URL.$query;
        
        $options = array(
            'http' => array(
                'header'  => "Authorization: BASIC".$VALUE_AUTH."\r\n",
                'method'  => 'GET'
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url_query, false, $context);
        if ($result === FALSE) {
            return 'sin_resultado para'.$query;
        }
        $data = json_decode($result); //como llega en json hay que convertirlo
        return $data;
    }

    function listarActividadesXRut($rut,$periodo){
        $query = 'api/famed/ListarActividadesxRut/'.$rut.'/'.$periodo;
        obtenerDatos($query);
    }

    function listarTodasActividades($periodo){
        $query = 'api/famed/ListarActividades/'.$periodo;
        obtenerDatos($query);
    }
    function verificarActividad($rut,$periodo){
        $query = 'api/famed/VerificarSiTieneActividades/'.$rut.'/'.$periodo;
        obtenerDatos($query);
    }
