<?php

include_once '../config.php';

//$sql = 'SELECT * FROM MASCOTAS';
//$m = GestorBD::tirarSQL($sql);
//Utils::preArray($m);

// GestorBD::eliminarRegistro('mascotas', 'id_mascota', 3);

// $datos = array();
// $datos[1] = 'pez';

// GestorBD::insertarDatos('mascotas', $datos);

$paises = Utils::listadoPaises();
Utils::preArray($paises);


?>
