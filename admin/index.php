<?php
include_once '../config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Administracion</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <style>
            body{
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
            <div class="col-md-12">
                <?php Menu::mostrarMenu() ?> 
            </div>  
    </body>
</html>


