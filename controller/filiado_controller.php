<?php
/**
    Data: 17/02/2018
    Objetivo: Controle de dados de acompanhantes
    Arquivos relacionados: router.php, seja-acompanhante.php, filiado_class.php (A maioria)
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
        
        $tipo_conta = $_POST['txtTipo'];

        $acompanhante = new Acompanhante();
        $acompanhante->InsertFiliado($tipo_conta);
             
    }
    
    /* Cadastrar dados para realização de pagamento */
    public function CadastrarDadosPag(){
        
        $dadosPag = new Acompanhante();
        
        $dadosPag->nome = $_POST['txtNome'];
        $dadosPag->sobrenome = $_POST['txtSobrenome'];
        $ddd = $_POST['txtDDD'];
        $dadosPag->telefone = '('.$ddd.')'.$_POST['txtTel'];
        $dadosPag->cep = $_POST['txtCEP'];
        $dadosPag->rua = $_POST['txtRua'];
        $dadosPag->numero = $_POST['txtNumero'];
        $dadosPag->bairro = $_POST['txtBairro'];
        $dadosPag->cidade = $_POST['txtCidade'];
        $dadosPag->uf = $_POST['txtUf'];
        $dadosPag->formaPagar = $_GET['forma'];
        
        $cpf = strlen($_POST['txtCpf']);
        
        $n = 1;
        $cont = 0;
        while($cont < $cpf){
            $n = $n + 1;
            $cont++;
        }
        
        if($n != 44){
            //echo $n;
            header('location:filiado-dados.php?Erro=cpf');
        }
        
        $dadosPag->cpf = base64_encode($_POST['txtCpf']);
        
        if($_GET['forma'] == 'card'){
        
            $dadosPag->numeroCartao = base64_encode($_POST['txtNumeroCartao']);
            $dadosPag->cvv = base64_encode($_POST['txtCVV']);
            $dadosPag->mesExpira = base64_encode($_POST['txtMesExpira']);
            $dadosPag->anoExpira = base64_encode($_POST['txtAnoExpira']);
        }
        $dadosPag->InsertDadosPag($dadosPag);
        
        
    }
    
    /* Alterar dados do acompanhante */
    public function AlterarDados(){
        
        $id = $_SESSION['id_filiado'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data_hoje = date('d/m/Y');
            $dt_hoje = explode('/', $data_hoje);

            $dia_hoje = $dt_hoje[0];
            $mes_hoje = $dt_hoje[1];
            $ano_hoje = $dt_hoje[2];

            $dia = $_POST['slc_dia'];
            $mes = $_POST['slc_mes'];
            $ano = $_POST['slc_ano'];

            $filiado = new Acompanhante();

            $ddd1 = $_POST['txtDDD1'];
            $numero1 = $_POST['txtCel1'];
            $ddd2 = $_POST['txtDDD2'];
            $numero2 = $_POST['txtCel2'];

            $filiado->id = $id;
            $filiado->celular1 = '('.$ddd1.')'.$numero1;
            $filiado->celular2 = '('.$ddd2.')'.$numero2;
            $filiado->nome = $_POST['txtNome'];
            $filiado->email = $_POST['txtEmail'];
            $filiado->sexo = $_POST['slc_sexo'];
            $filiado->altura = $_POST['txtAltura'];
            $filiado->peso = $_POST['txtPeso'];
            $filiado->estado = $_POST['txtUf'];
            $filiado->cidade = $_POST['txtCidade'];
            $filiado->acompanha = $_POST['slc_acompanha'];
            $filiado->cobrar = $_POST['txtCobrar'];
            $filiado->apresentacao = $_POST['txtApresentacao'];
            $filiado->cor_cabelo = $_POST['slc_cor_cabelo'];
            $filiado->nasc = $ano."-".$mes."-".$dia;

            $anos = $ano_hoje - $ano;
            
            
            if($anos > 18){
                $filiado->UpdateDados($filiado);

            }elseif($anos == 18){

                if ($mes < $mes_hoje) {
                    
                    $filiado->UpdateDados($filiado);

                } elseif ($mes == $mes_hoje) {

                    if ($dia <= $dia_hoje) {
                        
                        $cliente->UpdateDados($filiado);

                    } else {
                        header('location:filiado-dados.php?erro=idade');
                    }

                }else{
                    header('location:filiado-dados.php?erro=idade');
                }

            }else{
                header('location:filiado-dados.php?erro=idade');

            }
            
        }
        
        
    }
    
    /* Alterar plano */
    public function AlterarPlano(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if($_POST['txtTipo'] != null){
                $filiado = new Acompanhante();
                $filiado->UpdatePlano();
                
            }else{
                header('location:filiado-dados.php');
            }
            
        }else{
            header('location:filiado-dados.php');

        }
        
        
    }
    
    /* Alterar dados privados */
    public function AlterarDadosPrivate(){
        
        $dadosPag = new Acompanhante();
        
        $dadosPag->id = $_SESSION['id_filiado'];
        $dadosPag->nome = $_POST['txtNome'];
        $dadosPag->sobrenome = $_POST['txtSobrenome'];
        $ddd = $_POST['txtDDD'];
        $dadosPag->telefone = '('.$ddd.')'.$_POST['txtTel'];
        $dadosPag->cep = $_POST['txtCEP'];
        $dadosPag->rua = $_POST['txtRua'];
        $dadosPag->numero = $_POST['txtNumero'];
        $dadosPag->bairro = $_POST['txtBairro'];
        $dadosPag->cidade = $_POST['txtCidade'];
        $dadosPag->uf = $_POST['txtUf'];
        $dadosPag->formaPagar = $_GET['forma'];
        
        $cpf = $_POST['txtCpf'];
        $n = strlen($_POST['txtCpf']);
        
        $soma = 0;
        $cont = 0;
        while($cont < $n){
            $soma = $soma + $cpf[$cont];
            
            $cont++;
        }
        
        /*if($soma != 44 or $soma != 55){
            echo '<br>'.$n;
            $q = $_GET['q'];
            header('location:filiado-dados.php?editar=pagar-private&q='.$q.'&Erro=cpf');
        }*/
        
        $dadosPag->cpf = base64_encode($_POST['txtCpf']);
        
        if($_GET['forma'] == 'card'){
            $dadosPag->numeroCartao = base64_encode($_POST['txtNumeroCartao']);
            $dadosPag->cvv = base64_encode($_POST['txtCVV']);
            $dadosPag->mesExpira = base64_encode($_POST['txtMesExpira']);
            $dadosPag->anoExpira = base64_encode($_POST['txtAnoExpira']);
        }
        $dadosPag->UpdateDadosPag($dadosPag);
    }
    
    public function ExcluirAcompanhante(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $class->DeleteAcompanhante();
        
    }
    
    /* Buscar usuário de acordo com o id */
    public function BuscarDadosUsuario(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadoById();
        
        return $rs;
        
    }
    
    /* Buscar dados do pagamento */
    public function BuscarDadosPag(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectDadosPag();
        
        return $rs;
        
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
    
    /* Buscar o TIPO da CONTA do USUÁRIO */
    public function BuscarTipoConta(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectTipoConta();
        
        return $rs;
    }
    
    /* Buscar imagens do usuário */
    public function BuscarImagensFiliado(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectImagensFiliado();
        
        return $rs;
    }
    
    /* Buscar videos do usuário */
    public function BuscarVideosFiliado(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        $rs = $class->SelectVideosFiliado();
        
        return $rs;
    }
    
    /* Buscar TODOS os filiados */
    public function ListarFiliados(){
        require_once('model/filiado_class.php');
        
        $filiados = new Acompanhante();
        $rs = $filiados->SelectFiliados();
        return $rs;
    }
    
    /* Buscar FILTRO através de características */
    public function BuscarFiliadosFiltro($dadospesq){
        require_once('model/filiado_class.php');
        
        $pesq = new Acompanhante();
        
        $rs = $pesq->SelectFiliadosFiltro($dadospesq);
        return $rs;
    }
    
    /* Inserir foto de perfil */
    public function FotoPerfil(){
        $id = $_GET['id'];
        
        $class = new Acompanhante();
        $rs = $class->UpdateFotoPerfil($id);
        
    }
    
    /* Inserir imagens da conta */
    public function MidiaFiliado($desc){
        $id = $_GET['id'];
        $name = $_GET['name'];
        
        $class = new Acompanhante();
        $rs = $class->InsertMidia($id, $name, $desc);
        
    }
    
    /* Buscar foto perfil */
    public function BuscarFotoPerfil($id){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        
        $rs = $class->SelectFoto($id);
        return $rs;
    }

    /* Buscar estados dos filiados */
    public function EstadosFiliados(){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        
        $rs = $class->SelectEstadosFiliados();
        return $rs;
        
    }
    
    /* Buscar filiados por estado */
    public function ListarFiliadosEstado($uf){
        require_once('model/filiado_class.php');
        $class = new Acompanhante();
        
        $rs = $class->SelectFiliadosEstado($uf);
        return $rs;
        
    }
    
    /* Inserir status de pagamento da mensalidade */
    public function InserirMensalidadePag($tipo, $dados){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $resp = $class->InsertMensalidadePag($tipo, $dados);
        return $resp;
    }
    
    /* Atualizar Status de pagamento */
    public function AtualizeStatusPag($status){
        
        $class = new Acompanhante();
        $class->UpdateStatusPag($status);
        
    }
    
    /* Pegar status do pagamento */
    public function getStatusPagamento(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->getStatusPagamento();
        
        return $rs;
    }
    
    /* Buscar filiado pelo sexo e etnia */
    public function BuscarFiliadosSexo($sexo, $etnia, $limit, $id){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        
        $rs = $class->SelectFiliadosSexo($sexo, $etnia, $limit, $id);
        return $rs;
    }
    
}

?>
