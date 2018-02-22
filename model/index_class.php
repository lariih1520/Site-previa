<?php
/**
    Data: 20/02/2018
**/

class Index{
    
    public $imagem;
    public $conect;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectImagens(){
        $sql = 'select * from tbl_index';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $imagem[] = new Index();
                $imagem[$cont]->imagem = $rs['imagem'];
                
                $cont++;
                
            }
            mysqli_close($this->conect);
            return $imagem;
            
        }else{
            mysqli_close($this->conect);
        }
        
    }
}

?>