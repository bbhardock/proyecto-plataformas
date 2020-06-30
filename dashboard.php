<?php
    require "session_check.php";
    require "header.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang = "es"><head>
        <meta charset="utf-8" />
        <title>Manejo de Usuarios</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css">
        <link rel="stylesheet" href="static/css/Styles.css?v1.4">
    </head>
    <body>
        <?php
            if(isset($_GET['login']) && $_GET['login'] == 'success'){
                echo "<p>"."Hola ".$_SESSION['user_name']."! Rut: ".$_SESSION['user_rut']."</p>";
            }
        ?>
        <section class="main">
            <div class="containerTitle">
                <div class="container row col-md-12">
                    <h2>Todas las actividades</h2>
                </div>
            </div>
            <div class="container row col-md-12">
                <div class="table-responsive ">
                    <table class="table tableA">
                        <thead>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Indicador de Impacto</th>
                            <th>Tipo</th>
                            <th>Requiere reunion</th>
                            <th>Fecha reunion</th>
                            <th>Lugar</th>
                            <th>Organización que organiza</th>
                            <th>Organización que auspicia</th>
                            <th>Organización que patrocina</th>
                            <th>Cierre numero definitivo partes</th>
                            <th>Cierre porcentaje de cumplimiento impacto</th>
                            <th>Cierre de evidencias</th>
                            <th>Cierre con link de noticia</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>RUT</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Estado</td>
                                <td>Indicador de Impacto</td>
                                <td>Tipo</td>
                                <td>Requiere reunion</td>
                                <td>Fecha reunion</td>
                                <td>Lugar</td>
                                <td>Organización que organiza</td>
                                <td>Organización que auspicia</td>
                                <td>Organización que patrocina</td>
                                <td>Cierre numero definitivo partes</td>
                                <td>Cierre porcentaje de cumplimiento impacto</td>
                                <td>Cierre de evidencias</td>
                                <td>Cierre con link de noticia</td>
                            </tr>
                            <tr>
                                <td>ID</td>
                                <td>RUT</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Estado</td>
                                <td>Indicador de Impacto</td>
                                <td>Tipo</td>
                                <td>Requiere reunion</td>
                                <td>Fecha reunion</td>
                                <td>Lugar</td>
                                <td>Organización que organiza</td>
                                <td>Organización que auspicia</td>
                                <td>Organización que patrocina</td>
                                <td>Cierre numero definitivo partes</td>
                                <td>Cierre porcentaje de cumplimiento impacto</td>
                                <td>Cierre de evidencias</td>
                                <td>Cierre con link de noticia</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>    
        </section>   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>