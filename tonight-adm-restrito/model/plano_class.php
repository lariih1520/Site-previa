<?php 
/**
    Data: 06/03/2018
    Objetivo: Manipulação de dados dos planos
**/

class Plano{
    
    public $id;
    public $conect;
    public $titulo;
    public $preco;
    public $nmrFotos;
    public $nmrVideos;
    public $nmrUsuarios;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectPlanos(){
        $sql = 'select * from tbl_tipo_conta';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            
            while($rs = mysqli_fetch_array($select)){
                
                $result[] = new Plano();
            
                $result[$cont]->titulo = $rs['titulo'];
                $result[$cont]->id = $rs['id_tipo_conta'];
                $result[$cont]->preco = $rs['valor'];
                $result[$cont]->nmrFotos = $rs['foto'];
                $result[$cont]->nmrVideos = $rs['video'];
                
                $sql = 'select count(*) as nmr from tbl_filiado 
                    where id_tipo_conta = '.$result[$cont]->id;
                
                if($slct = mysqli_query($this->conect, $sql)){
                    
                    while($resp = mysqli_fetch_array($slct)){
                        $result[$cont]->nmrUsuarios = $resp['nmr'];
                    }
                    
                }
                
                $cont++;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectPlanoById($id){
        
        $sql = "select * from tbl_tipo_conta
                where id_tipo_conta = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $result = new Plano();
            
                $result->titulo = $rs['titulo'];
                $result->id = $rs['id_tipo_conta'];
                $result->preco = $rs['valor'];
                $result->nmrFotos = $rs['foto'];
                $result->nmrVideos = $rs['video'];
                
                $sql = 'select count(*) as nmr from tbl_filiado 
                    where id_tipo_conta = '.$result->id.' and conta_ativa = 1';
                
                if($slct = mysqli_query($this->conect, $sql)){
                    
                    while($resp = mysqli_fetch_array($slct)){
                        $result->nmrUsuarios = $resp['nmr'];
                    }
                    
                }
                
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
    
    public function InsertPlano(){
        
        $titulo = $_POST['txtTitulo'];
        $preco = $_POST['txtPreco'];
        $fotos = $_POST['txtNmrFotos'];
        $videos = $_POST['txtNmrVideos'];
            
        $sql = "insert into tbl_tipo_conta
                (titulo, valor, foto, video)
                values ('".$titulo."', ".$preco.",
                ".$fotos.", ".$videos.")";
        
        
        if(mysqli_query($this->conect, $sql)){
            header('location:adm_planos.php?Sucesso');
            
        }else{
            header('location:adm_planos.php?Erro');
            
        }
        
    }
    
    public function UpdatePlano(){
        
        $id = $_GET['id'];
        $titulo = $_POST['txtTitulo'];
        $preco = $_POST['txtPreco'];
            
        $sql = "update tbl_tipo_conta
                set titulo = '".$titulo."', 
                valor = ".$preco."
                where id_tipo_conta = ".$id;
        
        if(mysqli_query($this->conect, $sql)){
            header('location:adm_planos.php?Sucesso');
            
        }else{
            header('location:adm_planos.php?Erro');
            
        }
        
    }
    
    public function DeletePlano(){
        
        $id = $_GET['id'];
           
        $sql = "delete from tbl_tipo_conta
                where id_tipo_conta = ".$id;
        
        if(mysqli_query($this->conect, $sql)){
            header('location:adm_planos.php?Sucesso');
            
        }else{
            header('location:adm_planos.php?Erro');
            
        }
        
    }
    
}

?>