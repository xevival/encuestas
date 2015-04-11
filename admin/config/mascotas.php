<?php
include_once '../../config.php';
include_once '../../class/Mascotas.php';
$do = $_REQUEST['do'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Encuestas</title>
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
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><a href="index.php" class="btn btn-link">Volver a configuraciones</a> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Administracion de Mascotas</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':

                $datos = array();
                $mascota = $_REQUEST['nombre'];
                $mascota = strtolower($mascota);
                $mascota = ucfirst($mascota);
                
                $mascota = filter_var($mascota,FILTER_SANITIZE_STRING);

                $datos[1] = $mascota;

                Mascotas::insertarMacosta($datos);

                echo "<script type=\"text/javascript\">alert(\"Mascota guardada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"mascotas.php\";</script>";

                break;

            case 'add':

                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="mascotas.php?do=save" method="POST">
                                        <label>Nombre Mascota: </label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Mascota" name="nombre"><br />
                                        <input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>';
                echo $html;

                break;
            
            case 'del':
                
                $id = $_REQUEST['id'];
                $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
                Mascotas::eliminarMascota($id);

                echo "<script type=\"text/javascript\">alert(\"Mascota eliminada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"mascotas.php\";</script>";

                break;
            
            case 'mod':
                
                $id   = filter_var($_REQUEST['id'],FILTER_SANITIZE_NUMBER_INT);
                $info = Mascotas::obtenerMascota($id);
                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="mascotas.php?do=update" method="POST">
                                        <label>Nombre Mascota: </label>
                                        <input type="text" class="form-control" id="inputEmail" name="nombre" value="'.$info[0]['v_nombre'].'"><br />
                                        <input type="hidden" name="id" value="'.$info[0]['id_mascota'].'">
                                        <input type="submit" name="modificar" value="Modificar" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>';
                echo $html;
                break;
            
            case 'update':
                
                $id      = filter_var($_REQUEST['id'],FILTER_SANITIZE_NUMBER_INT);
                $nombre  = filter_var($_REQUEST['nombre'],FILTER_SANITIZE_STRING);
                
                Mascotas::modificarMascota($id, $nombre);
 
                echo "<script type=\"text/javascript\">alert(\"Mascota modificada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"mascotas.php\";</script>";
                
                break;
            
            default :

                $mascota = Mascotas::listadoMascotas();

                $html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="mascotas.php?do=add" class="btn btn-success">Añadir</a>
                                </div>
                            </div>';

                $html .= '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr><th>ID</th><th>Nombre</th><th>Operaciones</th></tr>
                                        </thead>
                                        <tbody>';

                                            foreach ($mascota as $m) {
                                                $html.='<tr>
                                                            <td class="info" width="10%">'.$m['id_mascota'].'</td>
                                                            <td>'.$m['v_nombre'].'</td>
                                                            <td width="10%">
                                                                <a href="mascotas.php?do=del&id='.$m['id_mascota'].'"><span class="glyphicon glyphicon-remove"></span></a><span>&nbsp</span>
                                                                <a href="mascotas.php?do=mod&id='.$m['id_mascota'].'"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            </td>
                                                        </tr>';
                                            }
                                        $html .= '</tbody></table>';

                $html.='</div>
                                <div class="col-md-4">
                                </div>
                            </div>';

                echo $html;

                break;
        }
        ?>

    </body>
</html>


