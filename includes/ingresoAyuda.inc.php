<?php
if(isset($_POST['registrar-ayuda-submit'])){
    require "mailsender.inc.php";
    require "queries.inc.php";

    $code_activity = $_POST['code-activity'];
    $nombre = $_POST['solicitante'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $requiere_reunion = $_POST["btn-radio"]; //requiere reunion?- 1 para si, 2 para no
    $hour_reunion = $_POST["hour-reunion"]; //FORMATO HH:MM
    $date_reunion = $_POST["date-reunion"]; //FORMATO YYYY-MM-DD
    $number_participants = $_POST["number-participants"];
    $requiere_apoyo_com = $_POST["btn-radio1"]; //requiere apoyo de comunicaciones?
    $apoyo_tecnico = $_POST["need-support"];//apoyo tecnico
    $suplie_bandejas = $_POST["suplie-bandejas"];
    $suplie_tapetes = $_POST["suplie-tapetes"];
    $suplie_sillas = $_POST["suplie-sillas"];
    $suplie_paneles = $_POST["suplie-paneles"];
    $suplie_toldos = $_POST["suplie-toldos"];
    $suplie_otros = $_POST["suplie-otros"];

    //setear informacion de logistica
    $pendon_famed = "N";
    $pendon_enfermeria = "N";
    $pendon_kine = "N";
    $pendon_medi = "N";
    $pendon_nutri = "N";
    $constancia_impresa = "N";
    $constancia_digital = "N";
    if(isset($_POST['logistic'])){
        $logistic_support_values = $_POST['logistic'];//informacion de pendones y constancias
        foreach($logistic_support_values as $value){
            switch($value){
                case "FAMED":
                    $pendon_famed="S";
                    break;
                case "Enfermeria":
                    $pendon_enfermeria="S";
                    break;
                case "Kinesiologia":
                    $pendon_kine = "S";
                    break;
                case "Medicina":
                    $pendon_kine = "S";
                    break;
                case "Nutricion":
                    $pendon_kine = "S";
                    break;
                case "Impresa":
                    $constancia_impresa = "S";
                    break;
                case "Digital":
                    $constancia_digital = "S";
                    break;
            }
        }
    }

    //setear informacion de reunion
    if($requiere_reunion == 2){
        $hour_reunion = "NULL";
        $date_reunion = "NULL";
        $requiere_reunion = "N";
    }else if ($requiere_reunion == 1){
        $requiere_reunion = "S";
    }

    if($requiere_apoyo_com == 4){
        $requiere_apoyo_com = "N";
    }else if ($requiere_apoyo_com == 3){
        $requiere_apoyo_com = "S";
    }

    insertarActividad($code_activity,$nombre,$correo,$telefono,$requiere_reunion,$hour_reunion,$date_reunion,$number_participants,
    $requiere_apoyo_com,$apoyo_tecnico,$suplie_bandejas,$suplie_tapetes,$suplie_sillas,$suplie_paneles,$suplie_toldos,$suplie_otros,
    $pendon_famed,$pendon_enfermeria,$pendon_kine,$pendon_medi,$pendon_nutri,$constancia_impresa,$constancia_digital);

    //enviarMail($code_activity);
    header("Location: ../dashboard.php?status=solicitudIngresada");
    exit();
}else{
    header("Location ../dashboard.php");
    exit();
}