<?php
/**
    Data: 20/02/2018
    Objetivo: 
**/

class Index{
    
    public $id_index;
    public $imagem;
    public $campo;
    public $nome;
    public $foto;
    public $id_filiado;
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
    
    public function SelectFiliados(){
        
        $sql = "select fi.*, si.status 
                from tbl_filiado as fi
                left join tbl_slide_index as si
                on fi.id_filiado = si.id_filiado
                where conta_ativa = 1";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $filiados[] = new Index();
                
                $filiados[$cont]->id_filiado = $rs['id_filiado'];
                $filiados[$cont]->nome = $rs['nome'];
                $filiados[$cont]->apelido = $rs['apelido'];
                $filiados[$cont]->status = $rs['status'];
                
                if($rs['foto_perfil'] == null or $rs['foto_perfil'] == false){
                    $filiados[$cont]->foto = 'imagens/usuario.jpg';
                }else{
                    $filiados[$cont]->foto = $rs['foto_perfil'];
                }
                
                $cont++;
            }
            return $filiados;
            
        }else{
            return false;
        }
    }
    
    public function SelectImgFiliado($id_filiado){
        
        $sql = "select * from tbl_filiado_midia where descricao = 1 and id_filiado = ".$id_filiado;
        $sql = $sql." limit 6";
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $filiados[] = new Index();
                
                $filiados[$cont]->foto = $rs['midia'];
                
                $cont++;
            }
            return $filiados;
            
        }else{
            return false;
        }
    }
    
    public function UpdateSlide($id_filiado){
        
        $sql = "update tbl_slide_index set id_filiado = ".$id_filiado;
        $sql = $sql.", data_add = now() where id_slide_index = 1";
        
        if(mysqli_query($this->conect, $sql)){
            
            echo "<script> document.location = \"adm_index.php?#acompanhantes\" </script>";
            
        }else{
            echo "<script> document.location = \"adm_index.php?ERRO=true#acompanhantes\" </script>";
        }
    }
    
}