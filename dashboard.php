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
        <link rel="stylesheet" href="static/css/Styles.css?v1.10">
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
                        <label for="name" class="my-1 mr-2">Nombre academico:</label>
                        <input type="text" class="form-control my-1 mr-sm-2" id="name" placeholder="Nombre Academico">
                        <label class="my-1 mr-2" for="state-activity">Estado:</label>
                        <select class="custom-select my-1 mr-sm-2" id="state-activity">
                            <option>-Vacio-</option>
                            <option>Aceptado</option>
                            <option>Pendiente</option>
                            <option>Cerrado</option>
                        </select>
                        <div class="table-responsive ">
                            <table class="table table-bordered tableA">
                                <thead>
                                    <th>Codigo</th>
                                    <th>Responsable</th>
                                    <th>Nombre Actvidad</th>
                                    <th>Fecha Ejecución</th>
                                    <th>En proceso</th>
                                    <th>No evaluada</th>
                                    <th>Evaluada</th>
                                    <th>Ver actividad</th>
                                    <th>Pedir ayuda</th>
                                    <th>Cerrar Actividad</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>RUT</td>
                                        <td>Nombre</td>
                                        <td>Correo</td>
                                        <td>Estado</td>
                                        <td>Indicador de Impacto</td>
                                        <td><label for="" class="icon-search"></label></td>
                                        <td><a href="" class="icon-search">Ver</a></td>
                                        <td><a href="">Ayuda</a></td>
                                        <td><a href="">Cerrar</a></td>
                                    </tr>
                                    <tr>
                                        <td>ID</td>
                                        <td>RUT</td>
                                        <td>Nombre</td>
                                        <td>Correo</td>
                                        <td>Estado</td>
                                        <td>Indicador de Impacto</td>
                                        <td>Tipo</td>
                                        <td><a href="">Ver</a></td>
                                        <td><a href="">Reporte</a></td>
                                    </tr>                           
                                </tbody>
                            </table>
                        </div>
                        <input type="input" class="btn btn-success btn-lg" value="Reporte">
                    </form>  
                </div>  
            </div>    
        </section>
        <script>
            function selection(tr,value){
                $(function(){
                    if($("#chk"+value).attr("checked") == "checked"){                      
                        $("#chk"+value).removeAttr("checked");
                        $("#chk"+value).prop("checked",false);
                        $(tr).css("background-color","#FFFFFF");
                    }
                    else{
                        $("#chk"+value).attr("checked",true);
                        $("#chk"+value).prop("checked",true);
                        $(tr).css("background-color","#BEDAE8");
                    }
                })
            }
        </script>   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>