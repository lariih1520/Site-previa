<?php
/**
    Data: 20/02/2018
**/

class Index{
    
    public $imagem;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $conexao->conectar();
        
    }
    
    public function SelectImagens(){
        $sql = 'select * from tbl_index';
        
        if($select = mysql_query($sql)){
            
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $imagem[] = new Index();
                $imagem[$cont]->imagem = $rs['imagem'];
                
                $cont++;
                
            }
            return $imagem;
        }
        
    }
}

?>