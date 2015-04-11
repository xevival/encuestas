<?php
include_once '../../config.php';
include_once '../../class/Profesion.php';
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
                <h3>Administracion de Professiones</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':

                $datos = array();
                $profesion = $_REQUEST['nombre'];
                $profesion = strtolower($profesion);
                $profesion = ucfirst($profesion);
                
                $profesion = filter_var($profesion,FILTER_SANITIZE_STRING);

                $datos[1] = $profesion;

               Profesion::insertarProfesion($datos);

                echo "<script type=\"text/javascript\">alert(\"Profesion guardada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"profesiones.php\";</script>";

                break;

            case 'add':

                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="profesiones.php?do=save" method="POST">
                                        <label>Nombre Profesion: </label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Profesion" name="nombre"><br />
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
               	Profesion::eliminarProfesion($id);

                echo "<script type=\"text/javascript\">alert(\"Profesion eliminada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"profesiones.php\";</script>";

                break;
            
            case 'mod':
                
                $id   = filter_var($_REQUEST['id'],FILTER_SANITIZE_NUMBER_INT);
                $info = Profesion::obtenerProfesion($id);
                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="profesiones.php?do=update" method="POST">
                                        <label>Nombre Profesion: </label>
                                        <input type="text" class="form-control" id="inputEmail" name="nombre" value="'.$info[0]['v_profesion'].'"><br />
                                        <input type="hidden" name="id" value="'.$info[0]['id_profesion'].'">
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
                
               	Profesion::modificarProfesion($id, $nombre);
 
                echo "<script type=\"text/javascript\">alert(\"Profesion modificada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"profesiones.php\";</script>";
                
                break;
            
            default :

                $professiones = Profesion::listadoProfesion();

                $html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="profesiones.php?do=add" class="btn btn-success">Añadir</a>
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

                                            foreach ($professiones as $p) {
                                                $html.='<tr>
                                                            <td class="info" width="10%">'.$p['id_profesion'].'</td>
                                                            <td>'.$p['v_profesion'].'</td>
                                                            <td width="10%">
                                                                <a href="profesiones.php?do=del&id='.$p['id_profesion'].'"><span class="glyphicon glyphicon-remove"></span></a><span>&nbsp</span>
                                                                <a href="profesiones.php?do=mod&id='.$p['id_profesion'].'"><span class="glyphicon glyphicon-pencil"></span></a>
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


