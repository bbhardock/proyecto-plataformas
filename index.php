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
        <link rel="stylesheet" href="static/css/Styles.css?v3.10"/>
        <link href='static/fullcalendar/core/main.css' rel='stylesheet' />
        <link href='static/fullcalendar/daygrid/main.css' rel='stylesheet' />

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
                    events:[
                        {
                            title: 'Actividad 1, Junta con hospital de coquimbo',
                            start: '2020-08-19',
                            end: '2020-08-23'
                        },
                        {
                            title: 'Actividad 1, Junta con hospital de coquimbo',
                            start: '2020-08-24',
                            end: '2020-08-26'
                        }
                    ],
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
                <div class="col"></div>
                <div class="col-5">
                    <div id='calendar'></div>
                </div>
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