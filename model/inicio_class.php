<?php

class Inicio{
    
    public $id;
    public $foto;
    public $conect;
    
    public function __construct(){
        include_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function ImagensLaterais(){
        
        $sql = "select * from tbl_filiado_midia where descricao = 1 group by id_filiado limit 6";
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $imagensPerfil[] = new Inicio();
                
                $imagensPerfil[$cont]->id = $rs['id_filiado'];
                $imagensPerfil[$cont]->foto = $rs['midia'];
                
                $cont++;
            }
            
        }else{
            $imagensPerfil = 0;
        }
        mysqli_close($this->conect);
        return $imagensPerfil;
    }
    
    public function FotosSlide(){
        
        $sql = "select * from tbl_filiado_midia where descricao = 1 order by rand() limit 4";
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $imagensPerfil[] = new Inicio();
                
                $imagensPerfil[$cont]->imgSlide = $rs['midia'];
                $imagensPerfil[$cont]->id_filiado = $rs['id_filiado'];
                
                $cont++;
            }
            
        }else{
            $imagensPerfil = 0;
        }
        mysqli_close($this->conect);
        return $imagensPerfil;
    }
    
}

?>