<?php
    require "session_check.php";
    require "header.php";
    if(!isset($_SESSION['user_id']) || $_SESSION['user_admin_status'] != 'S'){
        header("Location: dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Manejo de Usuarios</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css">
        <link rel="stylesheet" href="static/css/Styles.css?v1.3">
    </head>
    <body>
        <section class="main">
            <div class="containerTitle">
                <div class="container row col-md-12">
                    <h2>Administración de usuarios</h2>
                </div>
            </div>
            <div class="container col-md-12 row">
                <div class="table-responsive col-sm-12 col-md-6">
                    <table class="table tableA">
                        <thead>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </thead>
                        <tbody style="cursor:pointer">
                            <?php
                                require 'includes/queries.inc.php';
                                $json_decoded = json_decode(obtenerUsuariosPermitidos());
                                $indice = 1;
                                foreach($json_decoded as $result){
                                echo'<tr onclick="selection(this,'.$indice.')">
                                    <td>
                                        <input type="checkbox" name="check[]" value="'.$indice.'" id="chk'.$indice.'">
                                    </td>
                                    <td>'.$result->rut.'</td>
                                    <td>'.$result->nombre.'</td>
                                    <td>'.$result->correo_electronico.'</td>
                                    </tr>   ';
                                }
                                $indice = $indice+1;
                            ?>
                        </tbody>
                    </table>
                    <h3>Usuarios admitidos</h3>
                    <input type="submit" value="Agregar" id="add">
                    <input type="submit" value="Eliminar" id="pop">
                </div>
                <div class="table-responsive col-sm-12 col-md-6">
                    <table class="table table-bordered table-hover tableP">
                        <thead>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </thead>
                        <tbody style="cursor:pointer">
                            <?php
                                require 'includes/queries.inc.php';
                                $json_decoded = json_decode(obtenerUsuariosPendientes());
                                $indice = 1;
                                foreach($json_decoded as $result){
                                echo'<tr onclick="selection(this,'.$indice.')">
                                    <td>
                                        <input type="checkbox" name="check[]" value="'.$indice.'" id="chk'.$indice.'">
                                    </td>
                                    <td>'.$result->rut.'</td>
                                    <td>'.$result->nombre.'</td>
                                    <td>'.$result->correo_electronico.'</td>
                                    </tr>   ';
                                }
                                $indice = $indice+1;
                            ?>
                        </tbody>
                    </table>
                    <h3>Solicitudes de ingreso</h3>
                    <input type="submit" value="Agregar" name="addP" id="add">
                    <input type="submit" value="Eliminar" id="pop">
                </div>
            </div>
        </section>
        <footer class="footer">
            <img class="logo" src="static/images/logo.png" alt="">
        </footer>
        <script>
            function selection(tr,value){
                $(function(){
                    if($("#chk"+value).attr("checked") == "checked"){                      
                        $("#chk"+value).removeAttr("checked");
                        $(tr).css("background-color","#FFFFFF");
                    }
                    else{
                        $("#chk"+value).attr("checked","true");
                        $("#chk"+value).prop("checked","true");
                        $(tr).css("background-color","#BEDAE8");
                    }
                })
            }
        </script>
        <script>
            function selectionP(tr,value){
                $(function(){
                    if($("#chkP"+value).attr("checked") == "checked"){                      
                        $("#chkP"+value).removeAttr("checked");
                        $(tr).css("background-color","#FFFFFF");
                    }
                    else{
                        $("#chkP"+value).attr("checked","true");
                        $("#chkP"+value).prop("checked","true");
                        $(tr).css("background-color","#BEDAE8");
                    }
                })
            }
        </script>
        <script>
            if(isset($_REQUEST["addP"])){
                $checkes = $_REQUEST["checkP"];
                echo checkes[2];
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>