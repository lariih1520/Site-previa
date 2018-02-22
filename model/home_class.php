<?php
/**
    Data: 17/02/2018
    Objetivo: Buscar fotos slides
**/

class Home{
    
    public $id_home;
    public $imagem;
    public $conect;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectFotos(){
        $sql = 'select * from tbl_home_slide';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                $home[] = new Home();
                
                $home[$cont]->id_home = $rs['id_home'];
                $home[$cont]->imagem = $rs['imagem'];
                $cont++;
                
            }
            
            mysqli_close($this->conect);
            return $home;
            
        }else{
            mysqli_close($this->conect);
            return false;
        }
        
    }
    
    
}