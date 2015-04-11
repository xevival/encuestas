<?php

class Utils {

    public static function preArray($array) {

        echo "<pre>";
            print_r($array);
        echo "</pre>";
    }
    
    public static function listadoPaises(){

    	$sql_paises = "SELECT id,nombre FROM paises";
    	$paises     = GestorBD::tirarSQL($sql_paises);
    	
    	return $paises;
    }
    
    public static function filtraString($cadena){
    	return $cadena = filter_var($cadena,FILTER_SANITIZE_STRING);
    }
    
    public static function filtraEntero($entero){
    	return  $entero = filter_var($entero,FILTER_SANITIZE_NUMBER_INT);
    }
    
    

}
