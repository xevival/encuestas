<?php

class Cliente {
    
    public static function insertarCliente($datos){
        GestorBD::insertarDatos('clientes', $datos); 
    }
    
    public static function listadoCliente($filtro){
        
    	$where = '';
    	
    	if ( $filtro == 'all' )$where = '';
    	else $where = ' WHERE c.v_nombre LIKE "'.$filtro.'%"';

        $sql        = 'SELECT * FROM clientes c '.$where;
        $clientes   = GestorBD::tirarSQL($sql);
        
        return $clientes;
    }
    
    public static function eliminarCliente($id){
        GestorBD::eliminarRegistro('clientes', 'id_cliente', $id);
    }
    
    public static function obtenerCliente($id){
        
        $sql      = 'SELECT * FROM clientes WHERE id_cliente='.$id.' LIMIT 1';
        $cliente  = GestorBD::tirarSQL($sql);
        return $cliente; 
    }
    
    public static function modificarCliente($datos){
        $sql = "UPDATE 
        			clientes 
        		SET 
        			v_nombre ='$datos[1]',
        			v_responsable = '$datos[2]',
				  	v_email = '$datos[3]',
				  	v_telefono = '$datos[4]',
				  	i_pais = '$datos[5]',
				  	v_direccion = '$datos[6]',
				  	v_cp  = '$datos[7]',
				  	v_poblacion  = '$datos[8]' 
        		WHERE id_cliente = ".$datos[0];
        
        $GLOBALS['con']->query($sql);
    }
    
    public static function selectCliente(){
        
        $formas  = self::listadoCliente();
        
        $html  = '<select name="clientes" class="form-control">';
        $html .= '<option value="0">---</option>';
        
        foreach ($clientes as $c){
            $html .= '<option value='.$c['id_cliente'].'>'.$c['v_nombre'].'</option>';
        }
        
        $html .= '</select>';
        
        return $html;
    }
}

?>
