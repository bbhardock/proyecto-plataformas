<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
        exit();
    }
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <title>Vinculación con el medio</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="static/css/fontello.css?v1.6"/>
        <link rel="stylesheet" href="static/css/styleIndex.css?v1.22"/>
        <link rel="stylesheet" href="https://use.typekit.net/jyw0mhj.css">

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
                            {
                                title: 'Actividad 1, Junta con hospital de coquimbo',
                                start: '2020-08-19',
                                end: '2020-08-23',
                                extendedProps: {
                                    unidad: 'FAMED',
                                    areaVinculacion: 'Salud Publica',
                                    lugar: 'Hospital de coquimbo',
                                    fechaInicio: '19-08-2020',
                                    fechaTermino: '23-08-2020'
                                }
                            },
                            {
                                title: 'Actividad 2, Junta con Clinica del Elqui',
                                start: '2020-08-21',
                                end: '2020-08-26',
                                extendedProps: {
                                    unidad: 'FAMED',
                                    areaVinculacion: 'Salud Privada',
                                    lugar: 'Clinica de la serena',
                                    fechaInicio: '24-08-2020',
                                    fechaTermino: '26-08-2020'
                                }
                            }
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
        <section class="main">
            <div class="container">
                <section id="calendario">
                    <div class="row">
                        <div class="col Title-Index">
                            <div class="container">
                                <h1>VINCULACION CON EL MEDIO FAMED COQUIMBO</h1>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </section>
                <section  id="informacion">
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="border">
                                <div class="Title-SubtitleBlue">
                                    <div class="container blue">
                                        <h5>Resumen de Actividades</h5>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                                <div class="info-resumen">
                                    <div class="animadoDer containerBig container blue">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="titulo">
                                                    <h4>Nuestros beneficiarios</h4>
                                                    <h5>Han participado con nosotros son en total</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <h2>200</h2>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="fondoUnidad">
                                                    <h5>"Unidad vinculada"</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="info-resumen ">
                                <div class="animadoIzq containerBig container brown">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen">
                                <div class="animadoDer containerSmall container bluelight">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen ">
                                <div class="animadoDer containerSmall container browndark">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen ">
                                <div class="animadoIzq containerSmall container yellow">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-5">
                                <div class="info-resumen">
                                    <div class="animadoDer containerBig container purple">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="titulo">
                                                    <h4>Nuestros beneficiarios</h4>
                                                    <h5>Han participado con nosotros son en total</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <h2>200</h2>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="fondoUnidad">
                                                    <h5>"Unidad vinculada"</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12 col-lg-7">
                            <div class="info-resumen ">
                                <div class="animadoIzq containerBig container brown">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                                <div class="info-resumen">
                                    <div class="animadoDer containerBig container bluelight">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="titulo">
                                                    <h4>Nuestros beneficiarios</h4>
                                                    <h5>Han participado con nosotros son en total</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <h2>200</h2>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="fondoUnidad">
                                                    <h5>"Unidad vinculada"</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="info-resumen ">
                                <div class="animadoIzq containerBig container yellow">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen">
                                <div class="animadoDer containerSmall container purple">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen ">
                                <div class="animadoDer containerSmall container browndark">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="info-resumen ">
                                <div class="animadoIzq containerSmall container bluelight">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="titulo">
                                                <h4>Nuestros beneficiarios</h4>
                                                <h5>Han participado con nosotros son en total</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <h2>135</h2>
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <div class="fondoUnidad">
                                                <h5>"Unidad vinculada"</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="animadoDer graficos">
                                <div class="container">
                                    <div class="titulo">
                                        <h6>Actividades Publicas</h6>
                                    </div>
                                    <div class="torta">
                                        <figure class="highcarts-figure">
                                            <div id='graficaTorta'></div>
                                        </figure>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="animadoIzq graficos">
                            <div class="container">
                                    <div class="titulo">
                                        <h6>Actividades Privadas</h6>
                                    </div>
                                    <div class="torta">
                                        <figure class="highcarts-figure">
                                            <div id='graficaTorta1'></div>
                                        </figure>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="graficos">
                            <div class="container">
                                    <div class="titulo">
                                        <h6>Beneficiarios</h6>
                                    </div>
                                    <div class="torta">
                                        <figure class="highcarts-figure">
                                            <div id='graficaTorta2'></div>
                                        </figure>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="graficos">
                                <div class="container">
                                    <div class="titulo">
                                        <h6>Area de Vinculacion</h6>
                                    </div>
                                    <div class="torta">
                                        <figure class="highcarts-figure">
                                            <div id='graficaTorta3'></div>
                                        </figure>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script>
            let animadoDer = document.querySelectorAll(".animadoDer");
            let animadoIzq = document.querySelectorAll(".animadoIzq");

            function mostrarScroll() {
                let scrollTop = document.documentElement.scrollTop;
                for (var i = 0; i < animadoDer.length; i++){
                    let alturaAnimado = animadoDer[i].offsetTop;
                    if(alturaAnimado -1000< scrollTop){
                        animadoDer[i].style.opacity = 1;
                        animadoDer[i].classList.add("mostrarDerecha");
                    }
                }
                for (var i = 0; i < animadoIzq.length; i++){
                    let alturaAnimado = animadoIzq[i].offsetTop;
                    if(alturaAnimado -1000 < scrollTop){
                        animadoIzq[i].style.opacity = 1;
                        animadoIzq[i].classList.add("mostrarIzquierda");
                    }
                }      
            }
            window.addEventListener('scroll', mostrarScroll);
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
                    text: 'Actividades de caracter publico en 2020'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [
                        { name: 'Chrome', y: 61.41 },
                        { name: 'Internet Explorer', y: 11.84 },
                        { name: 'Firefox', y: 10.85 },
                        { name: 'Edge', y: 4.67 },
                        { name: 'Safari', y: 4.18 },
                        { name: 'Other', y: 7.05 }
                    ]
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
                    text: 'Actividades de caracter privado en 2020'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [
                        { name: 'Chrome', y: 61.41 },
                        { name: 'Internet Explorer', y: 11.84 },
                        { name: 'Firefox', y: 10.85 },
                        { name: 'Edge', y: 4.67 },
                        { name: 'Safari', y: 4.18 },
                        { name: 'Other', y: 7.05 }
                    ]
                }]
            });
        </script>
        <!-- Grafico Torta 3 -->
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
                    text: 'Cantidad y tipos de beneficiarios, 2020'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [
                        { name: 'Chrome', y: 61.41 },
                        { name: 'Internet Explorer', y: 11.84 },
                        { name: 'Firefox', y: 10.85 },
                        { name: 'Edge', y: 4.67 },
                        { name: 'Safari', y: 4.18 },
                        { name: 'Other', y: 7.05 }
                    ]
                }]
            });
        </script>
        <!-- Grafico Torta 4 -->
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
                    text: 'Distintas Areas de Vinculacion trabajadas, 2020'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Share',
                    data: [
                        { name: 'Chrome', y: 61.41 },
                        { name: 'Internet Explorer', y: 11.84 },
                        { name: 'Firefox', y: 10.85 },
                        { name: 'Edge', y: 4.67 }
                    ]
                }]
            });
        </script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>