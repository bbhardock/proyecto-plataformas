<?php
    require "session_check.php";
    require "header.php";
    require 'includes/queries.inc.php';
    if(!isset($_SESSION['user_id']) || $_SESSION['user_admin_status'] != 'S'){
        header("Location: dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, user-scalable = no">
    <title>Cerrar una actividad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/styleActivitie.css?v1.12">
</head>
<body>
    <section class="main">
        <div class="container container-Form shadow p-3 mb-5 bg-white rounded row">
            <div class="col-md-12">
                <form action="" enctype="multipart/form-data">
                    <div class="container row">
                        <div class="col-md-12 container-Title">
                            <h2>Cerrar una actividad</h2>
                        </div>
                    </div>
                    <fieldset disabled>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="coordinador">Coordinador de la actividad:</label>
                                <input type="text" class="form-control" id="coordinador" placeholder="Aca iria el nombre sacado de la BD">
                            </div>
                            <div class="col-md-6">
                                <label for="organize-activity">Organización o Unidad que organiza:</label>
                                <input type="text" class="form-control" id="organize-activity" placeholder="Dato sacado de la BD">     
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <label for="place-activity">Lugar de la actividad:</label>
                                <input type="text" class="form-control" id="place-activity" placeholder="Lugar de la actividad">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="start-date">Fecha de inicio:</label>
                                <input type="date" class="form-control" id="start-date" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="end-date">Fecha de termino:</label>
                                <input type="date" class="form-control" id="end-date" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="number-participants">Número definitivo de participantes:</label>
                        <input type="number" class="form-control" id="number-participants" placeholder="Cantidad de participantes">
                    </div>
                    <div class="form-group">
                        <label for="percentage-impact">Porcentaje de cumplimiento del inidicador de impacto:</label>
                        <input type="text" class="form-control" id="percentage-impact" placeholder="Porcentaje de cumplimiento">
                    </div>
                    <div class="form-group">
                        <label for="notice-activity">Link de la noticia sobre la actividad</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="link-activity">https://www.example.com/users/</span>
                            </div>
                            <input type="text" class="form-control" id="notice-activity" aria-describedby="link-activity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files-activity">Adjuntar las fotos de la actividad</label>
                        <input type="file" class="form-control-file" name="files-activity[]" id="file-activity" multiple="">
                    </div>
                    <div class="container">
                        <input type="button" class = "btn btn-danger btn-md btn-izq" value="Cancelar">
                        <input type="button" class = "btn btn-primary btn-md btn-der" value="Cerrar actividad">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>