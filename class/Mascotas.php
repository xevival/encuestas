<?php

class Mascotas {
    
    public static function insertarMacosta($datos){
        GestorBD::insertarDatos('mascotas', $datos); 
    }
    
    public static function listadoMascotas(){
        
        $sql      = 'SELECT * FROM mascotas';
        $mascotas = GestorBD::tirarSQL($sql);
        
        return $mascotas;
    }
    
    public static function eliminarMascota($id){
        GestorBD::eliminarRegistro('mascotas', 'id_mascota', $id);
    }
    
    public static function obtenerMascota($id){
        
        $sql     = 'SELECT * FROM mascotas WHERE id_mascota='.$id.' LIMIT 1';
        $mascota = GestorBD::tirarSQL($sql);
        return $mascota; 
    }
    
    public static function modificarMascota($id,$nombre){
        $sql = "UPDATE mascotas SET v_nombre ='$nombre' WHERE id_mascota = ".$id;
        $GLOBALS['con']->query($sql);
    }
      
}
