<?php
/**
    Data: 17/02/2018
    Objetivo: Buscar fotos slides
**/

class Home{
    
    public $id_home;
    public $imagem;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $conexao->conectar();
        
    }
    
    public function SelectFotos(){
        $sql = 'select * from tbl_home_slide';
        
        if($select = mysql_query($sql)){
            
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                $home[] = new Home();
                
                $home[$cont]->id_home = $rs['id_inicio'];
                $home[$cont]->imagem = $rs['imagem'];
                $cont++;
                
                return $home;
            }
            
            
        }else{
            return false;
        }
        
    }
    
    
}