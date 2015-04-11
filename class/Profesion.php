<?php

class Profesion {
    
    public static function insertarProfesion($datos){
        GestorBD::insertarDatos('profesiones', $datos); 
    }
    
    public static function listadoProfesion(){
        
        $sql           = 'SELECT * FROM profesiones';
        $profesiones   = GestorBD::tirarSQL($sql);
        
        return $profesiones;
    }
    
    public static function eliminarProfesion($id){
        GestorBD::eliminarRegistro('profesiones', 'id_profesion', $id);
    }
    
    public static function obtenerProfesion($id){
        
        $sql          = 'SELECT * FROM profesiones WHERE id_profesion='.$id.' LIMIT 1';
        $profesiones  = GestorBD::tirarSQL($sql);
        return $profesiones; 
    }
    
    public static function modificarProfesion($id,$nombre){
        $sql = "UPDATE profesiones SET v_profesion ='$nombre' WHERE id_profesion = ".$id;
        $GLOBALS['con']->query($sql);
    }
    
    public static function selectProfesion(){
        
        $profesion  = self::listadoProfesion();
        
        $html  = '<select name="profesion" class="form-control">';
        $html .= '<option value="0">---</option>';
        
        foreach ($profesion as $p){
            $html .= '<option value='.$p['id_profesion'].'>'.$p['v_profesion'].'</option>';
        }
        
        $html .= '</select>';
        
        return $html;
    }
}

?>
