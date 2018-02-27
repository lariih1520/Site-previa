<?php
/**
    Data: 17/02/2018
    Objetivo: 
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
    
    public function Inserir(){
        
        $sql = 'insert into tbl_home_slide (imagem) values ('.$imagem.')';
        
        mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            echo ('Salvo');
            
        }else{
            header('location:adm_home.php');
        }
        
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
            
            return $home;
            
        }else{
            return false;
        }
        
    }
    
    public function DeleteFotos($id){
        $sql = 'delete from tbl_home_slide where id_home = '.$id;
        
        if(mysqli_query($this->conect, $sql)){
            
            header('location:adm_home.php?ok');
            
        }else{
            header('location:adm_home.php?erro');
        }
        
    }
    
}