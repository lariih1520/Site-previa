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
    
    public function BuscarFiliados(){
        include_once('model/index_class.php');
        
        $class = new Index();
        $rs = $class->SelectFiliados();
        
        return $rs;
    }
    
    public function ImagensFiliado($id_filiado){
        include_once('model/index_class.php');
        
        $class = new Index();
        $rs = $class->SelectImgFiliado($id_filiado);
        
        return $rs;
    }
    
    public function alterarSlide(){
        
        $id_filiado = $_GET['id'];
        
        $class = new Index();
        $class->UpdateSlide($id_filiado);
        
    }
    
    
}
?>