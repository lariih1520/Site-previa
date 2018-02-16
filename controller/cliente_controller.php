<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: router.php, seja-cliente.php, cliente_class.php
**/

class ControllerCliente{
    
    public function Logar(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $cliente = new Cliente();
            $cliente->email = $_POST['txtEmail'];
            $cliente->senha = $_POST['txtSenha'];
            
            $cliente->Login($cliente);
            
        }
    }
    
    public function Cadastrar(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if ($_POST['txtSenha'] == $_POST['txtConfrmSenha']) {
                
                $data_hoje = date('d/m/Y');
                $dt_hoje = explode('/', $data_hoje);
                
                $dia_hoje = $dt_hoje[0];
                $mes_hoje = $dt_hoje[1];
                $ano_hoje = $dt_hoje[2];
                
                $dia = $_POST['slc_dia'];
                $mes = $_POST['slc_mes'];
                $ano = $_POST['slc_ano'];
                
                $cliente = new Cliente();

                $ddd = $_POST['txtDDD'];
                $numero = $_POST['txtCel'];

                $cliente->celular = '('.$ddd.')'.$numero;
                $cliente->nome = $_POST['txtNome'];
                $cliente->email = $_POST['txtEmail'];
                $cliente->senha = $_POST['txtSenha'];
                $cliente->sexo = $_POST['slc_sexo'];
                $cliente->enteresse = $_POST['slc_enteresse'];
                $cliente->cidade = $_POST['cod_cidades'];
                $cliente->nasc = $ano."-".$mes."-".$dia;
                
                $anos = $ano_hoje - $ano;
                
                if($anos > 18){
                   //echo ('anos');
                    $cliente->InsertCliente($cliente);
                    
                }elseif($anos == 18){
                    
                    if ($mes < $mes_hoje) {
                        //echo ('mes');
                        $cliente->InsertCliente($cliente);
                        
                    } elseif ($mes == $mes_hoje) {
                        
                        if ($dia <= $dia_hoje) {
                            //echo ('dia');
                            $cliente->InsertCliente($cliente);
                            
                        } else {
                            header('location:seja-cliente.php?erro=idade');
                        }
                        
                    }else{
                        header('location:seja-cliente.php?erro=idade');
                    }
                    
                }else{
                    header('location:seja-cliente.php?erro=idade');
                    
                }
                
            }else{
                header('location:seja-cliente.php?erro=senha');
                
            }
            
        }
        
    }
    
    public function Alterar(){
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data_hoje = date('d/m/Y');
            $dt_hoje = explode('/', $data_hoje);

            $dia_hoje = $dt_hoje[0];
            $mes_hoje = $dt_hoje[1];
            $ano_hoje = $dt_hoje[2];

            $dia = $_POST['slc_dia'];
            $mes = $_POST['slc_mes'];
            $ano = $_POST['slc_ano'];

            $cliente = new Cliente();

            $ddd = $_POST['txtDDD'];
            $numero = $_POST['txtCel'];

            $cliente->id = $id;
            $cliente->celular = '('.$ddd.')'.$numero;
            $cliente->nome = $_POST['txtNome'];
            $cliente->email = $_POST['txtEmail'];
            $cliente->sexo = $_POST['slc_sexo'];
            $cliente->cidade = $_POST['cod_cidades'];
            $cliente->enteresse = $_POST['slc_prefere'];
            $cliente->nasc = $ano."-".$mes."-".$dia;

            $anos = $ano_hoje - $ano;

            if($anos > 18){
                $cliente->UpdateCliente($cliente);

            }elseif($anos == 18){

                if ($mes < $mes_hoje) {
                    $cliente->UpdateCliente($cliente);

                } elseif ($mes == $mes_hoje) {

                    if ($dia <= $dia_hoje) {
                        $cliente->UpdateCliente($cliente);

                    } else {
                        header('location:perfil.php?perfil=cliente&erro=idade');
                    }

                }else{
                    header('location:perfil.php?perfil=cliente&erro=idade');
                }

            }else{
                header('location:perfil.php?perfil=cliente&erro=idade');

            }
            
        }
        
        
    }
    
    public function BuscarDadosUsuario($id){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $rs = $cliente_class->SelectClienteById($id);
        
        return $rs;
        
    }
    
    public function BuscarEstados(){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $result = $cliente_class->SelectEstados();
       
        return $result;
    }
    
    public function BuscarCidade(){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $result = $cliente_class->SelectCidade();
        
        return $result;
        
    }
    
    public function BuscarSugestoes($id){
        require_once('model/cliente_class.php');
        
        $cliente = new Clienrte();
        $rs = $cliente->SelectSugestoes();
        
        return $rs;
    }
    
}


?>


