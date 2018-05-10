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
    
    public function SlideDestaque(){
        $sql = 'select fi.nome, fi.foto_perfil, fi.id_filiado
                from tbl_slide_index as si
                inner join tbl_filiado as fi
                on si.id_filiado = fi.id_filiado
                where fi.status = 1';
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            while($rs = mysqli_fetch_array($select)){
                
                $slide[] = new Index();
                $slide[0]->nome = $rs['nome'];
                $slide[0]->foto = $rs['foto_perfil'];
                $slide[0]->id_filiado = $rs['id_filiado'];
                
            }
            
            $sql = "select fm.midia
                    from tbl_slide_index as si
                    inner join tbl_filiado_midia as fm
                    on si.id_filiado = fm.id_filiado
                    where si.status = 1 and fm.descricao = 1";
            
            if($select = mysqli_query($this->conect, $sql)){
                
                $cont = 1;
                while($rs = mysqli_fetch_array($select)){
                    
                    $slide[] = new Index();
                    
                    $slide[$cont]->foto = $rs['midia'];
                    
                    $cont++;
                }
                
            }else{
                $slide = false;
            }
            
            mysqli_close($this->conect);
            
            return $slide;
            
        }else{
            mysqli_close($this->conect);
            return false;
        }
        
    }
    
}

?>