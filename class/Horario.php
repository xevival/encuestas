<?php

class Horario {
    
    public static function insertarHorario($datos){
        GestorBD::insertarDatos('horarios_contacto', $datos); 
    }
    
    public static function listadoHorario(){
        
        $sql       = 'SELECT * FROM horarios_contacto';
        $horario   = GestorBD::tirarSQL($sql);
        
        return $horario;
    }
    
    public static function eliminarHorario($id){
        GestorBD::eliminarRegistro('horarios_contacto', 'id_hora_contacto', $id);
    }
    
    public static function obtenerHorario($id){
        
        $sql      = 'SELECT * FROM horarios_contacto WHERE id_hora_contacto='.$id.' LIMIT 1';
        $horario  = GestorBD::tirarSQL($sql);
        return $horario; 
    }
    
    public static function modificarHorario($id,$nombre){
        $sql = "UPDATE horarios_contacto SET v_hora_contacto ='$nombre' WHERE id_hora_contacto = ".$id;
        $GLOBALS['con']->query($sql);
    }
    
    public static function selectHorario(){
       
    }
}

?>
