<?php

include_once './config.php';
include_once './class/Login.php';


$do = $_REQUEST['do'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso a la Plataforma</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            switch ($do) {

                case 'doLogin':
                    break;
                default :
                    Login::mostrarFormulario();
                   
                    break;
            }
            ?>
        </div>
    </body>
