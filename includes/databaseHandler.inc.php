<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "vinc_medio_facmed";

$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

if(!$conn){
    die("Conexión falló: ".mysqli_connect_error());
}
