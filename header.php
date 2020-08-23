<header>
    <div class="contenedor">
        <img class="logo" src="static/images/logo.png" alt="">
        <h2 class="title">Vinculación con el medio FACMED</h2>
        
        <input type = "checkbox" id = "btn-menu">
        <label class = "icon-menu" for="btn-menu"></label>
        
        <nav class="menu">
            <ul>
                <?php
                    if(!isset($_SESSION['user_id'])){
                        echo '  <li><a href="#calendario">Calendario</a></li>
                                <li><a href="#informacion">Información</a></li>
                                <li><a href="#graficos">Graficos</a></li>
                                <li><a href="/login.php">Iniciar Sesión</a></li>';
                    }
                    else if($_SESSION['user_admin_status']=='S'){
                        echo '<li><a href="/dashboard.php">Todas las actividades</a></li>
                            <li><a href="/adminUser.php">Administración de usuarios</a></li>
                            <li><a href="/includes/logout.inc.php">Cerrar Sesión</a></li>';
                    }else{
                        echo '<li><a href="/dashboard.php">Mis Actividades</a></li>
                            <li><a href="/includes/logout.inc.php">Cerrar Sesión</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>