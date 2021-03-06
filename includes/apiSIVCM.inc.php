<?php

    function obtenerDatos($query){
        /*
        $URL = 'http://webservice.net.desa.ucn.cl/Web_Api_Sivcm_Famed/';
        $USER = 'usuariowebApiSivcmFamed';
        $PWD = 'testFamed';
        */

        $URL = 'http://dgvcm.ucn.cl/Web_Api_Sivcm_Famed/';
        $USER = 'usuariowebApiSivcmFamed';
        $PWD = 'Rs0n173m926s670vxs32';

        $VALUE_AUTH = base64_encode($USER.':'.$PWD);
        
        $url_query = $URL.$query;
        
        $options = array(
            'http' => array(
                'header'  => "Authorization: BASIC ".$VALUE_AUTH."\r\n",
                'method'  => 'GET'
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url_query, false, $context);
        if ($result === FALSE) {
            return 'sin_resultado para'.$url_query;
        }
        return $result;
    }

    function listarActividadesXRut($rut,$periodo){
        $query = 'api/famed/ListarActividadesxRut/'.$rut.'/'.$periodo;
        return obtenerDatos($query);
    }

    function listarTodasActividades($periodo){
        $query = 'api/famed/ListarActividades/'.$periodo;
        return obtenerDatos($query);
    }
    function verificarActividad($rut,$periodo){
        $query = 'api/famed/VerificarSiTieneActividades/'.$rut.'/'.$periodo;
        return obtenerDatos($query);
    }