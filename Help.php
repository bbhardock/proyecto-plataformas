<?php
  session_start();
  require 'includes/queries.inc.php';
  if(!isset($_SESSION['user_id']) || !isset($_GET['modo']) || !isset($_GET['periodo'])){ //comprobacion del get
      header("Location: dashboard.php");
      exit();
  }
  $modo = $_GET['modo'];
  $id = $_GET['id'];
  $periodo = $_GET['periodo'];

  $actividad = json_decode(obtenerActividad($periodo,$id));

  if(!$actividad){//verificar que actividad exista
    header("Location: dashboard.php");
    exit(); 
  }

  $solicitudAyuda = json_decode(obtenerSolicitudAyuda($id));

  /*
  El usuario solo puede ver o editar las acciones que le pertenecen.
  La comprobación para el usuario debe ser entre el rut de la actividad y el rut del usuario en sesión (SIN DIGITO VERIFICADOR)
  */
  if ($_SESSION['user_admin_status'] =='N' && strcmp($actividad->RutUsuario,substr($_SESSION['user_rut'], 0, -1)) != 0){
    header("Location: dashboard.php");
    exit();
  /*
  El admin solo puede ver todas las actividades (no ingresarlas)
  */
  }else if ($_SESSION['user_admin_status'] == 'S' && strcmp($modo,"ver") != 0){
    header("Location: dashboard.php");
    exit(); 
  }

  $formatoFecha = "d/m/Y";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width = device-width, user-scalable = no">
      <title>Solicitar ayuda</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css?v1.0"/>
      <link rel="stylesheet" href="static/css/styleActivitie.css?v2.7">

      <!-- Fuente -->
      <link rel="stylesheet" href="https://use.typekit.net/jyw0mhj.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400&display=swap">
  </head>
  <body> 
    <?php
      require "header.php";

      //TODO: AGREGAR PANTALLAS DE AVISO
      if ($solicitudAyuda && strcmp($modo,"ingresar") == 0){ //LA SOLICITUD DE AYUDA YA EXISTE. PUEDE VER LOS DETALLES DE LA MISMA EN ESTE FORMULARIO
        $modo = "ver";
        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> La solicitud de ayuda que desea ingresar ya existe. Se mostrarán los detalles de la misma en el formulario. </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
      }else if (!$solicitudAyuda && strcmp($modo,"ver") == 0){ //LA SOLICITUD DE AYUDA NO EXISTE. PUEDE INGRESAR LA SOLICITUD EN ESTE FORMULARIO
          echo '  <div class="row">
                    <div class="col"></div>
                    <div class="col-md-9">
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>La solicitud de ayuda que desea ver no existe aún </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    </div>
                    <div class="col"></div>
                  </div>';
        $modo = "ingresar";
      }
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
                <input type="text" class="form-control" id="code-activity" value="<?php echo $actividad->CodigoActividad?>" placeholder="Escriba el código de la actividad">
              </div>        
              <div class="form-group">
                <label for="name-activity">Nombre de Actividad:</label>
                <input type="text" class="form-control" id="name-activity" value="<?php echo $actividad->NombreActividad?>" placeholder="Escriba el nombre de la actividad">
              </div>              
              <div class="form-group">
                <label for="unity">Unidad:</label>
                <input type="text" class="form-control" value="<?php echo $actividad->Unidad?>" id="unity">
              </div>     
              <div class="form-group">
                <label for="coordinador">Coordinador de la actividad:</label>
                <input type="text" class="form-control" id="coordinador" value="<?php echo $actividad->NombreUsuario?>" placeholder="Escriba el nombre del coordinador de la actividad">
              </div>
              <div class="form-row">     
                <div class="form-group col-md-6">
                  <label for="start-date">Fecha de inicio:</label>
                  <input type="date" class="form-control" value="<?php $fechaInicio = date_create_from_format($formatoFecha,$actividad->FechaInicio); echo date_format($fechaInicio, 'Y-m-d');?>" id="start-date" placeholder="dd/mm/yyyy">
                </div>
                <div class="form-group col-md-6">
                  <label for="end-date">Fecha de termino:</label>
                  <input type="date" class="form-control" value="<?php $fechaTermino = date_create_from_format($formatoFecha,$actividad->FechaTermino); echo date_format($fechaTermino, 'Y-m-d');?>" id="end-date" placeholder="dd/mm/yyyy">
                </div>
              </div>       
              <div class="form-group">
                <label for="service">Servicio:</label>
                <input type="text" class="form-control" value="<?php echo $actividad->Servicio?>" id="service">
              </div>         
              <div class="form-group">
                <label for="product">Producto:</label>
                <input type="text" class="form-control" value="<?php echo $actividad->Producto?>" id="product">
              </div>              
              <div class="form-group">
                <label for="area">Area de Vinculación:</label>
                <select class="form-control" id="area">
                  <option> <?php echo $actividad->AreaVinculacion ?> </option>
                </select>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tipos-impacto">Impactos Internos relacionados:</label>
                  <div class="table-responsive">
                    <table class="table table-bordered tableA" id="tipos-impacto">
                        <thead>
                          <th>Impacto Interno</th>
                        </thead>
                        <tbody>
                          <?php
                            foreach($actividad->ListaImpactosInternos as $impInternos){
                              echo '<tr>
                              <td>'.$impInternos->DescripcionImpacto.'</td>
                              </tr>';
                            }
                          ?>
                        </tbody>
                    </table>
                  </div>  
                </div>
                <div class="form-group col-md-6">
                  <label for="tipos-impacto">Impactos Externos relacionados:</label>
                  <div class="table-responsive">
                    <table class="table table-bordered tableA" id="tipos-impacto">
                        <thead>
                          <th>Impacto Externo</th>
                        </thead>
                        <tbody>
                          <?php
                            foreach($actividad->ListaImpactosExternos as $impExternos){
                              echo '<tr>
                              <td>'.$impExternos->DescripcionImpacto.'</td>
                              </tr>';
                            }
                          ?>
                        </tbody>
                    </table>
                  </div> 
                </div>
              </div>           
              <label for="beneficiario-interno">Listado de Beneficiarios Internos:</label>
              <div class="table-responsive">
                <table class="table table-bordered tableA" id="beneficiario-interno">
                    <thead>
                      <th>Tipo Público</th>
                      <th>Beneficiarios directos</th>
                    </thead>
                    <tbody>
                      <?php
                        foreach($actividad->ListadoBeneficiariosInternos as $beneInternos){
                          echo '<tr>
                          <td>'.$beneInternos->DescripcionBeneficiarioInterno.'</td>
                          <td>'.$beneInternos->CantidadBeneficiariosDirectos.'</td>
                          </tr>';
                        }
                      ?>
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
                    <?php
                        foreach($actividad->ListadoBeneficiariosExternos as $beneExternos){
                          echo '<tr>
                          <td>'.$beneExternos->DescripcionBeneficiarioExterno.'</td>
                          <td>'.$beneExternos->CantidadBeneficiariosDirectos.'</td>
                          <td>'.$beneExternos->CantidadBeneficiariosIndirectos.'</td>
                          </tr>';
                        }
                      ?>
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
                      <?php
                        foreach($actividad->ListadoSocios as $socio){
                          echo '<tr>
                          <td>'.$socio->DescripcionSocio.'</td>
                          </tr>';
                      }
                      ?>
                    </tbody>
                </table>
              </div>
            </fieldset>
          </form> 
        </div>
      </div>
      <!-- //EMPIEZA INGRESO DE SOLICITUD DE APOYO -->
      <div class="container container-Form shadow p-3 mb-5 bg-white rounded row">
        <div class="col-md-12">
        <form action="includes/ingresoAyuda.inc.php" method="POST" id = "Ingresar_Ayuda">
            <div class=" container-Title row">
              <div class="container col-md-12">
                <?php
                    if($modo == 'ver'){
                      echo "<h2>Ver Solicitud de Apoyo Ingresada en SIVCM-FACMED</h2>";
                    }
                    else if($modo == 'ingresar'){
                      echo "<h2>Ingresar formulario de apoyo</h2>";
                    }
                ?>
                <small>Solicitud a Vinculación con el Medio</small>
              </div>
            </div>
            <div class="form-group">
              <label for="code-activity">Código de Actividad:</label>
              <input type="text" class="form-control" id="code-activity" name="code-activity" placeholder="Escriba el código de la actividad" readonly="readonly" <?php echo 'value='.$id?>>
            </div>
            <?php
              if($modo == 'ver'){
                echo "<fieldset disabled>";
                echo ' <div class="form-group">
                <label for="solicitante">Solicitante de ayuda:</label>
                <input type="text" class="form-control" id="solicitante" value="'.$solicitudAyuda->nombre_solicitante.'" name="solicitante" placeholder="Escriba el nombre de quien solicita la ayuda" required="">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="correo">Correo:</label>
                  <input type="text" class="form-control" id="correo" value="'.$solicitudAyuda->correo.'" name="correo" placeholder="Ejemplo: ejemplo@ucn.cl" required="">
                </div>    
                <div class="form-group col-md-6">
                  <label for="telefono">Teléfono:</label>
                  <input type="text" class="form-control" id="telefono" value="'.$solicitudAyuda->telefono.'" name="telefono" placeholder="Ejemplo: +56 9 8756 4523" required="">
                </div>   
              </div>  
              <div class="form-group">
                <label for="logistic-support">Apoyo en la logística:</label>
                <ul class="apoyo_seleccion">';
                if($solicitudAyuda->logistica_pendon_famed_S_N == "S"){
                  echo '<li><input type="checkbox" name="logistic[]" id="FAMED" value="FAMED" checked><label for="FAMED">Pendón FAMED</label></li>';  
                }else{
                  echo '<li><input type="checkbox" name="logistic[]" id="FAMED" value="FAMED"><label for="FAMED">Pendón FAMED</label></li>';
                }

                if($solicitudAyuda->logistica_pendon_enfermeria_S_N == "S"){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Enfermeria" value="Enfermeria" checked><label for="Enfermeria">Pendón C. Enfermería</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Enfermeria" value="Enfermeria"><label for="Enfermeria">Pendón C. Enfermería</label></li>';
                }

                if($solicitudAyuda->logistica_pendon_kine_S_N == 'S'){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Kinesiologia" value="Kinesiologia" checked><label for="Kinesiologia">Pendón C. Kinesiología</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Kinesiologia" value="Kinesiologia"><label for="Kinesiologia">Pendón C. Kinesiología</label></li>';
                }

                if($solicitudAyuda->logistica_pendon_medi_S_N == 'S'){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Medicina" value="Medicina" checked><label for="Medicina">Pendón C. Medicina</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Medicina" value="Medicina"><label for="Medicina">Pendón C. Medicina</label></li>';
                }

                if($solicitudAyuda->logistica_pendon_nutri_S_N == 'S'){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Nutricion" value="Nutricion" checked><label for="Nutricion">Pendón C. Nutrición</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Nutricion" value="Nutricion"><label for="Nutricion">Pendón C. Nutrición</label></li>';
                }

                if($solicitudAyuda->logistica_const_impresa_S_N == 'S'){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Impresa" value="Impresa" checked><label for="Impresa">Constancia Impresa</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Impresa" value="Impresa" checked><label for="Impresa">Constancia Impresa</label></li>';
                }

                if($solicitudAyuda->logistica_const_digital_S_N == 'S'){
                  echo '<li><input type="checkbox" name="logistic[]"  id="Digital" value="Digital" checked><label for="Digital">Constancia Digital</label></li>';
                }else{
                  echo '<li><input type="checkbox" name="logistic[]"  id="Digital" value="Digital"><label for="Digital">Constancia Digital</label></li>';
                }

                echo '
                </ul>        
              </div>
              <fieldset class="form-group">
                <legend class="col-form-label col-md-12">Requiere reunión de coordinación:</legend>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-check">';
                    if ($solicitudAyuda->requiere_reunion_S_N == "S"){
                      echo '<input class="form-check-input" type="radio" name="btn-radio" id="meeting-yes" value="1" checked>';  
                    }else{
                      echo '<input class="form-check-input" type="radio" name="btn-radio" id="meeting-yes" value="1">';  
                    }
                    echo '
                      <label class="form-check-label" for="meeting-yes">
                        Si
                      </label>      
                      <div class="need-reunion">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="hour-reunion">Hora de la reunion</label>
                            <input type="time" class="form-control" placeholder="Hora: hh:mm" name="hour-reunion" value="'.$solicitudAyuda->hora_reunion.'">   
                          </div>
                          <div class="col-md-6">
                            <label for="date-reunion">Fecha de la reunion</label>
                            <input type="date" class="form-control" placeholder="Fecha: dd/mm/yyyy" name="date-reunion" value="'.$solicitudAyuda->fecha_reunion.'">   
                          </div>
                        </div> 
                      </div>                    
                    </div>
                    <div class="form-check">';
                    if ($solicitudAyuda->requiere_reunion_S_N == "N"){
                      echo '<input class="form-check-input" type="radio" name="btn-radio" id="meeting-no" value="2" checked>';
                    }else{
                      echo '<input class="form-check-input" type="radio" name="btn-radio" id="meeting-no" value="2">'; 
                    }
                    echo '
                      <label class="form-check-label" for="meeting-no">
                        No
                      </label>
                    </div>
                  </div>                          
                </div>      
              </fieldset>  
              <div class="form-group">
                <label for="number-participants">Cantidad aproximada de participantes:</label>
                <input type="number" class="form-control" id="number-participants" value="'.$solicitudAyuda->cantidad_aprox_participantes.'" name="number-participants" placeholder="Cantidad aproximada de participantes" required="">
              </div>
              <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-12">¿Requiere apoyo de la Departamento de Comunicación y Admisión de la UCN?</legend>
                  <div class="col-sm-12">
                    <div class="form-check">';
                    if ($solicitudAyuda->requiere_apoyo_com_S_N == "S"){
                      echo '<input class="form-check-input" type="radio" name="btn-radio1" id="support-yes" value="3" checked>';  
                    }else{
                      echo '<input class="form-check-input" type="radio" name="btn-radio1" id="support-yes" value="3"';   
                    }
                    echo '
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
                    <div class="form-check">';
                    if ($solicitudAyuda->requiere_apoyo_com_S_N == "N"){
                      echo '<input class="form-check-input" type="radio" name="btn-radio1" id="support-no" value="4" checked>';  
                    }else{
                      echo '<input class="form-check-input" type="radio" name="btn-radio1" id="support-no" value="4">'; 
                    }
                    echo '
                      <label class="form-check-label" for="support-no">
                        No
                      </label>
                    </div>
                  </div>                          
                </div>   
              </fieldset>
              <div class="form-group">
                <label for="need-support">Necesidad de Apoyo Tecnico:</label>
                <textarea class="form-control" id="need-support" name="need-support" rows="3" placeholder="Especifique que apoyo tecnico necesita" required="">'.$solicitudAyuda->apoyo_tecnico.'</textarea>
              </div> 
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="suplie-bandejas">Cantidad de bandejas necesarias:</label>
                  <input type="number" class="form-control" id="suplie-bandejas" value="'.$solicitudAyuda->cant_insumo_bandejas.'" name="suplie-bandejas" placeholder="Número de bandejas" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="suplie-tapetes">Cantidad de tapetes necesarios:</label>
                  <input type="number" class="form-control" id="suplie-tapetes" value="'.$solicitudAyuda->cant_insumo_tapetes.'" name="suplie-tapetes" placeholder="Número de tapetes" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="suplie-sillas">Cantidad de sillas necesarias:</label>
                  <input type="number" class="form-control" id="suplie-sillas" value="'.$solicitudAyuda->cant_insumo_sillas.'" name="suplie-sillas" placeholder="Número de sillas" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="suplie-paneles">Cantidad de paneles necesarios:</label>
                  <input type="number" class="form-control" id="suplie-paneles" value="'.$solicitudAyuda->cant_insumo_paneles.'" name="suplie-paneles" placeholder="Número de paneles" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="suplie-toldos">Cantidad de toldos necesarios:</label>
                  <input type="number" class="form-control" id="suplie-toldos" value="'.$solicitudAyuda->cant_insumo_toldos.'" name="suplie-toldos" placeholder="Número de toldos" required="">
                </div>
              </div>     
              <div class="form-group">
                <label for="suplie-otros">Otro:</label>
                <textarea class="form-control" id="suplie-otros" name="suplie-otros" rows="3" placeholder="Escriba el nombre el insumo que necesite">'.$solicitudAyuda->cant_insumo_otros.'</textarea>
              </div>
            </fieldset>';
            echo '
            <div class="col-md-12">
              <a class = "btn btn-danger btn-md btn-izq" href="dashboard.php">Volver</a>
            </div>'; 
              }else if($modo == 'ingresar'){
                if($_SESSION['user_admin_status'] == 'S'){
                  echo "<fieldset disabled>";
                }else{
                  echo "<fieldset>";
                }
                echo '
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
                    <input type="text" class="form-control" id="telefono"  name="telefono" placeholder="Ejemplo: +56 9 8756 4523" required="">
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
              </fieldset>';
              if($_SESSION['user_admin_status'] == "N")
              echo '<div class="container row">
              <div class="col-sm-12 col-md-6"> 
                <a class = "btn btn-danger btn-md btn-izq" href="dashboard.php">Cancelar</a>
              </div>
              <div class="col-sm-12 col-md-6">
                <input type="submit" class = "btn btn-primary btn-md btn-der" value="Solicitar" name="registrar-ayuda-submit">
              </div>
            </div>';
            else{
              echo '
              <div class="col-md-12">
                <a class = "btn btn-danger btn-md btn-izq" href="dashboard.php">Volver</a>
              </div>'; 
            } 
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