<?php

/*
    Data: 20/02/2018
*/

class ControllerIndex{
    
    public function BuscarImagens(){
        require_once('model/index_class.php');
        $class = new Index();
        $rs = $class->SelectImagens();
        
        return $rs;
    }
    
}

?>