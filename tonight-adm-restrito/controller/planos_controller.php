<?php 
/**
    Data: 06/03/2018
    Objetivo: Manipulação de dados de planos
**/

class ControllerPlanos{
    
    public function ListarPlanos(){
        require_once('model/plano_class.php');
        
        $class = new Plano();
        $rs = $class->SelectPlanos();
        
        return $rs;
    }
    
    public function BuscarPlano($id){
        require_once('model/plano_class.php');
        
        $class = new Plano();
        $rs = $class->SelectPlanoById($id);
        
        return $rs;
    }
    
    public function Adicionar(){
        $class = new Plano();
        $class->InsertPlano();
        
    }
    
    public function Alterar(){
        $class = new Plano();
        $class->UpdatePlano();
        
    }
    
    public function ExcluirPlano(){
        $class = new Plano();
        $class->DeletePlano();
        
    }
    
    public function statusDesconto(){
        require_once('model/plano_class.php');
        
        $class = new Plano();
        $rs = $class->statusDesconto();
        
        return $rs;
    }
    
    public function descOnOff(){
        $class = new Plano();
        $class->descOnOff();
        
    }
    
}

?>