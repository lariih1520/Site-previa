<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: cliente_class.php
**/

class Acompanhante{
    
    public $id_estado;
    public $estado;
    public $codigo_uf;
    public $id_cidade;
    public $cidade;
    public $uf;
    public $nome;
    public $sobrenome;
    public $email;
    public $senha;
    public $confrmSenha;
    public $sexo;
    public $celular;
    public $nasc;
    public $foto;
    public $dia;
    public $mes;
    public $ano;
    public $datetime;
    public $id_etnia;
    public $etnia;
    public $apresentacao;
    public $altura;
    public $peso;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $conexao->conectar();
        
    }
    
    /* Login do acompanhante */
    public function Login($filiado){
        $sql = "select * from tbl_filiado where email = '".$filiado->email."' ";
        $sql = $sql." and senha =  '".$filiado->senha."'";
        
        $select = mysql_query($sql);
        
        if(mysql_affected_rows() > 0){
            
            while($rs = mysql_fetch_array($select)){
                $id = $rs['id_filiado'];
            }
            session_start();
            $_SESSION['id_filiado'] = $id;
            
            header('location:perfil-filiado.php');
            
        }else{
            header('location:login.php?perfil=acompanhante&erro-ao-logar');
        }
        
    }
    
    /* Buscar dados do aompanhante  */
    public function SelectFiliadoById(){
        $id = $_SESSION['id_filiado'];
        
        $sql = 'call VwDadosFiliado('.$id.')';
        
        if($select = mysql_query($sql)){
            
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $filiado = new Acompanhante();
                
                $data = explode('-', $rs['nasc']);
                
                $ano = $data[0];
                $mes = $data[1];
                $dia = $data[2];
                
                $tel1 = explode(')', $rs['celular1']);
                
                $telddd1 = explode('(', $tel1[0]);
                $ddd1 = $telddd1[1];
                $numero1 = $tel1[1];
                
                if($rs['celular2'] != null){
                    $tel2 = explode(')', $rs['celular2']);

                    $telddd2 = explode('(', $tel2[0]);
                    $ddd2 = $telddd2[1];
                    $numero2 = $tel2[1];
                    
                    $filiado->celular2 = $numero2;
                    
                }else{
                    $filiado->celular2 = 'vazio';
                }
                
                $filiado->estado = $rs['estado'];
                $filiado->cidade = $rs['cidade'];
                $filiado->nome = $rs['nome'];
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                
                if($rs['sexo'] == 1){
                    $filiado->sexo = 'Feminino';
                    
                }elseif($rs['sexo'] == 2){
                    $filiado->sexo = 'Masculino';
                    
                }
                
                $filiado->cobrar = $rs['cobrar'];
                $filiado->foto = $rs['foto_perfil'];
                $filiado->etnia = $rs['etnia'];
                $filiado->cabelo = $rs['cabelo'];
                $filiado->altura = $rs['altura'];
                $filiado->peso = $rs['peso'];
                $filiado->titulo = $rs['titulo'];
                $filiado->valor = $rs['valor_conta'];
                $filiado->qtd_fotos = $rs['foto'];
                $filiado->qtd_videos = $rs['video'];
                $filiado->dia = $dia;
                $filiado->mes = $mes;
                $filiado->ano = $ano;
                $filiado->celular1 = $numero1;
                
            }
            
            return $filiado;
            
        } else {
            return false;
            
        }
        
        
    }
    
    /* Cadastrar novo acompanhante no site */
    public function InsertFiliado($tipo_conta){
        
        /* necessário para o funcionamento da classe filiado */
        session_start();
        
        $filiado = new Filiado();
        $fld = $filiado->getFiliado();
        
        /* Pegar data de cadastro */
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        /* Pegando id do estado através do uf */
        $select = mysql_query("select * from tbl_estado where uf = '".$fld->estado."' ");
        
        while($rs = mysql_fetch_array($select)){
            $id_estado = $rs['id_estado'];
        }
        
        $sql = "insert into tbl_filiado(nome, nasc, email, senha, celular1, celular2, etnia, sexo,
                altura, peso, acompanha, id_tipo_conta, id_cidade, id_estado, cobrar, data_cadastro, conta_ativa, status)
                values ('".$fld->nome."', '".
                         $fld->nasc."', '".
                         $fld->email."', '".
                         $fld->senha."', '".
                         $fld->celular1."', '".
                         $fld->celular2."', ".
                         $fld->etnia.", ".
                         $fld->sexo.", ".
                         $fld->altura.", ".
                         $fld->peso.", ".
                         $fld->acompanha.", ".
                         $tipo_conta.", ".
                         $fld->cidade.", ".
                         $id_estado.", ".
                         $fld->cobra.", '".
                         $datetime."', 1, 1)";
        
        if(mysql_query($sql)){
            
            /* Pegar id do acompanhante através do email cadastrado */
            $sql = 'select * from tbl_filiado where email = "'.$fld->email.'" ';
            
            if($select = mysql_query($sql)){
                
                while($rs=mysql_fetch_array($select)){
                    $_SESSION['id_filiado'] = $rs['id_filiado'];
                    
                    header('location:perfil-filiado.php');
                }
                
            }else{
                echo $sql; /* Se der erro */
            }
            
        }else{
            echo $sql; /* Se der erro */
        }
        
    }
    
    /* Buscar estados */
    public function SelectEstados(){
        
        if ($slct = mysql_query("select * from tbl_estado") ) {
           
            $conta = 0;
            while($rst = mysql_fetch_array($slct)){
                
                $estado[] = new Acompanhante();
                
                $estado[$conta]->id_estado = $rst['id_estado'];
                $estado[$conta]->codigo_uf = $rst['codigo_uf'];
                $estado[$conta]->estado = $rst['estado'];
                $estado[$conta]->uf = $rst['uf'];
               
                $conta++;
                
            }
            return $estado;
            
        } else {
            return false;
            
        }
    }
    
    /* Buscar cidades */
    public function SelectCidade(){
        $sql = "select * from tbl_cidade";
        
        if($select = mysql_query($sql)){
           
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $estado = new Cliente();
                
                $estado[$cont]->id_cidade = $rs['id_cidade'];
                $estado[$cont]->cidade = $rs['cidade'];
                $estado[$cont]->uf = $rs['uf'];
                
                $cont++;
            }
            return $estado;
            
        }else{
            return false;
            
        }
        
    }
    
    /* Buscar etnia */
    public function SelectEtnia(){
        $sql = "select * from tbl_etnia";
        
        if($select = mysql_query($sql)){
           
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $etnia[] = new Acompanhante();
                
                $etnia[$cont]->id_etnia = $rs['id_etnia'];
                $etnia[$cont]->etnia = $rs['etnia'];
                
                $cont++;
            }
            return $etnia;
            
        }else{
            return false;
            
        }
        
    }
    
    public function SelectTipoConta(){
        $id = $_SESSION['id_filiado'];
        
        $sql = "select tc.* 
                from tbl_tipo_conta as tc
                inner join tbl_filiado as fi
                on tc.id_tipo_conta = fi.id_tipo_conta
                where id_filiado = ".$id;
        
        if($select = mysql_query($sql)){
            
            while($rs = mysql_fetch_array($select)){

                $tipoConta = new Acompanhante();

                $tipoConta->tipo_conta = $rs['tipo_conta'];
                $tipoConta->titulo = $rs['titulo'];
                $tipoConta->valor = $rs['valor'];
                $tipoConta->qtd_fotos = $rs['foto'];
                $tipoConta->qtd_videos = $rs['video'];
                
            }

            return $tipoConta;
            
        } else {
            echo $sql;
            
        }
    }
    
}