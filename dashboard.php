<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }
    $periodo="";
    if(isset($_POST['filtro-submit'])){
        $periodo=$_POST['periodo'];
    }else{
        $periodo="2020";
    }
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Manejo de Actividades</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css?v1.6">
        <link rel="stylesheet" href="static/css/Styles.css?v3.13">
        <link rel="stylesheet" href="https://use.typekit.net/jyw0mhj.css">
    </head>
    <body>
        <?php
            require "header.php";
        ?>  
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
                <?php
                    if($_SESSION['user_admin_status']=='N'){
                        echo '<div class="containerSubmenu col-md-12 col-lg-2">';
                        echo '    <nav class="submenu">';
                        echo '        <ul>';
                        echo '            <li><input type="radio" name="radioActivity" onClick="table(1)" id="allActivity" checked><label for="allActivity">Mis Actividades</label></li>';
                        echo '            <li><input type="radio" name="radioActivity" onClick="table(2)" id="activity"><label for="activity">Todas las Actividades</label></li>';
                        echo '        </ul>';
                        echo '    </nav>';
                        echo '</div>';
                        echo '<script>';
                        echo '    function table(x){';
                        echo '        if(x==1){';
                        echo '            document.getElementById("form1").style.display="flex";';
                        echo '            document.getElementById("form2").style.display="none";';
                        echo '        }else{';
                        echo '            document.getElementById("form2").style.display="flex";';
                        echo '            document.getElementById("form1").style.display="none";';
                        echo '        }';
                        echo '    }';
                        echo '</script>';
                        echo '<div class="col-md-12 col-lg-10">';
                    }
                ?>
                <?php
                    if($_SESSION['user_admin_status']=='S'){
                        echo '<div class="col-md-12 col-lg-12">';
                    }
                    //falta hacer el action y que te tire el post, luego arriba obtenemos el post y filtramos
                ?>      
                    <form action="" class="form-inline" name="filtros" method="POST">
                        <label class="my-1 mr-2" for="area">Periodo</label>
                        <select class="custom-select my-1 mr-sm-2" id="periodo" name="periodo">
                            <option value="" selected disabled hidden> Seleccione periodo </option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                        <!--
                        <select class="custom-select my-1 mr-sm-2" id="area">
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
                        <label class="my-1 mr-2" for="type-activity">Tipo de actividad:</label>
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
                        -->
                        <button type="submit" name="filtro-submit" class="btn btn-primary btn-sm icon-filter">Aplicar Filtro</button>
                        <?php echo '<p> Periodo seleccionado actualmente: '.$periodo.'</p>' ?>
                        <div id="form1">
                            <div class="table-responsive ">
                                <table class="table-bordered tableDash tableA">
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
                                            }
                                            ?>
                                        </tr>                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                            if($_SESSION['user_admin_status']=='N'){
                                echo '<div id="form2">';
                                echo '    <div class="table-responsive ">';
                                echo '        <table class="tableDash table-bordered tableA">';
                                echo '            <thead>';
                                echo '                <tr>';
                                echo '                    <th>Nombre Encargado</th>';
                                echo '                    <th>Nombre Actividad</th>';
                                echo '                    <th>Area de Vinculación</th>';
                                echo '                    <th>Fecha de Inicio</th>';
                                echo '                    <th>Fecha de Termino</th>';
                                echo '                    <th>Lugar de realización</th>';
                                echo '                    <th>Socios Estrategicos</th>    ';
                                echo '                </tr>';
                                echo '            </thead>';
                                echo '            <tbody>';
                                echo '                <tr>';
                                echo '                    <td>Nombre Encargado</td>';
                                echo '                    <td>Nombre Actividad</td>';
                                echo '                    <td>Area de Vinculación</td>';
                                echo '                    <td>Fecha de Inicio</td>';
                                echo '                    <td>Fecha de Termino</td>';
                                echo '                    <td>Lugar de realización</td>';
                                echo '                    <td>Socios Estrategicos</td>';
                                echo '                </tr>                    ';
                                echo '            </tbody>';
                                echo '        </table>';
                                echo '    </div>';
                                echo '</div>  ';
                            }
                        ?>
                    </form>
                    <?php
                            if($_SESSION['user_admin_status']=='S'){
                                //<button type="submit" name="reporte-submit" class="btn btn-success btn-lg icon-file-excel">Reporte</button>
                                //<input type="submit" value="Generar reporte Excel" name="reporte-submit">
                                echo '<form action="includes/reporte.inc.php" method="POST" id="Ingresar">
                                <input id="periodo" name="periodo" type="hidden" value="'.$periodo.'">
                                <button type="submit" name="reporte-submit" class="btn btn-success btn-lg icon-file-excel">Reporte</button>
                                </form>';
                            }
                    ?>   
                    
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