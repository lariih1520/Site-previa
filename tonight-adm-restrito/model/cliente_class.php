<?php 
/**
    Data: 05/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class Cliente{
    
    public $id;
    public $conect;
    public $id_cliente;
    public $nome;
    public $nasc;
    public $email;
    public $senha;
    public $cidade;
    public $data_cadastro;
    public $sexo;
    public $uf;
    public $celular;
    public $foto_perfil;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectClientes(){
        $sql = 'select * from tbl_cliente';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            
            while($rs = mysqli_fetch_array($select)){
                
                $result[] = new Cliente();
            
                $result[$cont]->nome = $rs['nome'];
                $result[$cont]->id_filiado = $rs['id_cliente'];
                $result[$cont]->nasc = $rs['nasc'];
                $result[$cont]->uf = $rs['uf'];
                $result[$cont]->cidade = $rs['cidade'];
                $result[$cont]->data_cadastro = $rs['data_cadastro'];
                $result[$cont]->sexo = $rs['sexo'];
                $result[$cont]->cpf = 0;//se64_decode($rs['cpf']);
            
                $cont++;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectClienteById($id){
        
        $sql = "select * from tbl_cliente
                where id_cliente = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $filiado = new Cliente();
                
                $filiado->id_cliente = $rs['id_cliente'];
                $filiado->nome = $rs['nome'];
                $filiado->nasc = $rs['nasc'];
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                $filiado->cidade = $rs['cidade'];
                $filiado->uf = $rs['uf'];
                $filiado->foto_perfil = $rs['foto_perfil'];
                $filiado->data_cadastro = $rs['data_cadastro'];
                $filiado->sexo = $rs['sexo'];
                $filiado->celular = $rs['celular'];
                
            }
        }else{
            $filiado = false;
        }
        
        return $filiado;
    }
    
}

?>