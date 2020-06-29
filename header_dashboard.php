<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Sistema Vinculación Con el Medio</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css">
        <link rel="stylesheet" href="static/css/Styles.css">
    </head>
    <body>
        <header>
            <div class="contenedor">
                <img class="logo" src="static/images/logo.png" alt="">
                <h2 class="title">Vinculación con el medio</h2>

                <input type = "checkbox" id = "btn-menu">
                <label class = "icon-menu" for="btn-menu"></label>
                
                <nav class="menu">
                    <ul>
                        <?php
                            if($_SESSION['user_admin_status']=='S'){
                                echo '<li><a href="/dashboard.php">Todas las actividades</a></li>';
                                echo '<li><a href="/adminUser.php">Administración de usuarios</a></li>';
                            }else{
                                echo '<li><a href="/dashboard.php">Mis Actividades</a></li>';
                            }
                        ?>
                        <li><a href="/includes/logout.inc.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </div>
        </header>
</html>