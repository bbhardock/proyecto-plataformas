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
        <link rel="stylesheet" href="static/css/Styles.css?v1.9">
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
                                    </tr>                           
                                </tbody>
                            </table>
                        </div>
                        <div class="form-row">
                            <div class="btn-izq col-md-12">
                                <input type="submit" class = "btn btn-primary btn-md btn-izq" value="Generar reporte">
                                <input type="submit" class = "btn btn-warning btn-md btn-izq" value="Editar">
                                <input type="submit" class = "btn btn-success btn-md btn-der" value="Agregar actividad">
                                <input type="submit" class = "btn btn-success btn-md btn-der" value="Cerrar actividad">
                                <input type="submit" class = "btn btn-danger btn-md btn-der" value="Eliminar">
                            </div>
                        </div>
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