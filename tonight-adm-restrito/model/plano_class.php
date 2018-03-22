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
                    where id_tipo_conta = '.$result[$cont]->id.' and conta_ativa = 1';
                
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
        $fotos = $_POST['txtFotos'];
        $videos = $_POST['txtVideos'];
            
        $sql = "update tbl_tipo_conta
                set titulo = '".$titulo."', 
                valor = ".$preco.",
                foto = ".$fotos.",
                video = ".$videos."
                where id_tipo_conta = ".$id;
        
        if(mysqli_query($this->conect, $sql)){
            header('location:adm_planos.php?Sucesso');
            
        }else{
            header('location:adm_planos.php?Erro');
            
        }
        
    }
    
    public function DeletePlano(){
        
        $id = $_GET['id'];

        $sql = "select * from tbl_filiado where id_tipo_conta = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                
                while($rs = mysqli_fetch_array($select)){
                    $id_filiado = $rs['id_filiado'];
                    
                    $sql2 = "select * from tbl_tipo_conta where id_tipo_conta != ".$id." limit 2";
                    
                    if($select2 = mysqli_query($this->conect, $sql2)){
            
                        while($resp = mysqli_fetch_array($select2)){
                            $id_tipo = $resp['id_tipo_conta'];

                            $sql3 = "update tbl_filiado set id_tipo_conta = ".$id_tipo;
                            $sql3 = $sql3." where id_filiado = ".$id_filiado;

                            mysqli_query($this->conect, $sql3);
                        }
                    }
                }
            }
            
            $sql = "delete from tbl_tipo_conta
                    where id_tipo_conta = ".$id;

            if(mysqli_query($this->conect, $sql)){
                ?> <script> window.location.href = "adm_planos.php?Sucesso"; </script> <?php

            }else{
                //echo $sql;
                echo '<script> alert("Não foi possivel realizar a ação") </script>';
                
                ?> <script> window.location.href = "adm_planos.php?Erro"; </script> <?php
            
            }
        }
        
    }
    
    public function statusDesconto(){
        $sql = "select * from tbl_desconto";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $desc = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $desc = [
                    'status' => $rs['status'],
                    'data' => $rs['data']
                ];
                
            }
            
            return $desc;
            
        }else{
            return 2;
            
        }
        
    }
        
    public function descOnOff(){
        $sql = "select * from tbl_desconto";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                $status = $rs['status'];
                
                if($status == 1){
                    $sql = "update tbl_desconto set status = 0, data = now()";
                }elseif($status == 0){
                    $sql = "update tbl_desconto set status = 1, data = now()";
                }
                
                if(mysqli_query($this->conect, $sql)){
                    ?> <script> window.location.href = "adm_planos.php?Sucesso"; </script> <?php
                }else{
                    ?> <script> window.location.href = "adm_planos.php?Erro=update"; </script> <?php
                }
                
            }
            
        }else{
            echo '<script> alert("Não foi possivel realizar a ação") </script>';
                
            ?> <script> window.location.href = "adm_planos.php?Erro"; </script> <?php
            
        }
        
    }
    
}

?>