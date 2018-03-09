<?php 
/**
    Data: 05/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class Acompanhante{
    
    public $id;
    public $conect;
    public $id_filiado;
    public $nome;
    public $nasc;
    public $email;
    public $senha;
    public $celular1;
    public $celular2;
    public $sexo;
    public $apresentacao;
    public $foto_perfil;
    public $altura;
    public $peso;
    public $conta_ativa;
    public $acompanha;
    public $cobrar;
    public $data_cadastro;
    public $nomeCard;
    public $sobrenomeCard;
    public $telefone;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf;
    public $cep;
    public $desconto;
    public $cpf;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectFiliados(){
        $sql = 'select fi.*, pf.cpf from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado where conta_ativa = 1';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            
            while($rs = mysqli_fetch_array($select)){
                
                $result[] = new Acompanhante();
            
                $result[$cont]->nome = $rs['nome'];
                $result[$cont]->id_filiado = $rs['id_filiado'];
                $result[$cont]->nasc = $rs['nasc'];
                $result[$cont]->uf = $rs['uf'];
                $result[$cont]->cobrar = $rs['cobrar'];
                $result[$cont]->cpf = base64_decode($rs['cpf']);
            
                $cont++;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectFiliadoById($id){
        
        $sql = "select fi.*, pf.nome as nomeCard,
                pf.sobrenome as sobrenomeCard,
                pf.bairro, pf.cep, pf.cidade as cidadeCard,
                pf.cpf, pf.numero, pf.rua,
                pf.telefone, pf.uf as ufCard, pf.desconto
                from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado
                where fi.id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $filiado = new Acompanhante();
                
                $filiado->id_filiado = $rs['id_filiado'];
                $filiado->nome = $rs['nome'];
                $filiado->nasc = $rs['nasc'];
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                $filiado->celular1 = $rs['celular1'];
                $filiado->celular2 = $rs['celular2'];
                $filiado->sexo = $rs['sexo'];
                $filiado->apresentacao = $rs['apresentacao'];
                $filiado->foto_perfil = $rs['foto_perfil'];
                $filiado->altura = $rs['altura'];
                $filiado->peso = $rs['peso'];
                $filiado->conta_ativa = $rs['conta_ativa'];
                $filiado->acompanha = $rs['acompanha'];
                $filiado->cobrar = $rs['cobrar'];
                $filiado->uf = $rs['uf'];
                $filiado->cidade = $rs['cidade'];
                $filiado->data_cadastro = $rs['data_cadastro'];
                $filiado->nomeCard = $rs['nomeCard'];
                $filiado->sobrenomeCard = $rs['sobrenomeCard'];
                $filiado->telefone = $rs['telefone'];
                $filiado->rua = $rs['rua'];
                $filiado->numero = $rs['numero'];
                $filiado->bairro = $rs['bairro'];
                $filiado->cidadeCard = $rs['cidadeCard'];
                $filiado->ufCard = $rs['ufCard'];
                $filiado->cep = $rs['cep'];
                $filiado->desconto = $rs['desconto'];
                $filiado->cpf = base64_decode($rs['cpf']);
                
            }
        }else{
            $filiado = false;
        }
        
        return $filiado;
    }
    
}

?>