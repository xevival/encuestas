<?php

include_once '../config.php';

$action = $_REQUEST['action'];

switch ($action){
	
	case 'cerca_clients':
		
		$cadena = $_REQUEST['cadena'];
		
		$sql = 'SELECT 
					v_nombre as value, 
					id_cliente as id
				FROM 
					clientes 
				WHERE 
					v_nombre LIKE "%'.$cadena.'%"';

		$clientes = GestorBD::tirarSQL($sql);
		$total    = GestorBD::totalSQL($clientes);
		
		$data = array();
		
		for ($i = 0; $i <= $total; $i++) {
			$json = array();
			$json['value'] = utf8_encode($clientes[$i]['value']);
			$json['id'] = $clientes[$i]['id'];
			$data[] = $json;
		}
		
		$data['results'] = $data;
		header("Content-type: application/json");
		echo json_encode($data);

		break;
	
	
	
}

?>