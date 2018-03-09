<?php 
/**
    Data: 06/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class ControllerCliente{
    
    public function ListarClientes(){
        require_once('model/cliente_class.php');
        
        $class = new Cliente();
        $rs = $class->SelectClientes();
        
        return $rs;
    }
    
    public function BuscarDadosCliente($id){
        require_once('model/cliente_class.php');
        
        $class = new Cliente();
        $rs = $class->SelectClienteById($id);
        
        return $rs;
    }
    
}

?>