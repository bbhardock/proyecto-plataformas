<?php
if(isset($_POST['registrar-ayuda-submit'])){
    require "mailsender.inc.php";
    $code_activity = $_POST['code-activity'];
    $nombre = $_POST['solicitante'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $logistic_support_values = $_POST['logistic-support']; //ARREGLO-USAR FOREACH AS para iterar
    $requiere_reunion = $_POST["btn-radio"]; //requiere reunion?- 1 para si, 2 para no
    $hour_reunion = $_POST["hour-reunion"]; //FORMATO HH:MM
    $date_reunion = $_POST["date-reunion"]; //FORMATO YYYY-MM-DD
    $number_participants = $_POST["number-participants"];
    $requiere_apoyo_com = $_POST["btn-radio1"]; //requiere apoyo de comunicaciones?
    $need_support = $_POST["need-support"];//apoyo tecnico
    $suplie_bandejas = $_POST["suplie-bandejas"];
    $suplie_tapetes = $_POST["suplie-tapetes"];
    $suplie_sillas = $_POST["suplie-sillas"];
    $suplie_paneles = $_POST["suplie-paneles"];
    $suplie_toldos = $_POST["suplie-toldos"];
    $suplie_otros = $_POST["suplie-otros"];


    //enviarMail($code_activity);
    header("Location: ../dashboard.php?");
    exit();
}else{
    header("Location ../dashboard.php");
    exit();
}