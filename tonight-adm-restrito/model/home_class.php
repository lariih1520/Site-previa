<?php
/**
    Data: 17/02/2018
    Objetivo: 
**/

class Home{
    
    public $id_home;
    public $imagem;
    public $conect;
    public $filiado;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function Inserir(){
        
        $id = $_GET['id'];
        $imagem = $_POST['txtIdFiliado'];
        
        $sql = "select * from tbl_filiado where id_filiado = ".$id;
        if($select = mysqli_query($this->conect, $sql)){
            while($rs = mysqli_fetch_array($select)){
                $foto = $rs['foto_perfil'];
                
                $pasta = '../imagens/';
                $img = explode('/', $foto);
                
                copy('../'.$foto, $pasta.$img[1]);
                 
            }
        }
        
        $sql = 'insert into tbl_home_slide (imagem, filiado) values ("'.$imagem.'", '.$id.')';
        
        mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            ?> <script>  window.location.href = "adm_home.php?#img_todas"; </script> <?php
            //header('location:adm_home.php?#img_todas');
            
        }else{
            //echo $sql;
            ?> <script>  window.location.href = "adm_home.php?erro&#img_todas"; </script> <?php
            //header('location:adm_home.php?erro&#img_todas');
        }
        
    }
    
    public function SelectFotos(){
        $sql = 'select * from tbl_home_slide';
        
        $select = mysqli_query($this->conect, $sql);
            
        if(mysqli_affected_rows($this->conect) > 0){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                $home[] = new Home();
                
                $home[$cont]->id_home = $rs['id_home'];
                $home[$cont]->imagem = $rs['imagem'];
                $home[$cont]->filiado = $rs['filiado'];
                
                $cont++;
                
            }
            
            return $home;
            
        }else{
            return false;
        }
        
    }
    
    public function DeleteFotos($id){
        $sql = "select * from tbl_home_slide where id_home = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            while($rs = mysqli_fetch_array($select)){
                
                unlink('../'.$rs['imagem']);
            }
        }
        
        
        $sql = 'delete from tbl_home_slide where id_home = '.$id;
        
        if(mysqli_query($this->conect, $sql)){
            
            ?> <script>  window.location.href = "adm_home.php?ok"; </script> <?php
            //header('location:adm_home.php?ok');
            
        }else{
            
            ?> <script>  window.location.href = "adm_home.php?erro"; </script> <?php
            //header('location:adm_home.php?erro');
        }
        
    }
    
}