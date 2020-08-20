<?php
  session_start();
  require 'includes/queries.inc.php';
  if(!isset($_SESSION['user_id']) || !isset($_GET['modo'])){
      header("Location: dashboard.php");
      exit();
  }
  $modo = $_GET['modo'];
  //TODO: revisar con los datos de SIVCM-UCN si es que corresponde que vea esta pagina para la actividad.
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width = device-width, user-scalable = no">
      <title>Solicitar ayuda</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="static/css/styleActivitie.css?v2.2">
  </head>
  <body> 
    <?php
      require "header.php";
    ?>  
    <section class="main">
      <div class="container container-Form shadow p-3 mb-5 bg-white rounded row">
        <div class="col-md-12">
          <form action="">
            <div class="container-Title row">
              <div class="container col-md-12 ">
                <h2>Ver actividad Ingresada en SIVCM-UCN</h2>
                <small>Detalles de la actividad</small>
              </div>
            </div>
            <fieldset disabled>         
              <div class="form-group">
                <label for="code-activity">Código de Actividad:</label>
                <input type="text" class="form-control" id="code-activity" placeholder="Escriba el código de la actividad">
              </div>        
              <div class="form-group">
                <label for="name-activity">Nombre de Actividad:</label>
                <input type="text" class="form-control" id="name-activity" placeholder="Escriba el nombre de la actividad">
              </div>              
              <div class="form-group">
                <label for="unity">Unidad:</label>
                <input type="text" class="form-control" id="unity">
              </div>     
              <div class="form-group">
                <label for="coordinador">Coordinador de la actividad:</label>
                <input type="text" class="form-control" id="coordinador" placeholder="Escriba el nombre del coordinador de la actividad">
              </div>
              <div class="form-row">     
                <div class="form-group col-md-6">
                  <label for="start-date">Fecha de inicio:</label>
                  <input type="date" class="form-control" id="start-date" placeholder="dd/mm/yyyy">
                </div>
                <div class="form-group col-md-6">
                  <label for="end-date">Fecha de termino:</label>
                  <input type="date" class="form-control" id="end-date" placeholder="dd/mm/yyyy">
                </div>
              </div>       
              <div class="form-group">
                <label for="service">Servicio:</label>
                <input type="text" class="form-control" id="service">
              </div>         
              <div class="form-group">
                <label for="product">Producto:</label>
                <input type="text" class="form-control" id="product">
              </div>              
              <div class="form-group">
                <label for="area">Area de Vinculación:</label>
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
              </div>
              <div class="form-group">
                <label for="area">Tipos de Impactos:</label>
                <select multiple class="form-control" id="area">
                  <option disabled>No se puede elegir impactos internos y externos a la vez</option>
                  <optgroup label="Impacto interno">
                    <option>A) Contribuir al logro de los perfiles de egreso de los estudiantes en las carreras y programas de postgrado</option>
                    <option>B) Pertinencia de los perfiles de egreso de acuerdo a requerimientos del mercado laboral</option>
                    <option>C) Asegurar la Formación integral de los Estudiantes de Pregrado y Postgrado</option>
                    <option>D) Vincular Investigación con Docencia generando nuevo conocimiento en áreas del Desarrollo Territorial</option>
                    <option>E) Realizar proyectos I+D+i+e que respondan a las necesidades del entorno</option>
                  </optgroup>
                  <optgroup label="Impacto externo">
                    <option>1) Fin de la pobreza</option>
                    <option>2) Hambre cero</option>
                    <option>3) Salud y Bienestar</option>
                    <option>4) Educación de calidad</option>
                    <option>5) Igualdad de Género</option>
                    <option>6) Agua limpia y saneamiento</option>
                    <option>7) Energía asequible y no contaminante</option>
                    <option>8) Trabajo decente y crecimiento económico</option>
                    <option>9) Industria, Innovacion e Infraestrucutra</option>
                    <option>10) Reducción de las desigualdades</option>
                    <option>11) Ciudades y Comunidades sostenibles</option>
                    <option>12) Producción y consumo responsables</option>
                    <option>13)Acción por el clima</option>
                    <option>14) Vida submarina</option>
                    <option>15) Vida de ecosistemas terrestres</option>
                    <option>16) Paz, Justicia e Insituciones solidas</option>
                    <option>17) Alianzas para lograr los objetivos</option>
                  </optgroup>   
                </select>
              </div>
              <label for="beneficiario-interno">Listado de Beneficiarios Internos:</label>
              <div class="table-responsive">
                <table class="table table-bordered tableA" id="beneficiario-interno">
                    <thead>
                      <th>Tipo Público</th>
                      <th>Beneficiarios directos</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
              <label for="beneficiario-externo">Listado de Beneficiarios Externos:</label>
              <div class="table-responsive">
                <table class="table table-bordered tableA" id="beneficiario-externo">
                    <thead>
                      <th>Tipo Público</th>
                      <th>Beneficiarios directos</th>
                      <th>Beneficiarios indirectos</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
              <label for="socios-estrategicos">Listado de Socios estratégicos:</label>
              <div class="table-responsive">
                <table class="table table-bordered tableA" id="socios-estrategicos">
                    <thead>
                      <th>Socio estratégico</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
            </fieldset>
          </form> 
        </div>
      </div>
      <?php //EMPIEZA INGRESO DE SOLICITUD DE AYUDA ?>
      <div class="container container-Form shadow p-3 mb-5 bg-white rounded row">
        <div class="col-md-12">
        <form action="includes/ingresoAyuda.inc.php" method="POST" id = "Ingresar_Ayuda">
            <div class=" container-Title row">
              <div class="container col-md-12">
                <?php
                    if($modo == 'ver'){
                      echo "<h2>Ver Solicitud de Ayuda Ingresada en SIVCM-FACMED</h2>";
                    }
                    else if($modo == 'ingresar'){
                      echo "<h2>Ingresar formulario de ayuda</h2>";
                    }
                ?>
                <small>Solicitud a Vinculación con el Medio</small>
              </div>
            </div>
            <div class="form-group">
              <label for="code-activity">Código de Actividad:</label>
              <input type="text" class="form-control" id="code-activity" name="code-activity" placeholder="Escriba el código de la actividad" readonly="readonly" <?php echo 'value='.$_GET['id']?>>
            </div>
            <?php
              if($modo == 'ver'){
                echo "<fieldset disabled>";
              }else if($modo == 'ingresar'){
                echo "<fieldset>";
              }
            ?>
              <div class="form-group">
                <label for="solicitante">Solicitante de ayuda:</label>
                <input type="text" class="form-control" id="solicitante" name="solicitante" placeholder="Escriba el nombre de quien solicita la ayuda" required="">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="correo">Correo:</label>
                  <input type="text" class="form-control" id="correo" name="correo" placeholder="Ejemplo: ejemplo@ucn.cl" required="">
                </div>    
                <div class="form-group col-md-6">
                  <label for="telefono">Teléfono:</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ejemplo: +56 9 8756 4523" required="">
                </div>   
              </div>  
              <div class="form-group">
                <label for="logistic-support">Apoyo en la logística:</label>
                <ul class="apoyo_seleccion">
                  <li><input type="checkbox" name="logistic[]" id="FAMED" value="FAMED"><label for="FAMED">Pendón FAMED</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Enfermeria" value="Enfermeria"><label for="Enfermeria">Pendón C. Enfermería</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Kinesiologia" value="Kinesiologia"><label for="Kinesiologia">Pendón C. Kinesiología</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Medicina" value="Medicina"><label for="Medicina">Pendón C. Medicina</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Nutricion" value="Nutricion"><label for="Nutricion">Pendón C. Nutrición</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Impresa" value="Impresa"><label for="Impresa">Constancia Impresa</label></li>
                  <li><input type="checkbox" name="logistic[]"  id="Digital" value="Digital"><label for="Digital">Constancia Digital</label></li>
                </ul>        
              </div>
              <fieldset class="form-group">
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
                      <input class="form-check-input" type="radio" name="btn-radio" id="meeting-no" value="2" checked>
                      <label class="form-check-label" for="meeting-no">
                        No
                      </label>
                    </div>
                  </div>                          
                </div>      
              </fieldset>  
              <div class="form-group">
                <label for="number-participants">Cantidad aproximada de participantes:</label>
                <input type="number" class="form-control" id="number-participants" name="number-participants" placeholder="Cantidad aproximada de participantes" required="">
              </div>
              <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-12">¿Requiere apoyo de la Departamento de Comunicación y Admisión de la UCN?</legend>
                  <div class="col-sm-12">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="btn-radio1" id="support-yes" value="3">
                      <label class="form-check-label" for="support-yes">
                        Si
                      </label>
                      <div class="need-reunion">
                        <div class="form-row">
                          <div class="col-md-12">
                            <label for="link-meeting">Link formulario del Departamento de Comunicación:</label>
                          </div>
                          <div class="col-md-12">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeVFJJ1Ucet7rqNi_Jrb9IdbOZ9bjHk8W_7YSvWX5IJ-pmKjA/viewform?c=0&w=1" target="null">
                            Click aqui para ingresar al formulario</a>                       
                          </div>
                        </div> 
                      </div>   
                    </div> 
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="btn-radio1" id="support-no" value="4" checked>
                      <label class="form-check-label" for="support-no">
                        No
                      </label>
                    </div>
                  </div>                          
                </div>   
              </fieldset>
              <div class="form-group">
                <label for="need-support">Necesidad de Apoyo Tecnico:</label>
                <textarea class="form-control" id="need-support" name="need-support" rows="3" placeholder="Especifique que apoyo tecnico necesita" required=""></textarea>
              </div> 
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="suplie-bandejas">Cantidad de bandejas necesarias:</label>
                  <input type="number" class="form-control" id="suplie-bandejas" name="suplie-bandejas" placeholder="Número de bandejas" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="suplie-tapetes">Cantidad de tapetes necesarios:</label>
                  <input type="number" class="form-control" id="suplie-tapetes" name="suplie-tapetes" placeholder="Número de tapetes" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="suplie-sillas">Cantidad de sillas necesarias:</label>
                  <input type="number" class="form-control" id="suplie-sillas" name="suplie-sillas" placeholder="Número de sillas" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="suplie-paneles">Cantidad de paneles necesarios:</label>
                  <input type="number" class="form-control" id="suplie-paneles" name="suplie-paneles" placeholder="Número de paneles" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="suplie-toldos">Cantidad de toldos necesarios:</label>
                  <input type="number" class="form-control" id="suplie-toldos" name="suplie-toldos" placeholder="Número de toldos" required="">
                </div>
              </div>     
              <div class="form-group">
                <label for="suplie-otros">Otro:</label>
                <textarea class="form-control" id="suplie-otros" name="suplie-otros" rows="3" placeholder="Escriba el nombre el insumo que necesite"></textarea>
              </div>
            </fieldset>
            <?php
              if($modo == 'ingresar'){
                echo '<div class="container row">
                  <div class="col-sm-12 col-md-6"> 
                    <a class = "btn btn-danger btn-md btn-izq" href="dashboard.php">Cancelar</a>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <input type="submit" class = "btn btn-primary btn-md btn-der" value="Solicitar" name="registrar-ayuda-submit">
                  </div>
                </div>'; 
              }else if($modo == 'ver'){
                echo '
                <div class="col-md-12">
                  <a class = "btn btn-danger btn-md btn-izq" href="dashboard.php">Volver</a>
                </div>'; 
              }
            ?>
          </form>
        </div>
      </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>