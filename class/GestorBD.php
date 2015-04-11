<?php

class GestorBD {

    public static function connectar($host, $user, $password, $database) {

        global $con;

        $con = new mysqli($host, $user, $password, $database);

        if ($con->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
    }

    public static function tirarSQL($sql) {
        
        $datos = array();

        $results = $GLOBALS['con']->query($sql);
        while($row = $results->fetch_array(MYSQLI_ASSOC)){
            $datos[] = $row;
        }
        
        $results->free();

        return $datos;

    }

    public static function totalSQL($array) {

        if (is_array($array)) {
            return count($array) -1;
        } else {
            return -1;
        }
    }
    
    public static function insertarDatos($tabla,$datos){
        
        $sql_campos  = 'INSERT INTO '.$tabla.' ( ';
        $sql_valores = 'VALUES (';
        $campos      = GestorBD::obtenerColumnas($tabla);
        
        foreach ($campos as $c){
            $sql_campos .= $c.",";
        }
        
        $sql_campos  = substr($sql_campos, 0, -1); 
        $sql_campos .= " )";
        
        for ($i=0;$i<=count($datos);$i++){
            
            if( $datos[$i] == null ){ $sql_valores.= '""'; } else {  $sql_valores.= "'$datos[$i]'"; }
            $sql_valores .= ",";
            
        }
        
        $sql_valores  = substr($sql_valores, 0, -1); 
        $sql_valores  .= " ) ";
        $sql_final =  $sql_campos." ".$sql_valores;
        
        $GLOBALS['con']->query($sql_final);
       
    }
    
    public static function eliminarRegistro($tabla,$nombreColumna,$id){
         
        $sql = 'DELETE FROM '.$tabla." WHERE ".$nombreColumna." = ".$id;
        $GLOBALS['con']->query($sql);
    }
    
    /**
     * Devuelve las columnas de una tabla
     * 
     * @param type String
     * @return array
     */
    public static function obtenerColumnas($tabla){
        
        $datos = array();
        
        $sql      = 'SHOW COLUMNS FROM '.$tabla;
        $results  = $GLOBALS['con']->query($sql);
        
        while ($row = $results->fetch_array(MYSQLI_ASSOC)){
            array_push($datos, $row['Field']);
        }
        
        return $datos;
    }
}
