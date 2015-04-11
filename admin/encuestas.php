
<?php
include_once '../config.php';
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
                <h3>Administracion de Encuestas</h3><hr />
            </div>
        </div>

        <?php
        switch ($do) {

            case 'save':
            	
               $datos   = array();


               echo "<script type=\"text/javascript\">alert(\"Cliente Guardado Correctamente\");</script>";
               echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";

                break;

            case 'add':

            	$html = '';
                
               
               echo $html;

                break;
            
            case 'del':
               

                echo "<script type=\"text/javascript\">alert(\"Cliente eliminado correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";

                break;
            
            case 'mod':
                
            	
            	
                break;
            
            case 'update':
                
            	$datos   = array();

                echo "<script type=\"text/javascript\">alert(\"Cliente modificado correctamente\");</script>";
                echo "<script type=\"text/javascript\">location.href=\"clientes.php\";</script>";
                
                break;
                
           case 'info':
           	
            	break;
            	
            	
            default :
            	
            	$html = '<div class="row">
                                <div class="col-md-12">
                                    <a href="encuestas.php?do=add" class="btn btn-success">Añadir</a>
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
            		$html .= '<li class="'.$activa.'"><a href="encuestas.php?letra='.$i.'">'.$i.'</a></li><span>&nbsp</span>';
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
	            			 			<input type="hidden" class="form-control input-sm" placeholder="encuesta" name="id_encuesta" id="id_encuesta" autocomplete="off"><br />
	            						<button type="submit" class="btn btn-primary btn-sm pull-right" value="Buscar">
            								<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span>&nbsp</span>Buscar
            							</button>
            						</form>
            					</div>
                				<div class="col-md-4">
            					</div>
                            </div>';
            	 
            	echo $html;
            	

            
                break;
        }
        ?>

    </body>
</html>


