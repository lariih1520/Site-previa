<?php
/**
    Data: 20/02/2018
    Objetivo: 
**/

class Index{
    
    public $id_index;
    public $imagem;
    public $campo;
    public $conect;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    
    public function SelectFotos(){
        $sql = 'select * from tbl_index';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                $index[] = new Index();
                
                $index[$cont]->id_index = $rs['id_index'];
                $index[$cont]->imagem = $rs['imagem'];
                $index[$cont]->campo = $rs['campo'];
                
                $cont++;
                
            }
            
            return $index;
            
        }else{
            return false;
        }
        
    }
    
    public function UpdateFoto($campo){
        $pasta = 'imagens/';
        $nome = $_FILES['flFoto']['name'];
        
        $ext = strtolower(strrchr($nome,"."));
        $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
        
        if(in_array($ext, $permitidos)){
            
            $tmp = $_FILES['flFoto']['tmp_name'];
            if(move_uploaded_file($tmp, '../'.$pasta.$nome)){
                
                $sql = 'update tbl_index set imagem = "'.$pasta.$nome.'" where campo = '.$campo;

                if(mysqli_query($this->conect, $sql)){

                    header('location:adm_index.php?ok');

                }else{
                    //echo $sql;
                    header('location:adm_index.php?erro');
                }

            }else{
                echo "Falha ao enviar";
            }
            
        }else{
            //echo $sql;
            header('location:adm_index.php?erro');
        }
        
        
    }
    
    public function DeleteFotos($content){
        if($content == 'capa'){
            $sql = 'update tbl_index set imagem = "-" where campo = 1';
            
        }elseif($content == 'menu'){
            $sql = 'update tbl_index set imagem = "-" where campo > 1';
        }
        
        if(mysqli_query($this->conect, $sql)){
            
            header('location:adm_index.php?ok');
            
        }else{
            echo $sql;
            //header('location:adm_index.php?erro');
        }
        
    }
    
}