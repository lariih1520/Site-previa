<?php
/**
    Data: 17/02/2018
    Objetivo: Home
**/

class ControllerHome{
    
    public function Inserir(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $home_class = new Home();
            
            $home_class->Inserir();
            
        }
    }
    
    public function BuscarFotos(){
        include_once('model/home_class.php');
        
        $home_class = new Home();
        $rs = $home_class->SelectFotos();
        
        return $rs;
    }
    
    public function Excluir(){
        $id = $_GET['id'];
        
        $home_class = new Home();
        $rs = $home_class->DeleteFotos($id);
        
        return $rs;
    }
    
    
}
?>