<?php
    $CHECKS = '';
    if(isset($_POST['checkP'])){
        foreach($_POST['checkP'] as $valor){
            $CHECKS = $CHECKS .' el id es '.$valor;
            echo $CHECKS;
        }
    }
?>