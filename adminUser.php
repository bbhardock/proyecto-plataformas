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
<html lang = "es">
    <head>
        <meta charset="utf-8" />
        <title>Manejo de Usuarios</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css">
        <link rel="stylesheet" href="static/css/Styles.css?v2.0">
    </head>
    <body>
        <section class="main">
            <div class="containerTitle">
                <div class="container row col-md-12">
                    <h2>Administración de usuarios</h2>
                </div>
            </div>
            <div class="container col-md-12 row">
                <div class="col-sm-12 col-md-6">
                    <div class="container">
                        <h3>Usuarios admitidos</h3>
                    </div>
                    <form method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered tableA">
                                <thead>
                                    <th>ID</th>
                                    <th>RUT</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Es Admin</th>
                                </thead>
                                <tbody style="cursor:pointer">
                                    <?php
                                        $indice = 1;
                                        $json_decoded = json_decode(obtenerUsuariosPermitidos());
                                        foreach($json_decoded as $result){
                                            echo'<tr onclick="selection(this,'.$result->id_code.')">
                                                <td>
                                                    <input type="checkbox" class="hidden" name="check[]" value="'.$result->id_code.'" id="chk'.$result->id_code.'">'.$indice.'
                                                </td>
                                                <td>'.$result->rut.'</td>
                                                <td>'.$result->nombre.'</td>
                                                <td>'.$result->correo_electronico.'</td>
                                                </tr>';
                                                $indice++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>        
                        <input type="submit" class ="btn btn-primary" value="Hacer Admin" name="btn-admin">
                        <input type="submit" class ="btn btn-primary" value="Quitar Admin" name="btn-no-admin">
                        <input type="submit" class ="btn btn-danger" value="Eliminar" name="btn-pop">       
                    </form>      
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="container">
                        <h3>Solicitudes de ingreso</h3>
                    </div>
                    <form method="post">
                        <div class="table-responsive ">
                            <table class="table table-bordered tableP">
                                <thead>
                                    <th>ID</th>
                                    <th>RUT</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                </thead>
                                <tbody style="cursor:pointer">
                                    <?php
                                        $indice = 1;
                                        $json_decoded = json_decode(obtenerUsuariosPendientes());
                                        foreach($json_decoded as $result){
                                            echo'<tr onclick="selectionP(this,'.$result->id_code.')">
                                                <td>
                                                    <input type="checkbox" class="hidden" name="checkP[]" value="'.$result->id_code.'" id="chkP'.$result->id_code.'">'.$indice.'
                                                </td>
                                                <td>'.$result->rut.'</td>
                                                <td>'.$result->nombre.'</td>
                                                <td>'.$result->correo_electronico.'</td>
                                                </tr>';
                                                $indice++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="submit" class ="btn btn-success" value="Permitir acceso" name="btn-access">
                        <input type="submit" class ="btn btn-danger" value="No permitir" name="btn-denied">        
                    </form>                        
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
                        $("#chk"+value).prop("checked",false);
                        $(tr).css("background-color","#FFFFFF");
                    }
                    else{
                        $("#chk"+value).attr("checked",true);
                        $("#chk"+value).prop("checked",true);
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
                        $("#chkP"+value).prop('checked',false);
                        $(tr).css("background-color","#FFFFFF");
                    }
                    else{
                        $("#chkP"+value).attr("checked",true);
                        $("#chkP"+value).prop("checked",true);
                        $(tr).css("background-color","#BEDAE8");
                    }
                })
            }
        </script>
        <?php
        if(isset($_POST['btn-access'])){
            if(isset($_POST['checkP'])){
                foreach($_POST['checkP'] as $valor){
                    permitirAccesoUsuario($valor);
                }
                //refresca la pagina usando html
                $secondsWait = 0;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
            }
        }
        if(isset($_POST['btn-denied'])){
            if(isset($_POST['checkP'])){
                foreach($_POST['checkP'] as $valor){
                    denegarAccesoUsuario($valor);
                }
                $secondsWait = 0;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
            }
        }
        if(isset($_POST['btn-admin'])){
            if(isset($_POST['check'])){
                foreach($_POST['check'] as $valor){
                    hacerAdminUsuarioPermitido($valor);
                }
                $secondsWait = 0;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
            }
        }
        if(isset($_POST['btn-no-admin'])){
            if(isset($_POST['check'])){
                foreach($_POST['check'] as $valor){
                    deshacerAdminUsuarioPermitido($valor);
                }
                $secondsWait = 0;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
            }
        }
        if(isset($_POST['btn-pop'])){
            if(isset($_POST['check'])){
                foreach($_POST['check'] as $valor){
                    denegarAccesoUsuario($valor);
                }
                $secondsWait = 0;
                echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
            }
        }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    </body>
</html>