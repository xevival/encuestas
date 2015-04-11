<?php
include_once '../../config.php';
include_once '../../class/Escala.php';
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
                <h3>Administracion de Escala de Valores</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':

                $datos    = array();
                
                $datos[1] = Utils::filtraString($_REQUEST['nombre']);
                $datos[2] = Utils::filtraEntero($_REQUEST['max']);
                $datos[3] = Utils::filtraEntero($_REQUEST['min']);
                
               	Escala::insertarEscala($datos);

                echo "<script type=\"text/javascript\">alert(\"Escala de valores gurdada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"escala.php\";</script>";

                break;

            case 'add':

                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="escala.php?do=save" method="POST">
                                        <label>Nombre Escala: </label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Nombre" name="nombre"><br />
                						<label>Valor Maximo</label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Maximo" name="max"><br />
                						<label>Valor Minimo</label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Minimo" name="min"><br />
                                        <input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>';
                echo $html;

                break;
            
            case 'del':
                
                $id = Utils::filtraEntero($_REQUEST['id']);

                Escala::eliminarEscala($id);

                echo "<script type=\"text/javascript\">alert(\"Escala de valores eliminada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"escala.php\";</script>";

                break;
            
            case 'mod':
                
                $info = Escala::obtenerEscala(Utils::filtraEntero($_REQUEST['id']));
               
                $html = '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4 well bs-component">
                                    <form action="escala.php?do=update" method="POST">
                                        <label>Nombre Escala: </label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Nombre" name="nombre" value='.$info[0]['v_nombre'].'><br />
                						<label>Valor Maximo</label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Maximo" name="max" value='.$info[0]['i_max'].'><br />
                						<label>Valor Minimo</label>
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Minimo" name="min" value='.$info[0]['i_min'].'><br />
                						 <input type="hidden" class="form-control" id="inputEmail"  name="id_tipo_escala" value='.$info[0]['id_tipo_escala'].'><br />
                                        <input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>';
                echo $html;

                break;
            
            case 'update':
                
               $datos   = array();
            	
            	$datos[0] = Utils::filtraEntero($_REQUEST['id_tipo_escala']);
            	$datos[1] = Utils::filtraString($_REQUEST['nombre']);
            	$datos[2] = Utils::filtraEntero($_REQUEST['max']);
            	$datos[3] = Utils::filtraEntero($_REQUEST['min']);
                
               Escala::modificarEscala($datos);
 
                echo "<script type=\"text/javascript\">alert(\"Escala de vaores modificada correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"escala.php\";</script>";
                
                break;
            
            default :

                $escalas = Escala::listadoEscala();

                $html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="escala.php?do=add" class="btn btn-success">Añadir</a>
                                </div>
                            </div>';

                $html .= '<div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr><th>ID</th><th>Nombre Escala</th><th>Valor Max</th><th>Valor Min</th><th>Operaciones</th></tr>
                                        </thead>
                                        <tbody>';

                                            foreach ($escalas as $e) {
                                                $html.='<tr>
                                                            <td class="info" width="10%">'.$e['id_tipo_escala'].'</td>
                                                            <td>'.$e['v_nombre'].'</td>
            												<td>'.$e['i_max'].'</td>
                											<td>'.$e['i_min'].'</td>
                                                             <td width="10%">
                                                                <a href="escala.php?do=del&id='.$e['id_tipo_escala'].'" data-toggle="tooltip" data-placement="top" data-original-title="Borrar"><img src="../../img/ico/delete.gif"></a><span>&nbsp</span>
                                                                <a href="escala.php?do=mod&id='.$e['id_tipo_escala'].'" data-toggle="tooltip" data-placement="top" data-original-title="Modificar"><img src="../../img/ico/edit.gif"></a>
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


