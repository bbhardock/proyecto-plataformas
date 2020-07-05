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
      <title>Crear una Actividad</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="static/css/styleActivitie.css?v1.12">
  </head>
  <body>
    <section class="main">
      <div class="container container-Form row">
        <div class="col-md-12">
          <form action="">
            <div class="container row">
              <div class="col-md-12 container-Title">
                <h2>Crear una actividad</h2>
              </div>
            </div>
            <div class="form-group">
              <label for="name-activity">Nombre de Actividad:</label>
              <input type="text" class="form-control" id="name-activity" placeholder="Escriba el nombre de la actividad">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="objective-activity">Objetivo de la Actividad:</label>
                <input type="text" class="form-control" id="objective-activity" placeholder="Escriba el objetivo de la actividad">
              </div>
              <div class="form-group col-md-6">
                <label for="impact">Indicador de Impacto:</label>
                <input type="text" class="form-control" id="impact" placeholder="Indicador de impacto">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="coordinador">Coordinador de la actividad:</label>
                <input type="text" class="form-control" id="coordinador" placeholder="Escriba el nombre del coordinador de la actividad">
              </div>
              <div class="form-group col-md-6">
                <label for="phone-coordinador">Telefono del coordinador</label>
                <input type="text" class="form-control" id="phone-coordinador" placeholder="Ejemplo: +56985671485">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="logistic-support">Apoyo en la logística:</label>
                <select multiple="true" class="form-control"  id="logistic-support" aria-describedby="selectHelp">
                  <option>-Ninguno-</option>
                  <option>Pendón FAMED</option>
                  <option>Pendón C. Enfermería</option>
                  <option>Pendón C. Kinesiología</option>
                  <option>Pendón C. Medicina</option>
                  <option>Pendón C. Nutrición</option>
                  <option>Constancia Impresa</option>
                  <option>Constancia Digital</option>    
                </select>
                <small id="selectHelp" class="form-text text-muted">Para seleccionar mas de un valor presione ctrl+click.</small>
              </div>
              <fieldset class="form-group col-md-6">
                <legend class="col-form-label col-md-12">Requiere reunión de coordinación:</legend>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="btn-radio" id="meeting-yes" value="1">
                      <label class="form-check-label" for="meeting-yes">
                        Si
                      </label>      
                      <div class="need-reunion">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="hour-reunion">Hora de la reunion</label>
                            <input type="time" class="form-control" placeholder="Hora: hh:mm" name="hour-reunion">   
                          </div>
                          <div class="col-md-6">
                            <label for="date-reunion">Fecha de la reunion</label>
                            <input type="date" class="form-control" placeholder="Fecha: dd/mm/yyyy" name="date-reunion">   
                          </div>
                        </div> 
                      </div>                    
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="btn-radio" id="meeting-no" value="2">
                      <label class="form-check-label" for="meeting-no">
                        No
                      </label>
                    </div>
                  </div>                          
                </div>      
              </fieldset>   
            </div>
            <div class="form-group ">
              <label for="place-activity">Lugar de la actividad:</label>
              <input type="text" class="form-control" id="place-activity" placeholder="Lugar de la actividad">
            </div>
            <div class="form-group ">
              <label for="organize-activity">Organización o Unidad organizadora :</label>
              <input type="text" class="form-control" id="organize-activity" placeholder="Nombre de la organización o unidad organizadora">
            </div> 
            <div class="form-group ">
              <label for="sponsor-activity">Organización o Unidad auspiciadora:</label>
              <input type="text" class="form-control" id="sponsor-activity" placeholder="Nombre de la organización o unidad auspiciadora">
            </div>
            <div class="form-group ">
              <label for="patrocina-activity">Organización o Unidad patrocinacinadora:</label>
              <input type="text" class="form-control" id="patrocina-activity" placeholder="Nombre de la organización o unidad patrocinadora">
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="start-date">Fecha de inicio:</label>
                <input type="date" class="form-control" id="start-date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group col-md-4">
                <label for="end-date">Fecha de termino:</label>
                <input type="date" class="form-control" id="end-date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group col-md-4">
                <label for="number-participants">Cantidad aproximada de participantes:</label>
                <input type="number" class="form-control" id="number-participants" placeholder="Cantidad aproximada de participantes">
              </div>
            </div>
            <div class="form-group">
              <label for="type-activity">Tipo de actividad</label>
              <select class="form-control" id="type-activity">
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
            </div>
            <div class="form-group ">
              <label for="other-activity">Si eligio en tipo de actividad "Otro", indicar cual es:</label>
              <input type="text" class="form-control" id="other-activity" placeholder="Nombre del tipo de actividad deseada">
            </div>
            <fieldset class="form-group">
              <div class="row">
                <legend class="col-form-label col-sm-5">¿Requiere apoyo de la Departamento de Comunicación y Admisión de la UCN?</legend>
                <div class="col-sm-7">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="btn-radio1" id="support-yes" value="3">
                    <label class="form-check-label" for="support-yes">
                      Si
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="btn-radio1" id="support-no" value="4">
                    <label class="form-check-label" for="support-no">
                      No
                    </label>
                  </div>
                </div>                          
              </div>   
            </fieldset>   
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="suplie-bandejas">Cantidad de bandejas necesarias:</label>
                <input type="number" class="form-control" id="suplie-bandejas" placeholder="Número de bandejas">
              </div>
              <div class="form-group col-md-4">
                <label for="suplie-tapetes">Cantidad de tapetes necesarios:</label>
                <input type="number" class="form-control" id="suplie-tapetes" placeholder="Número de tapetes">
              </div>
              <div class="form-group col-md-4">
                <label for="suplie-sillas">Cantidad de sillas necesarias:</label>
                <input type="number" class="form-control" id="suplie-sillas" placeholder="Número de sillas">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="suplie-paneles">Cantidad de paneles necesarios:</label>
                <input type="number" class="form-control" id="suplie-paneles" placeholder="Número de paneles">
              </div>
              <div class="form-group col-md-4">
                <label for="suplie-toldos">Cantidad de toldos necesarios:</label>
                <input type="number" class="form-control" id="suplie-toldos" placeholder="Número de toldos">
              </div>
              <div class="form-group col-md-4">
                <label for="suplie-otros">Otro:</label>
                <input type="text" class="form-control" id="suplie-otros" placeholder="Escriba el nombre el insumo que necesite">
              </div>
            </div>
            <div class="container">
              <input type="button" class = "btn btn-danger btn-md btn-izq" value="Cancelar">
              <input type="button" class = "btn btn-primary btn-md btn-der" value="Crear">
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