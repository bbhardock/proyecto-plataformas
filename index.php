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
        <link rel="stylesheet" href="static/css/Styles.css?v4.4"/>

        <link href='static/fullcalendar/core/main.css' rel='stylesheet' />
        <link href='static/fullcalendar/daygrid/main.css' rel='stylesheet' />

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script src='static/fullcalendar/core/main.js'></script>
        <script src='static/fullcalendar/core/locales/es.js'></script>
        <script src='static/fullcalendar/daygrid/main.js'></script>
        <script src='static/fullcalendar/moment/main.js'></script>
        
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
                <div class="row">
                    <div class="col-lg-12 Title-Subtitle">
                        <div class="container">
                            <h2>Resumen de Actividades de manera Grafica</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="graficos">
                            <div class="container">
                                <figure class="highcarts-figure">
                                    <div id='graficaTorta'></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="graficos">
                            <div class="container">
                                <figure class="highcarts-figure">
                                    <div id='graficaTorta1'></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require 'footer.php';
        ?>
        <script>
            Highcharts.chart('graficaTorta', {

            title: {
                text: 'Solar Employment Growth by Sector, 2010-2016'
            },

            subtitle: {
                text: 'Source: thesolarfoundation.com'
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Range: 2010 to 2017'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2010
                }
            },

            series: [{
                name: 'Installation',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            }, {
                name: 'Manufacturing',
                data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
            }, {
                name: 'Sales & Distribution',
                data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
            }, {
                name: 'Project Development',
                data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
            }, {
                name: 'Other',
                data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

            });
        </script>
        <script>
            Highcharts.chart('graficaTorta1', {

            title: {
                text: 'Solar Employment Growth by Sector, 2010-2016'
            },

            subtitle: {
                text: 'Source: thesolarfoundation.com'
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Range: 2010 to 2017'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2010
                }
            },

            series: [{
                name: 'Installation',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            }, {
                name: 'Manufacturing',
                data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
            }, {
                name: 'Sales & Distribution',
                data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
            }, {
                name: 'Project Development',
                data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
            }, {
                name: 'Other',
                data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>