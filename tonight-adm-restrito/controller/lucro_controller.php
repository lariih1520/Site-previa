<?php
/**
    Data: 07/03/2018
    Objetivo: Lucro
**/

class ControllerLucro{
    
    /* Buscar lucro deste mes após o dia do pagamento */
    public function LucroMesAtual(){
        include_once('model/lucro_class.php');
        
        $home_class = new Lucro();
        $rs = $home_class->SelectMesAtual();
        
        return $rs;
    }
    
    /* Buscar lucro mês atual antes do pagamento */
    public function LucroMesAtualMedia(){
        include_once('model/lucro_class.php');
        
        $home_class = new Lucro();
        $rs = $home_class->SelectMesAtualMedia();
        
        return $rs;
    }
    
    /* Buscar lucro mês atual antes do pagamento */
    public function BuscarUsersTipoConta(){
        include_once('model/lucro_class.php');
        
        $home_class = new Lucro();
        $rs = $home_class->SelectUsersTipoConta();
        
        return $rs;
    }
    
    /* Historico de lucro mensal */
    public function HistoricoMensal(){
        include_once('model/lucro_class.php');
        
        $home_class = new Lucro();
        $rs = $home_class->SelectHistoricoMensal();
        
        return $rs;
    }
    
}
?>