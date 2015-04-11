<?php

class Escala {
    
    public static function insertarEscala($datos){
        GestorBD::insertarDatos('tipo_escala', $datos); 
    }
    
    public static function listadoEscala(){
        
        $sql           = 'SELECT * FROM tipo_escala';
        $escalas       = GestorBD::tirarSQL($sql);
        
        return $escalas;
    }
    
    public static function eliminarEscala($id){
        GestorBD::eliminarRegistro('tipo_escala', 'id_tipo_escala', $id);
    }
    
    public static function obtenerEscala($id){
        
        $sql          = 'SELECT * FROM tipo_escala WHERE id_tipo_escala='.$id.' LIMIT 1';
        $escala       = GestorBD::tirarSQL($sql);
        return $escala; 
    }
    
    public static function modificarEscala($datos){
        
    	$sql = "UPDATE tipo_escala SET
				    	v_nombre ='$datos[1]',
				    	i_max = '$datos[2]',
						i_min = '$datos[3]'
    	WHERE id_tipo_escala = ".$datos[0];

        $GLOBALS['con']->query($sql);
    }
    
    public static function selectEscala(){
        
        $escalas  = self::listadoEscala();
        $html  = '<select name="tipo_escala" class="form-control">';
        $html .= '<option value="0">---</option>';
        
        foreach ($escalas as $e){
            $html .= '<option value='.$e['id_tipo_escala'].'>'.$e['i_max'].' - ' .$e['i_min'].'</option>';
        }
        
        $html .= '</select>';
        
        return $html;
    }
}

?>
