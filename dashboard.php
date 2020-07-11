<?php
    session_start();
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
        <link rel="stylesheet" href="static/css/fontello.css?v1.6">
        <link rel="stylesheet" href="static/css/Styles.css?v2.6">
    </head>
    <body>
        <section class="main">
            <div class="container-Title">
                <div class="container row col-md-12">
                    <?php
                    if($_SESSION['user_admin_status']=='S'){
                        echo "<h2>Todas las actividades</h2>";
                    }else{
                        echo "<h2>Mis Actividades</h2>";
                    }
                    ?>
                </div>
            </div>
            <div class="container row col-md-12">
                <div class="col-md-12">        
                    <form action="" class="form-inline">
                        <label for="area">Area de interes:</label>
                        <select class="form-control" id="area">
                            <option>-Vacio-</option>
                            <option>Vinculación Académica de pre y postgrado</option>
                            <option>Vinculación Artística, Cultural, Patrimonial y Calidad de Vida</option>
                            <option>Vinculación Medio Productivo y de Servicio</option>
                            <option>Vinculación Vocacion Socual y Comunitaria</option>
                            <option>Vinculación Medio Público y Ciudadanía</option>
                            <option>Vinculación con Sector Escolar</option>
                            <option>Vinculación para la Internacionalización</option>
                            <option>Vinculación con Egresados</option>
                        </select>
                        <label class="my-1 mr-2" for="type-activity">Tipo de actividad</label>
                        <select class="custom-select my-1 mr-sm-2" id="type-activity">
                            <option>-Vacio-</option>
                            <option>Congreso</option>
                            <option>Jornada</option>
                            <option>Feria</option>
                            <option>Charla</option>
                            <option>Taller</option>
                            <option>Curso</option>
                            <option>Explo UCN</option>
                            <option>Diplomado</option>
                            <option>Otro</option>
                        </select>
                        <label class="my-1 mr-2" for="state-activity">Estado:</label>
                        <select class="custom-select my-1 mr-sm-2" id="state-activity">
                            <option>-Vacio-</option>
                            <option>En Proceso</option>
                            <option>No evaluada</option>
                            <option>Evaluada</option>
                        </select>
                        <button class="btn btn-primary btn-sm icon-filter">Aplicar Filtro</button>
                        <div class="table-responsive ">
                            <table class="table-bordered tableA">
                                <thead>
                                    <tr>      
                                        <th rowspan="2">Codigo</th>
                                        <th rowspan="2">Responsable</th>
                                        <th rowspan="2">Nombre Actividad</th>
                                        <th rowspan="2">Fecha Ejecución</th>
                                        <th colspan="3">Estado</th>
                                        <th rowspan="2">Ver actividad</th>
                                        <?php
                                        if($_SESSION['user_admin_status']=='N'){
                                            echo '<th rowspan="2">Solicitar ayuda</th>';
                                            echo '<th rowspan="2">Cerrar Actividad</th>';
                                        }
                                        ?>
                                    </tr>
                                    <tr>     
                                        <th>En proceso</th>
                                        <th>Ejecutada y no evaluada</th>
                                        <th>Evaluada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>Nombre</td>
                                        <td>Nombre Actividad</td>
                                        <td>Fecha</td>
                                        <td><div class="icon-ok square-ok"></div></td>
                                        <td><div class="icon-ok square-ok"></div></td>
                                        <td><div class="icon-cancel square-cancel"></div></td>
                                        <td><a href="help.php?id=id_act&modo=ver" class="icon-search">Ver</a></td>
                                        <?php
                                        if($_SESSION['user_admin_status']=='N'){
                                            echo '<td><a href="help.php?id=id_act&modo=ingresar" class="icon-form">Ayuda</a></td>';
                                            echo '<td><a href="closeActivity.php?id=id_act" class="icon-form">Cerrar</a></td>';
                                        }
                                        ?>
                                    </tr>                    
                                </tbody>
                            </table>
                        </div>
                        <?php
                            if($_SESSION['user_admin_status']=='S'){
                                echo '<button class="btn btn-success btn-lg icon-file-excel">Reporte</button>';
                            }
                        ?>
                    </form>  
                </div>  
            </div>    
        </section>
        <?php
            require 'footer.php';
        ?>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>