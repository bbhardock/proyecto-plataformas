<?php
if(isset($_POST['registrar-ayuda-submit'])){
    echo "Ingreso de ayuda";    
}else{
    header("Location ../dashboard.php");
    exit();
}