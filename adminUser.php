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
                            <tr onclick="selection(this,1)">
                                <td>
                                    <input type="checkbox" name="check[]" value="1" id="chk1">
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
                            <tr onclick="selection(this,2)">
                                <td>
                                    <input type="checkbox" name="check[]" value="2" id="chk2">      
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
                            <tr onclick="selection(this,3)">
                                <td>
                                    <input type="checkbox" name="check[]" value="3" id="chk3">
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
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
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="check[]" value="1" id="chk1">1
                                        </label>
                                    </div>
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="check[]" value="2" id="chk2">2
                                        </label>
                                    </div>
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="check[]" value="3" id="chk3">3
                                        </label>
                                    </div>
                                </td>
                                <td>198640913</td>
                                <td>Nicolas Sepulveda Valdivia</td>
                                <td>nicolas.sepulveda@alumnos.ucn.cl</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Solicitudes de ingreso</h3>
                    <input type="submit" value="Agregar" id="add">
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
                    if($("#chk"+value).is("checked") == "checked"){                      
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>