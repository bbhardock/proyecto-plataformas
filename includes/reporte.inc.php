<?php
if(isset($_POST['reporte-submit'])){
    echo "Aqui esta";
}else{
    header("Location ../dashboard.php");
    exit();
}