<?php
include_once '../../config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Configuracion</title>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../../js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        <style>
            body{
               
                margin-top: 15px;
                margin-left: 15px;
                margin-right: 15px;
            
            }
        </style>
    </head>
    <body>
       
            <div class="row">
                <div class="col-md-12">
                    <?php Menu::mostrarMenu() ?> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><a href="../index.php" class="btn btn-link">Volver A Administración</a> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3>Configuraciones</h3><hr />
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <a href="../config/mascotas.php" class="btn btn-default btn-lg btn-block" style="cursor: pointer;">Mascotas</a>
                </div>
                <div class="col-md-3">
                    <a href="../config/formas_contacto.php" class="btn btn-default btn-lg btn-block">Formas de Contacto</a>
                </div>
                <div class="col-md-3">
                    <a href="../config/horarios_contacto.php" class="btn btn-default btn-lg btn-block">Horarios de Contacto</a>
                </div>
                 <div class="col-md-3">
                    <a href="../config/profesiones.php"" class="btn btn-default btn-lg btn-block">Professiones</a>
                </div>
            </div>
             <div class="row">
                 <hr>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="../config/escala.php" class="btn btn-default btn-lg btn-block" style="cursor: pointer;">Escalas Numericas</a>
                </div>
            </div>

    </body>
</html>

