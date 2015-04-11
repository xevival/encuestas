<?php

class Contacto {
    
    public static function insertarFormaContacto($datos){
        GestorBD::insertarDatos('formas_contacto', $datos); 
    }
    
    public static function listadoFormasContacto(){
        
        $sql      = 'SELECT * FROM formas_contacto';
        $formas   = GestorBD::tirarSQL($sql);
        
        return $formas;
    }
    
    public static function eliminarFormasContacto($id){
        GestorBD::eliminarRegistro('formas_contacto', 'id_forma_contacto', $id);
    }
    
    public static function obtenerFormasContacto($id){
        
        $sql     = 'SELECT * FROM formas_contacto WHERE id_forma_contacto='.$id.' LIMIT 1';
        $formas  = GestorBD::tirarSQL($sql);
        return $formas; 
    }
    
    public static function modificarFormasContacto($id,$nombre){
        $sql = "UPDATE formas_contacto SET v_forma_contacto ='$nombre' WHERE id_forma_contacto = ".$id;
        $GLOBALS['con']->query($sql);
    }
    
    public static function selectFormasContacto(){
        
        $formas  = self::listadoFormasContacto();
        
        $html  = '<select name="formas" class="form-control">';
        $html .= '<option value="0">---</option>';
        
        foreach ($formas as $f){
            $html .= '<option value='.$f['id_forma_contacto'].'>'.$f['v_forma_contacto'].'</option>';
        }
        
        $html .= '</select>';
        
        return $html;
    }
}

?>
