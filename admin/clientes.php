<?php
include_once '../config.php';
include_once '../class/Cliente.php';
$do = $_REQUEST['do'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Encuestas</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/autosuggest_inquisitor.css">
        <script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/bsn.AutoSuggest_2.1.3.js"></script>
        <script type="text/javascript">
		        var options = {
		    			script: "actions_ajax.php?action=cerca_clients&",
		    			varname: "cadena",
		    			json: true,
		    			shownoresults: false,
		    			maxentries: 10,
		    			callback: function (obj) { document.getElementById('id_cliente').value = obj.id; }
		    		};
		    		$(document).ready(function(){
		    			var as = new bsn.AutoSuggest('cercador_nom', options);			
		    		});						 

    </script>
    <script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>

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
                <h3>Administracion de Clientes</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':
            	
               $datos   = array();
               	
               $datos[1] = Utils::filtraString($_REQUEST['nombre']);
               $datos[2] = Utils::filtraString($_REQUEST['responsable']);
               $datos[3] = Utils::filtraString($_REQUEST['email']);
               $datos[4] = Utils::filtraString($_REQUEST['telefono']);
               $datos[5] = Utils::filtraEntero($_REQUEST['pais']);
               $datos[6] = Utils::filtraString($_REQUEST['direccion']);
               $datos[7] = Utils::filtraString($_REQUEST['cp']);
               $datos[8] = Utils::filtraString($_REQUEST['poblacion']);

               Cliente::insertarCliente($datos);

               echo "<script type=\"text/javascript\">alert(\"Cliente Guardado Correctamente\");</script>";
               echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";

                break;

            case 'add':

            	$html = '';
                $html = '<div class="row">
               		<div class="col-md-4">
               		</div>
               		<div class="col-md-4 well bs-component">
	               		<form action="clientes.php?do=save" method="POST">
               				 <div class="alert alert-success" role="alert">Informacion Basica</div>
                        	 <label>Nombre cliente: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Cliente" name="nombre"><br />
                             <label>Persona Responsable: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Responsable" name="responsable"><br />
                              <div class="alert alert-success" role="alert">Informacion de Contacto</div>
                             <label>Correo Electronico: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Email" name="email"><br />
                             <label>Telefono: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Telefono" name="telefono"><br />
                             <div class="alert alert-success" role="alert">Informacion de Localizacion</div>
            				<label>Pais: </label>
            				<select name="pais" class="form-control input-sm">
            					<option value="0">---</option>';
	                			$paises = Utils::listadoPaises();
	                			foreach ($paises as $p){
	                				$html.='<option value='.$p['id'].'>'.utf8_encode($p['nombre']).'</option>';
	                			}
                           $html .='</select><br />
                             <label>Poblacion: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Poblacion" name="poblacion"><br />
                             <label>Codigo Postal: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="cp" name="cp"><br />
                             <label>Direccion: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Direccion" name="direccion"><br />
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
                $id = Utils::filtraString($id);
                Cliente::eliminarCliente($id);

                echo "<script type=\"text/javascript\">alert(\"Cliente eliminado correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";

                break;
            
            case 'mod':
                
            	$id   = Utils::filtraString($_REQUEST['id']);
            	$info = Cliente::obtenerCliente($id);
            	  
            	$html = '';
            	$html = '<div class="row">
               		<div class="col-md-4">
               		</div>
               		<div class="col-md-4 well bs-component">
	               		<form action="clientes.php?do=update" method="POST">
               				 <div class="alert alert-success" role="alert">Informacion Basica</div>
                        	 <label>Nombre cliente: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Cliente" name="nombre" value="'.$info[0]['v_nombre'].'"><br />
                             <label>Persona Responsable: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Responsable" name="responsable" value="'.$info[0]['v_responsable'].'"><br />
                              <div class="alert alert-success" role="alert">Informacion de Contacto</div>
                             <label>Correo Electronico: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Email" name="email" value="'.$info[0]['v_email'].'"><br />
                             <label>Telefono: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Telefono" name="telefono" value="'.$info[0]['v_telefono'].'"><br />
                             <div class="alert alert-success" role="alert">Informacion de Localizacion</div>
            				<label>Pais: </label>
            				<select name="pais" class="form-control input-sm">
            					<option value="0">---</option>';
				            	$paises = Utils::listadoPaises();
				            	foreach ($paises as $p){
				            		$selected = ( $p['id'] == $info[0]['i_pais'] ) ? 'selected' : '';
				            		$html.='<option value='.$p['id'].' '.$selected.'>'.utf8_encode($p['nombre']).'</option>';
				            	}
				            	$html .='</select><br />
                             <label>Poblacion: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Poblacion" name="poblacion" value="'.$info[0]['v_poblacion'].'"><br />
                             <label>Codigo Postal: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="cp" name="cp" value="'.$info[0]['v_cp'].'"><br />
                             <label>Direccion: </label>
                             <input type="text" class="form-control input-sm" id="inputEmail" placeholder="Direccion" name="direccion" value="'.$info[0]['v_direccion'].'"><br />
                             <input type="submit" name="guardar" value="Modificar" class="btn btn-primary"><input type="hidden" value="'.$info[0]['id_cliente'].'" name="id_cliente">
                         </form>
               		</div>
               		<div class="col-md-4">
               		</div>
               </div>';
            	
            	echo $html;
            	
                break;
            
            case 'update':
                
            	$datos   = array();
            	
            	$datos[0] = Utils::filtraEntero($_REQUEST['id_cliente']);
            	$datos[1] = Utils::filtraString($_REQUEST['nombre']);
            	$datos[2] = Utils::filtraString($_REQUEST['responsable']);
            	$datos[3] = Utils::filtraString($_REQUEST['email']);
            	$datos[4] = Utils::filtraString($_REQUEST['telefono']);
            	$datos[5] = Utils::filtraEntero($_REQUEST['pais']);
            	$datos[6] = Utils::filtraString($_REQUEST['direccion']);
            	$datos[7] = Utils::filtraString($_REQUEST['cp']);
            	$datos[8] = Utils::filtraString($_REQUEST['poblacion']);
            	
            	Cliente::modificarCliente($datos);
     
                echo "<script type=\"text/javascript\">alert(\"Cliente modificado correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";
                
                break;
                
           case 'info':
           	
            	break;
            
            default :

                $html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="clientes.php?do=add" class="btn btn-success">Añadir</a>
                                </div>
                            </div>';
                
     
               	$html.='<div class="row">
                                 <div class="col-md-2">
                                 </div>                   		
                                <div class="col-md-10">
                                   <nav>
									  <ul class="pagination">
                                        <li><a href="clientes.php?letra=all">Todos</a></li><span>&nbsp</span>';
									   for ($i='A';$i!='AA';$i++){
									   	$activa = ($i == $_REQUEST['letra']) ? 'active' : '';
									   	$html .= '<li class="'.$activa.'"><a href="clientes.php?letra='.$i.'">'.$i.'</a></li><span>&nbsp</span>';
									   }
				$html.='				</ul>
									</nav>
                                </div>
                				
                            </div>';
				
				$html .= '<div class="row">
                                <div class="col-md-4">
                                   
            					</div>
                				<div class="col-md-2">
            						<form action="" method="POST">
	                                    <label>Buscador: </label>
	                					<input name="cercador_nom" type="text" size="50" id="cercador_nom" autocomplete="off" class="form-control input-sm">
	            			 			<input type="hidden" class="form-control input-sm" placeholder="cliente" name="id_cliente" id="id_cliente" autocomplete="off"><br />
	            						<button type="submit" class="btn btn-primary btn-sm pull-right" value="Buscar">
            								<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span>&nbsp</span>Buscar
            							</button>
            						</form>
            					</div>
                				<div class="col-md-4">
            					</div>
                            </div>';
				
				if ( $_REQUEST['id_cliente'] ){
					$sql      = 'SELECT id_cliente,v_nombre,v_responsable FROM clientes WHERE id_cliente='.Utils::filtraEntero($_REQUEST['id_cliente']);
					$clientes = GestorBD::tirarSQL($sql);
				}else{
					$letra    = (isset($_REQUEST['letra'])) ? $_REQUEST['letra'] : 'all';
					$clientes = Cliente::listadoCliente(Utils::filtraString($letra));
				}
				

				$html .= '<div class="row">
                                <div class="col-md-2">
                                </div>
                				 <div class="col-md-6">';
									if( count($clientes)>0 ){
										$html .='<table class="table table-striped">
                                        <thead>
                                            <tr><th>ID</th><th>Nombre</th><th>Contacto</th><th>Operaciones</th></tr>
                                        </thead>
                                        <tbody>';
                                            foreach ( $clientes as $c ) {
                                                $html.='<tr>
                                                            <td class="info" width="10%">'.$c['id_cliente'].'</td>
                                                            <td>'.$c['v_nombre'].'</td>
									   						 <td>'.$c['v_responsable'].'</td>
                                                            <td width="10%">
                                                                <a href="clientes.php?do=del&id='.$c['id_cliente'].'" data-toggle="tooltip" data-placement="top" data-original-title="Borrar"><img src="../img/ico/delete.gif"></a><span>&nbsp</span>
                                                                <a href="clientes.php?do=mod&id='.$c['id_cliente'].'" data-toggle="tooltip" data-placement="top" data-original-title="Modificar"><img src="../img/ico/edit.gif"></a>
                                								<a href="clientes.php?do=send&id='.$c['id_cliente'].'"data-toggle="tooltip" data-placement="top" data-original-title="Enviar Email"><img src="../img/ico/email.gif"><span>&nbsp</span>
									   							<a href="clientes.php?do=info&id='.$c['id_cliente'].'"data-toggle="tooltip" data-placement="top" data-original-title="Info"><img src="../img/ico/info.gif"></a><span>&nbsp</span>
                                                            </td>
                                                        </tr>';
                                            }
                                        $html .= '</tbody></table>';
									}else{
										$html .='<div class="alert alert-info" role="alert">No hay registros</div>';
									}
 
                   $html.='  </div>
                         </div>';

                echo $html;
                break;
        }
        ?>

    </body>
</html>


