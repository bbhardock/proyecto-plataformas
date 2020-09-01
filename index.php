<?php
    require 'includes/queries.inc.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
        exit();
    }
    $periodo = date("Y");//todo en base al año actual. Si se quiere cambiar el periodo para hacer todo este resumen, esta es la variable a modificar
    $actividades = json_decode(apiListarTodasActividades($periodo));
    $formatoFecha = "d/m/Y";
    $resumenBeneficiarios = json_decode(obtenerDatosBeneficiariosResumen($periodo));
    $resumenGraficos = json_decode(obtenerDatosGraficosResumen($periodo)); 
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <title>Vinculación con el medio</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="static/css/fontello.css?v1.8"/>
        <link rel="stylesheet" href="static/css/styleIndex.css?v3.9"/>
        <!-- Fuente -->
        <link rel="stylesheet" href="https://use.typekit.net/jyw0mhj.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400&display=swap">

        <!-- Calendario -->
        <link href='static/fullcalendar/core/main.css' rel='stylesheet' />
        <link href='static/fullcalendar/daygrid/main.css' rel='stylesheet' />

        <!-- Graficos -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <!-- Calendario -->
        <script src='static/fullcalendar/core/main.js'></script>
        <script src='static/fullcalendar/core/locales/es.js'></script>
        <script src='static/fullcalendar/daygrid/main.js'></script>
        <script src='static/fullcalendar/moment/main.js'></script>
        <!-- Generador del calendario y actividades-->
        <script>
           document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                    header: {
                        left: 'title',
                        center: '',
                        right: 'today prev,next',
                        
                    },
                    eventSources:[{
                        events:[
                            <?php foreach ($actividades as $actividad){
                                /*
                                    start: "'.$actividad->FechaInicio.'",
                                    end: "'.$actividad->FechaTermino.'",
                                */
                                $fechaInicio = date_create_from_format($formatoFecha,$actividad->FechaInicio);
                                $fechaTermino = date_create_from_format($formatoFecha,$actividad->FechaTermino);
                                $stringLugaresRealizacion = "";
                                if($actividad->LugarRealizacion != null){
                                    foreach($actividad->LugarRealizacion as $lugar){
                                        $stringLugaresRealizacion = $stringLugaresRealizacion.$lugar->LugarRealizacion.", ".$lugar->CiudadLocalidad.", ".$lugar->Comuna.", ".$lugar->Pais." / ";
                                    }
                                }else{
                                    $stringLugaresRealizacion = "No ha sido informado";
                                }   
                                $stringLugaresRealizacion = rtrim($stringLugaresRealizacion, " / ");
                                echo '                            {
                                    title: "'.$actividad->NombreActividad.'",
                                    start: "'.date_format($fechaInicio,'Y-m-d').'",
                                    end: "'.date_format($fechaTermino,'Y-m-d').'",
                                    extendedProps: {
                                        unidad: "'.$actividad->Unidad.'",
                                        areaVinculacion: "'.$actividad->AreaVinculacion.'",
                                        lugar: "'.$stringLugaresRealizacion.'",
                                        fechaInicio: "'.$actividad->FechaInicio.'",
                                        fechaTermino: "'.$actividad->FechaTermino.'"
                                    }
                                },';
                            }
                            ?>
                        ],
                        color: "rgb(247, 216, 162)",
                        textColor: "rgba(0, 0, 0, 0.6)"
                    }],
                    
                    eventClick:function(actividadInfo){
                        $('#tituloActividad').html(actividadInfo.event.title);
                        $('#unidad').val(actividadInfo.event.extendedProps.unidad);
                        $('#areaVinculacion').val(actividadInfo.event.extendedProps.areaVinculacion);
                        $('#lugar').val(actividadInfo.event.extendedProps.lugar);
                        $('#fechaInicio').val(actividadInfo.event.extendedProps.fechaInicio);
                        $('#fechaTermino').val(actividadInfo.event.extendedProps.fechaTermino);

                        $('#selectorActividad').modal();
                    },
                    editable: false, //Los eventos en el calendario no pueden ser editable
                    droppable: true, //Permite que los eventos puedan dropear en el calendario
                    locale: 'es', //Los dias del calendario las deja en español
                    themeSystem: 'standard' //Se utiliza el theme standar
                    
                });
            calendar.render();
            });
        </script>
    </head>
    <body>
        <?php
            require "header.php";
        ?> 
        <div class="ir-arriba">
            <div class="ir-arriba-button">
                <i class="icon-up"></i>
            </div>
        </div>
        <section class="main">
            <div class="container">                
                <section id="calendario">
                    <div class="row">
                        <div class="col Title-Index">
                            <div id="slideNoticias" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="slideTitulo carousel-item active">
                                        <div class="container">
                                            <ul>
                                                <li>Vinculación con el Medio FAMED Coquimbo</li>
                                                <li>Universidad Católica del Norte Coquimbo</li>
                                            </ul>
                                        </div>
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a target="null" href="https://medicina.ucn.cl/ucn-se-integra-a-la-red-publica-de-laboratorios-universitarios-para-diagnostico-covid-19-en-coquimbo/">
                                            <img src="static/images/ucncoquimbo2.jpg" class="imagenClaro d-block w-100" alt="">
                                        </a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <a target="null" href="https://medicina.ucn.cl/ucn-se-integra-a-la-red-publica-de-laboratorios-universitarios-para-diagnostico-covid-19-en-coquimbo/">
                                                <h5>Second slide label</h5>
                                                <p>Noticias respecto al covid-19 en la facultad de Medicina</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a target="null" href="https://medicina.ucn.cl/becas-especialidades-medicas/">
                                            <img src="static/images/ucncoquimbo2.jpg" class="imagenClaro d-block w-100" alt="">
                                        </a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <a target="null" href="https://medicina.ucn.cl/becas-especialidades-medicas/">
                                                <h5>Third slide label</h5>
                                                <p>Conoce mas de nuestras Becas de Especialidades Médicas</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#slideNoticias" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#slideNoticias" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="Title-SubtitleBlueCalendar">
                                <div class="container blue">
                                    <h5>Calendario de Actividades</h5>
                                </div>
                            </div>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </section>
                <section  id="informacion">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Title-SubtitleBlue">
                                <div class="container blue">
                                    <h5>Cantidad de Beneficiarios <?php echo "Periodo ".$periodo; ?> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        /*
                        Generación de Datos resumen de beneficiarios
                        */
                        if(empty((array) $resumenBeneficiarios)){
                            echo '  <div class="contenedorAlerta">
                                        <div class="alert alert-info" role="alert">
                                            <h5> Aún no existen datos para este periodo </h5>
                                        </div>
                                    </div>';
                        }
                        else{
                            $arrayContainers = array("containerBig container green", "containerBig container bluelight", "containerBig container green",
                            "containerSmall container brown", "containerSmall container blue", "containerBig container purple", "containerBig container browndark",
                            "containerBig container purple");
                            $contador = 0;
                            $contadorDivs = 0;
                            foreach($resumenBeneficiarios as $areaVinculacion => $cantidades){
                                if($contador == 0 || $contador == 3 || $contador ==5){
                                    echo '<div class="row">';
                                }
                                if($contador == 3 || $contador == 4){
                                    echo '<div class="col-md-12 col-lg-6">';
                                }
                                else{
                                    echo '<div class="col-md-12 col-lg-4">';
                                }
                                echo '  <div class="info-resumen">
                                            <div class="'.$arrayContainers[$contador].'">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12">                                                
                                                        <div class="fondoUnidad">
                                                            <h5>'.$areaVinculacion.'</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="titulo">
                                                            <h4>Beneficiarios Internos</h4>
                                                            <h5>Cantidad de beneficiarios que participaron con nosotros</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="titulo">
                                                            <h4>Beneficiarios Externos</h4>
                                                            <h5>Cantidad de beneficiarios que participaron con nosotros</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <h2>'.$cantidades->BeneficiariosInternos.'</h2>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <h2>'.$cantidades->BeneficiariosExternos.'</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>';
                                if($contador == 2 || $contador == 4 || $contador == 7){
                                    echo '</div>';
                                    $contadorDivs--;
                                }if($contadorDivs>0){
                                    for($i= 0; $i<$contadorDivs; $i++){
                                        echo '</div>';
                                    }
                                }

                                $contador++;
                                $contador = $contador % 8;
                            }
                        }
                    ?>
                </section>
                <section  id="graficos">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Title-SubtitleRed">
                                <div class="container red">
                                    <h5>Resumen de Actividades de manera Grafica</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $arrayTitulo = array("Area de Actividades","Socios Estrategicos","Producto","Estado");
                        $arrayId = array("graficaTorta","graficaTorta1","graficaTorta4","graficaTorta5");
                        $contador = 0;
                        foreach($arrayTitulo as $titulo){
                            if($contador == 0 || $contador == 2 || $contador == 4){
                                echo ' <div class="row">';
                            }
                            echo '  <div class="col-md-6">
                                        <div class="graficos">
                                            <div class="container">
                                                <div class="titulo">
                                                    <h6>'.$titulo.'</h6>
                                                </div>
                                                <div class="torta">
                                                    <figure class="highcarts-figure">
                                                        <div id='.$arrayId[$contador].'></div>
                                                    </figure>
                                                </div>                               
                                            </div>
                                        </div>
                                    </div>';
                            if($contador == 1 || $contador == 3 || $contador == 5){
                                echo ' </div>';
                            }
                            $contador++;
                            $contador = $contador % 6;
                        }
                    ?>
                    
                </section>               
            </div>    
        </section>
        <!-- Pop up -->
        <div class="modal fade" id="selectorActividad" tabindex="-1" aria-labelledby="tituloActividad" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloActividad"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <fieldset disabled="disabled">
                            <div class="form-group">
                                <label for="unidad">Unidad participante:</label>
                                <input type="text" class="form-control" id="unidad" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="areaVinculacion">Area de Vinculación:</label>
                                <input type="text" class="form-control" id="areaVinculacion" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="lugar">Lugar donde se realiza la Actividad:</label>
                                <input type="text" class="form-control" id="lugar" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input type="text" class="form-control" id="fechaInicio" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="fechaTermino">Fecha de Termino:</label>
                                <input type="text" class="form-control" id="fechaTermino" placeholder="">
                            </div>
                            <div class="form-group">
                                <p>Para mayor información contactarse a:</p>
                                <div class="container">
                                    <p><label class="correo icon-gmail"></label> vinculacionfamed@ucn.cl</p>
                                    <p><label class="facebook icon-facebook"></label>Facultad de Medicina UCN</p>
                                    <p> <label class="instagram icon-instagram"></label>FACULTADMEDICINAUCN</p>
                                </div>
                            </div>    
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require 'footer.php';
        ?>
        <!-- Intento de animacion al cargar pagina
        <script>
            let animadoDer = document.querySelectorAll(".animadoDer");
            let animadoIzq = document.querySelectorAll(".animadoIzq");
            function mostrarScroll(){
                let scrollTop = document.documentElement.scrollTop;
                for (var i = 0; i < animadoDer.length; i++){
                    let alturaAnimado = animadoDer[i].offsetTop;
                    if(alturaAnimado  < scrollTop){
                        animadoDer[i].style.opacity = 1;
                        animadoDer[i].classList.add("mostrarDerecha");
                    }
                }
                for (var i = 0; i < animadoIzq.length; i++){
                    let alturaAnimado = animadoIzq[i].offsetTop;
                    if(alturaAnimado - 100 < scrollTop){
                        animadoIzq[i].style.opacity = 1;
                        animadoIzq[i].classList.add("mostrarIzquierda");
                    }
                }
            }
            window.addEventListener('scroll',mostrarScroll);
        </script>
        -->
        <!-- Funcionalidad del boton de subida -->
        <script>
            window.onscroll = function(){
                if(document.documentElement.scrollTop > 100){
                    document.querySelector('.ir-arriba').classList.add('mostrar');
                }else{
                    document.querySelector('.ir-arriba').classList.remove('mostrar');
                }
            }
            document.querySelector('.ir-arriba').addEventListener('click', ()=>{
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        </script>
        <!-- Radializando colores -->
        <script>
            // Radialize the colors
            Highcharts.setOptions({
                
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });

        </script>
        <!-- Grafico Torta 1 -->
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Todas las Actividades segun su Area'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f}',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [<?php
                        foreach($resumenGraficos->ActividadesxArea as $nombre => $valor){
                            echo "{name: '".$nombre."', y: ".$valor."},";
                        }
                        ?>]
                }]
            });
        </script>
        <!-- Grafico Torta 2 -->
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cantidad de Actividades segun los socios involucrados'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f} ',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [<?php
                        foreach($resumenGraficos->ActividadesxSocios as $nombre => $valor){
                            echo "{name: '".$nombre."', y: ".$valor."},";
                        }
                        ?>]
                }]
            });
        </script>
        <!-- Grafico Torta 3 -->
        <!--
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta2', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cantidad de Actividades segun su tipo de Impacto Interno'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f}',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: []
                }]
            });
        </script>
        -->
        <!-- Grafico Torta 4 -->
        <!--
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta3', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cantidad de Actividades segun su tipo de Impacto Externo'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f}',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: []
                }]
            });
        </script>
        -->
        <!-- Grafico Torta 5 -->
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta4', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cantidad de Actividades segun el Producto otorgado'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f}',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [<?php
                        foreach($resumenGraficos->ActividadesxProducto as $nombre => $valor){
                            echo "{name: '".$nombre."', y: ".$valor."},";
                        }
                        ?>]
                }]
            });
        </script>
        <!-- Grafico Torta 6 -->
        <script>
            // Build the chart
            Highcharts.chart('graficaTorta5', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cantidad de Actividades dependiendo de su Estado actual'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.0f}',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [<?php
                        foreach($resumenGraficos->ActividadesxEstado as $nombre => $valor){
                            echo "{name: '".$nombre."', y: ".$valor."},";
                        }
                        ?>]
                }]
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>