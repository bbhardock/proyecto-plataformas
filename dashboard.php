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
    require 'includes/queries.inc.php';
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Manejo de Actividades</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css?v1.6">
        <link rel="stylesheet" href="static/css/Styles.css?v3.17">
        
        <!-- Fuente -->
        <link rel="stylesheet" href="https://use.typekit.net/jyw0mhj.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400&display=swap">

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
                        echo '<div class="containerSubmenu col-md-12 col-lg-2">
                                <nav class="submenu">
                                    <ul>
                                        <li><input type="radio" name="radioActivity" onClick="table(1)" id="allActivity" checked><label for="allActivity">Mis Actividades</label></li>
                                        <li><input type="radio" name="radioActivity" onClick="table(2)" id="activity"><label for="activity">Todas las Actividades</label></li>
                                    </ul>
                                </nav>
                            </div>
                            <script>
                                function table(x){
                                    if(x==1){
                                        document.getElementById("form1").style.display="flex";
                                        document.getElementById("form2").style.display="none";
                                    }else{
                                        document.getElementById("form2").style.display="flex";
                                        document.getElementById("form1").style.display="none";
                                    }
                                }
                            </script>
                            <div class="col-md-12 col-lg-10">';
                    }
                    else if($_SESSION['user_admin_status']=='S'){
                        echo '<div class="col-md-12 col-lg-12">';
                    }
                ?>      
                    <form action="" class="form-inline" name="filtros" method="POST">
                        <label class="my-1 mr-2" for="periodo">Periodo</label>
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
                        <?php echo '<label class="my-1 mr-2 periodo">Periodo seleccionado actualmente: '.$periodo.'</label>' ?>
                        <div id="form1" class="table-responsive">
                            <table class="table-bordered tableDash tableA">
                                <thead>
                                    <tr>      
                                        <th rowspan="2">Codigo</th>
                                        <th rowspan="2">Responsable</th>
                                        <th rowspan="2">Nombre Actividad</th>
                                        <th rowspan="2">Fecha de Inicio y Término</th>
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
                                <!--
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
                                -->
                                <?php //MUESTRA DE DATOS EN TABLA PRINCIPAL (VISTA ADMINISTRADOR Y "MIS ACTIVIDADES" DE USUARIO)
                                $actividadesTablaPrincipal;
                                if($_SESSION['user_admin_status'] == 'N'){
                                    $actividadesTablaPrincipal = json_decode(apiListarActividadesXRut($_SESSION['user_rut'],$periodo));
                                }else if ($_SESSION['user_admin_status'] == 'S'){
                                    $actividadesTablaPrincipal = json_decode(apiListarTodasActividades($periodo));
                                }
                                foreach($actividadesTablaPrincipal as $actividad){
                                    echo '<tr>
                                        <td>'.$actividad->CodigoActividad.'</td>
                                        <td>'.$actividad->NombreUsuario.'</td>
                                        <td>'.$actividad->NombreActividad.'</td>
                                        <td>'.$actividad->FechaInicio.' al '.$actividad->FechaTermino.'</td>
                                        <td><div class="icon-ok square-ok"></div></td>
                                        <td><div class="icon-ok square-ok"></div></td>
                                        <td><div class="icon-cancel square-cancel"></div></td>
                                        <td><a href="help.php?id='.$actividad->CodigoActividad.'&modo=ver&periodo='.$periodo.'" class="icon-search">Ver</a></td>';
                                    if($_SESSION['user_admin_status'] == 'N'){
                                    echo '<td><a href="help.php?id='.$actividad->CodigoActividad.'&modo=ingresar&periodo='.$periodo.'" class="icon-form">Ayuda</a></td>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>                      
                        <?php
                            if($_SESSION['user_admin_status']=='N'){
                                echo '  <div id="form2" class="table-responsive ">
                                            <table class="tableDash table-bordered tableA">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre Encargado</th>
                                                        <th>Nombre Actividad</th>
                                                        <th>Area de Vinculación</th>
                                                        <th>Fecha de Inicio</th>
                                                        <th>Fecha de Termino</th>
                                                        <th>Lugar de realización</th>
                                                        <th>Socios Estrategicos</th>    
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                $actividadesTablaSecundaria = json_decode(apiListarTodasActividades($periodo));
                                foreach ($actividadesTablaSecundaria as $actividad){
                                    echo '<tr>
                                        <td>'.$actividad->NombreUsuario.'</td>
                                        <td>'.$actividad->NombreActividad.'</td>
                                        <td>'.$actividad->AreaVinculacion.'</td>
                                        <td>'.$actividad->FechaInicio.'</td>
                                        <td>'.$actividad->FechaTermino.'</td>';
                                        foreach($actividad->LugarRealizacion as $lugar){
                                            echo '<td>'.$lugar->LugarRealizacion.'</td>';    
                                        }
                                        foreach($actividad->ListadoSocios as $socio){
                                            echo '<td>'.$socio->DescripcionSocio.'</td>';
                                        }
                                }
                                echo    '</tbody>
                                    </table>
                                </div>';
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