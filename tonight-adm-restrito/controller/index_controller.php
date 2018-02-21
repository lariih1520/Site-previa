<?php
/**
    Data: 20/02/2018
    Objetivo: Index
**/

class ControllerIndex{
    
    public function BuscarFotos(){
        include_once('model/index_class.php');
        
        $class = new Index();
        $rs = $class->SelectFotos();
        
        return $rs;
    }
    
    public function Excluir(){
        $content = $_GET['content'];
        
        $class = new Index();
        $rs = $class->DeleteFotos($content);
        
        return $rs;
    }
    
    public function Alterar(){
        $campo = $_GET['campo'];
        
        
        $class = new Index();
        $rs = $class->UpdateFoto($campo);
        
        return $rs;
    }
    
    
}
?>