<?php 
/**
    Data: 05/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class ControllerAcompanhante{
    
    public function ListarAcompanhantes(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliados();
        
        return $rs;
    }
    
    public function BuscarDadosFiliado($id){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadoById($id);
        
        return $rs;
    }
    
}

?>