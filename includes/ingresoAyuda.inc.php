<?php
if(isset($_POST['registrar-ayuda-submit'])){
    $objetivo = $_POST['objective-activity'];
    $impact = $_POST['impact'];
    $logistic_support_values = $_POST['logistic-support']; //ARREGLO-USAR FOREACH AS para iterar
    $requiere_reunion = $_POST["btn-radio"]; //requiere reunion?- 1 para si, 2 para no
    $hour_reunion = $_POST["hour-reunion"]; //FORMATO HH:MM
    $date_reunion = $_POST["date-reunion"]; //FORMATO YYYY-MM-DD
    $number_participants = $_POST["number-participants"];
    $type_activity = $_POST["type-activity"];//DROPBOX
    $other_activity = $_POST["other-activity"];
    $suplie_bandejas = $_POST["suplie-bandejas"];
    $suplie_tapetes = $_POST["suplie-tapetes"];
    $suplie_sillas = $_POST["suplie-sillas"];
    $suplie_paneles = $_POST["suplie-paneles"];
    $suplie_toldos = $_POST["suplie-toldos"];
    $suplie_otros = $_POST["suplie-otros"];

    //echo $hour_reunion;
    //echo $date_reunion;
    header("Location: ../dashboard.php?");
    exit();
}else{
    header("Location ../dashboard.php");
    exit();
}