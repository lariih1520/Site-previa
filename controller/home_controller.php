<?php
/**
    Data: 17/02/2018
    Objetivo: Home
**/

class ControllerHome{

    
    public function BuscarFotos(){
        include_once('model/home_class.php');
        
        $home_class = new Home();
        $rs = $home_class->SelectFotos();
        
        return $rs;
    }
    
    
}
?>