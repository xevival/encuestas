<?php
include_once '../../config.php';
include_once '../../class/Contacto.php';
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
                <h3>Administracion de Formas de Contacto</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':

                $datos   = array();
                $forma   = $_REQUEST['nombre'];
                $forma   = strtolower($forma);
                $forma   = ucfirst($forma);
                
                $forma   = filter_var($forma,FILTER_SANITIZE_STRING);

                $datos[1] = $forma;
                
                Contacto::insertarFormaContacto($datos);

                echo "<script type=\"text/javascript\">alert(\"Forma de contacto gurdada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"formas_contacto.php\";</script>";

                break;

            case 'add':

                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="formas_contacto.php?do=save" method="POST">
                                        <label>Nombre Mascota: </label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Forma" name="nombre"><br />
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
                Contacto::eliminarFormasContacto($id);

                echo "<script type=\"text/javascript\">alert(\"Forma de contacto eliminada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"formas_contacto.php\";</script>";

                break;
            
            case 'mod':
                
                $id   = filter_var($_REQUEST['id'],FILTER_SANITIZE_NUMBER_INT);
                $info = Contacto::obtenerFormasContacto($id);
                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="formas_contacto.php?do=update" method="POST">
                                        <label>Forma Contacto: </label>
                                        <input type="text" class="form-control" id="inputEmail" name="nombre" value="'.$info[0]['v_forma_contacto'].'"><br />
                                        <input type="hidden" name="id" value="'.$info[0]['id_forma_contacto'].'">
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
                
                Contacto::modificarFormasContacto($id, $nombre);
 
                echo "<script type=\"text/javascript\">alert(\"Forma de contacto modificada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"formas_contacto.php\";</script>";
                
                break;
            
            default :

                $formas = Contacto::listadoFormasContacto();

                $html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="formas_contacto.php?do=add" class="btn btn-success">Añadir</a>
                                </div>
                            </div>';

                $html .= '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr><th>ID</th><th>Forma Contacto</th><th>Operaciones</th></tr>
                                        </thead>
                                        <tbody>';

                                            foreach ($formas as $f) {
                                                $html.='<tr>
                                                            <td class="info" width="10%">'.$f['id_forma_contacto'].'</td>
                                                            <td>'.$f['v_forma_contacto'].'</td>
                                                            <td width="10%">
                                                                <a href="formas_contacto.php?do=del&id='.$f['id_forma_contacto'].'"><span class="glyphicon glyphicon-remove"></span></a><span>&nbsp</span>
                                                                <a href="formas_contacto.php?do=mod&id='.$f['id_forma_contacto'].'"><span class="glyphicon glyphicon-pencil"></span></a>
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


