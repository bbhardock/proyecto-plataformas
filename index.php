<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
        exit();
    }
    require "header.php";
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <title>Vinculación con el medio</title>
        <meta name="viewport" content="width = device-width, user-scalable = no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/fontello.css?v1.6">
        <link rel="stylesheet" href="static/css/Styles.css?v3.5">
    </head>
    <body>
        <section class="main">
            <div class="container">
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