<?php
/**
    Data: 19/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: seja-filiado.php
**/

class Filiado{    
    
    public $nome;
    public $nasc;
    public $email;
    public $senha;
    public $confrmSenha;
    public $celular1;
    public $celular2;
    public $etnia;
    public $sexo;
    public $altura;
    public $peso;
    public $acompanha;
    public $cobra;
    
    public function setFiliado(
        $nome, $nasc, $email, $senha, $confrmSenha, $ddd1, $celular1, $ddd2, $celular2,
        $etnia, $sexo, $altura, $peso, $acompanha, $cidade, $estado, $cobra)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        $data_hoje = date('d/m/Y');
        $dt_hoje = explode('/', $data_hoje);
        
        $dt_nasc = explode('-', $nasc);

        $dia_hoje = $dt_hoje[0];
        $mes_hoje = $dt_hoje[1];
        $ano_hoje = $dt_hoje[2];

        $dia = $dt_nasc[2];
        $mes = $dt_nasc[1];
        $ano = $dt_nasc[0];
                
        /* Verificar idade */
        if($ano > 18){
           $idade = true;
            
        }elseif($ano == 18){

            if ($mes < $mes_hoje) {
                $idade = true;

            } elseif ($mes == $mes_hoje) {

                if ($dia <= $dia_hoje) {
                    $idade = true;

                } else {
                    $idade = false;
                }

            }else{
                $idade = false;
            }

        }else{
            $idade = false;
        }
        
        if($idade == true){
            if ($senha == $confrmSenha) {
                
                $_SESSION['nome'] = $nome;
                $_SESSION['nasc'] = $nasc;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['celular1'] = '('.$ddd1.')'.$celular1;
                
                if($celular2 != null && $ddd2){ 
                    $_SESSION['celular2'] = '('.$ddd2.')'.$celular2;
                }
                $_SESSION['etnia'] = $etnia;
                $_SESSION['sexo'] = $sexo;
                $_SESSION['altura'] = $altura;
                $_SESSION['peso'] = $peso;
                $_SESSION['acompanha'] = $acompanha;
                $_SESSION['cidade'] = $cidade;
                $_SESSION['estado'] = $estado;
                $_SESSION['cobra'] = $cobra;
                
            }else{
                header('location:seja-filiado.php?Erro=Senha');
            }
            
        }else{
            header('location:seja-filiado.php?Erro=Idade');
        }
        
    }
    
    public function getFiliado(){
        
        $filiado = new Filiado();
        
        $filiado->nome = $_SESSION['nome'];
        $filiado->nasc = $_SESSION['nasc'];
        $filiado->email = $_SESSION['email'];
        $filiado->senha = $_SESSION['senha'];
        $filiado->celular1 = $_SESSION['celular1'];
        
        if($_SESSION['celular2'] != null){
        
            $filiado->celular2 = $_SESSION['celular2'];
        }
        
        $filiado->etnia = $_SESSION['etnia'];
        $filiado->sexo = $_SESSION['sexo'];
        $filiado->altura = $_SESSION['altura'];
        $filiado->peso = $_SESSION['peso'];
        $filiado->acompanha = $_SESSION['acompanha'];
        $filiado->cidade = $_SESSION['cidade'];
        $filiado->estado = $_SESSION['estado'];
        $filiado->cobra = $_SESSION['cobra'];
        
        return $filiado;
        
    }
    
    public function destroySession(){
        session_destroy();
    }
    
}

?>