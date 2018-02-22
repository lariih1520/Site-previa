<?php
/**
    Data: 17/02/2018
    Objetivo: Controle de dados de acompanhantes
    Arquivos relacionados: router.php, seja-acompanhante.php, filiado_class.php
**/

class ControllerAcompanhante{
    
    /* Realizar login */
    public function Logar(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $logar = new Acompanhante();
            $logar->email = $_POST['txtEmail'];
            $logar->senha = $_POST['txtSenha'];
            
            $logar->Login($logar);
            
        }
    }
    
    /* cadastrar filiado */
    public function CadastrarFiliado(){
        
        if($_GET['tipo'] <= 3 && $_GET['tipo'] > 0){
            $tipo_conta = $_GET['tipo'];
            
            $acompanhante = new Acompanhante();
            $acompanhante->InsertFiliado($tipo_conta);
            
        }else{
            header('location: seja-cliente.php?Erro=tipo-conta-invalido');
        }        
        
    }
    
    /* Alterar dados do acompanhante */
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
            $cliente->id_cidade = $_POST['cod_cidades'];
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
    
    /* Buscar usuário de acordo com o id */
    public function BuscarDadosUsuario(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadoById();
        
        return $rs;
        
    }
    
    public function BuscarDadosPag(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectDadosPag();
        
        return $rs;
        
    }
    
    /* Buscar estados */
    public function BuscarEstados(){
        require_once('model/filiado_class.php');
        
        $filiado_classe = new Acompanhante();
        $result = $filiado_classe->SelectEstados();
       
        return $result;
    }
    
    /* Buscar cidades */
    public function BuscarCidade(){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $result = $cliente_class->SelectCidade();
        
        return $result;
        
    }

    /* Buscar opções de etnias */
    public function BuscarEtnias(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectEtnia();
        
        return $rs;
        
    }
    
    /* Buscar cores de cabelo */
    public function BuscarCorCabelo(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectCorCabelo();
        
        return $rs;
        
    }
    
    /* Buscar o tipo da conta do usuário */
    public function BuscarTiposConta(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectTiposConta();
        
        return $rs;
    }
    
    /* Buscar o tipo da conta do usuário */
    public function BuscarTipoConta(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectTipoConta();
        
        return $rs;
    }
    
}


?>


