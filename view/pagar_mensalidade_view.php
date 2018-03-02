<?php

    /***** Buscar dados do usuário ******/
    $dados = new ControllerAcompanhante();
    $rs = $dados->BuscarDadosPag();

    if($rs != null){
        $id_transfer = $rs->id_transfer;
        $nome = $rs->nome;
        $sobrenome = $rs->sobrenome;
        $ddd = $rs->ddd;
        $telefone = $rs->telefone;
        $cep = $rs->cep;
        $rua = $rs->rua;
        $numero = $rs->numero;
        $bairro = $rs->bairro;
        $cidade = $rs->cidade;
        $estado = $rs->uf;
        $cpf = $rs->cpfdc;
        $cvv = $rs->cvvdc;
        $nmr_cartao = $rs->numero_cartaodc;
        $expiracaoMes = $rs->expiracaoMes;
        $expiracaoAno = $rs->expiracaoAno;

    }else{
        /*** Se não houverem dados o usuário é redirecionado para a página para preenche-los ***/
        header('location:filiado-dados.php?editar=pagar-private');
    }

    /******** Se o form for acionado ********/
    if(isset($_GET['realizar'])){
        
        /* Se opagamento for realizado via boleto */
        if($_GET['realizar'] == 'card'){
            $hash = $_POST['txtHash'];
            $token = $_POST['txtToken'];
            $band = $_POST['txtBandeiraName'];
            $bandBin = $_POST['txtBandeiraBin'];
            
            //echo ($hash.' - '.$token.' - '.$band);
            
            $rsp = $dados->BuscarDadosUsuario();
            
            if($rsp != null){
                $email = $rsp->email;
                $nasc = $rsp->dia.'/'.$rsp->mes.'/'.$rsp->ano;
                echo $nasc;
            }
            
            $res = $dados->BuscarTipoConta();
            if($res != null){
                $valor = $res->valor;
            }
            
            $dados = [
            
                'hash' => $hash,
                'creditCardToken' => $token,
                'senderName' => $nome.' '.$sobrenome,
                'senderAreaCode' => $ddd,
                'senderPhone' => $telefone,
                'senderEmail' => $email,
                'senderCPF' => $cpf,
                'installmentValue' => $valor.'.00',
                'creditCardHolderName' => $nome.' '.$sobrenome,
                'creditCardHolderCPF' => $cpf,
                'creditCardHolderBirthDate' => $nasc,
                'creditCardHolderAreaCode' => $ddd,
                'creditCardHolderPhone' => $telefone,
                'billingAddressStreet' => $rua,
                'billingAddressNumber' => $numero,
                'billingAddressDistrict' => $bairro,
                'billingAddressPostalCode' => $cep,
                'billingAddressCity' => $cidade,
                'billingAddressState' => $estado,
                'reference' => 'mensal'.$id_transfer.date('y-m-d'),
                'itemAmount1' => $valor.'.00',
            ];
                
            $pag = new Pagamento();
            $retorno = $pag->efetuaPagamentoCartao($dados);

            if($retorno != null){
                $dadosPagBd = [
                    'date' => date('Y/m/d H:i'),
                    'valor' => $valor.'.00',
                    'desconto' => 0,
                    'code' => $retorno['code'],
                    'referencia' => $dados['reference']
                ];
                
                $controller = new ControllerAcompanhante();
                $resp = $controller->InserirMensalidadePag('card', $dadosPagBd);
                
                if($resp == true){
            ?>
                <script>
                    window.location.href = "perfil-filiado.php?Sucesso=sucesso";
                </script>

            <?php
                }
            }
                
        /************ Se o pagamento for realizado via cartão ***********/
        }elseif($_GET['realizar'] == 'boleto'){
            
            $hash = $_POST['txtHash'];
            
            $rspst = $dados->BuscarDadosPag();
            
            if($rspst != null){
                $id_transfer = $rspst->id_transfer;
            }
            
            $rsp = $dados->BuscarDadosUsuario();
            if($rsp != null){
                $email = $rsp->email;
            }
            
            $res = $dados->BuscarTipoConta();
            if($res != null){
                $valor = $res->valor;
            }
            
            $dados = [
                'hash' => $hash ,
                'senderName' => $nome.' '.$sobrenome,
                'senderAreaCode' => $ddd,
                'senderPhone' => $telefone,
                'senderEmail' => $email,
                'senderCPF' => $cpf,
                'reference' => 'mensal'.$id_transfer.date('y-m-d'),
                'itemAmount' => $valor.'.00',
            ];
            
            $pag = new Pagamento();
            $retorno = $pag->efetuaPagamentoBoleto($dados);

            if($retorno != null){
                $dadosPagBd = [
                    'date' => date('Y/m/d H:i'),
                    'valor' => $valor.'.00',
                    'desconto' => 0,
                    'code' => $retorno['code'],
                    'referencia' => $dados['reference']
                ];
                
                $controller = new ControllerAcompanhante();
                $resp = $controller->InserirMensalidadePag('boleto', $dadosPagBd);
                
                if($resp == true){
            ?>

                <script>
                    window.location.href = "<?php echo $retorno['paymentLink'] ?>";
                </script>

            <?php
                }
                //header('location:'.$retorno['paymentLink']);
                
            }
            
        }
    }

    /**** Se a forma de pagamento for igual a cartão ****/
    if(isset($_GET['confirmar']) and $_GET['forma'] == 'card'){
        
      if(!empty($_SESSION['id_filiado'])){
         
?>
    <script src="js/jquery-3.2.1.min.js" ></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            
            SetarIdSession();

            GetBrand();

            GerarToken();
            
            setTimeout(function(){
                GerarIdentificador()

                $('#frmPag').submit();
            }, 3000);
        });
        
    </script>

<?php
      }
    
        
    /***** Se a forma de pagamento for feita  por boleto *****/
    }elseif(isset($_GET['confirmar']) and $_GET['forma'] == 'boleto'){
        
        if(!empty($_SESSION['id_filiado'])){
         
?>
        <script src="js/jquery-3.2.1.min.js" ></script>
        <script type="text/javascript">
            
            $(document).ready(function() {
                 
                SetarIdSession();
                
                setTimeout(function(){
                    GerarIdentificador()
                    $('#frmPag').submit();
                    
                }, 3000);
            });
                
        </script>

<?php
        }
    }
    
               
?>
        
<!--
************************ CLASSES REFERENTES AO PAGSEGURO **************************
    
    <script type="text/javascript" src=
    "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>
    
    <!--    Em Sandbox: -->
    <script type="text/javascript" src=
    "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>

    <script type="text/javascript">

    function SetarIdSession(){
        
        idSessao = $('#idSessao').val();
        PagSeguroDirectPayment.setSessionId(idSessao);
        
    }
	
    function GerarIdentificador(){
        
        identificador = PagSeguroDirectPayment.getSenderHash();
        $("#hashPagSeguro").val(identificador);
        
        $('#frmPag').submit();
    }

    function GetBrand(){
        
        bin = $('#numCartao').val();
        PagSeguroDirectPayment.getBrand( {
              cardBin: bin,
              success: function(response) {
                bandeira = response['brand']['name'];
                bin = response['brand']['bin'];
                  
                $("#BandeiraPagSeguroName").val(bandeira);
                $("#BandeiraPagSeguroBin").val(bin);
              },
              error: function(response) {
                  alert('ERROR 3');
              }
          });
    }

    function GerarToken(){  
        numCartao = $("#numCartao").val();
        cvvCartao = $("#cvv").val();
        expiracaoMes = $("#expiraMes").val();
        expiracaoAno = $("#expiraAno").val();
        
        PagSeguroDirectPayment.createCardToken({
            cardNumber: numCartao,
            cvv: cvvCartao,
            expirationMonth: expiracaoMes,
            expirationYear: expiracaoAno,

            success: function(response){  $("#tokenPagamentoCartao").val(response['card']['token']);},
            error: function(response){ alert('ERROR'); }
       });

    }

    </script>
<!--
************************ FIM DAS CLASSES REFERENTES AO PAGSEGURO **************************
-->


<?php
    if(isset($_GET['transaction_id'])){
        $pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);

        $pagamento->codigo_pagseguro = $_GET['transaction_id'];
        
        if($pagamento->status==3 || $pagamento->status==4){
            //ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
            $controller = new ControllerAcompanhante();
            $controller->AtualizeStatusPag(3);

        }else{
            //ATUALIZAR NA BASE DE DADOS
            $controller = new ControllerAcompanhante();
            $controller->AtualizeStatusPag($pagamento->status);
        }
    }

    /******** MOSTRAR GIF CARREGANDO ********/

?>

    <div class="imgcarregando">
       <img src="icones/carregando.gif">
    </div>

<?php   

    $forma = 0;

    if(!empty($_GET['forma'])){
        $forma = $_GET['forma'];
    }

    //gera o código de sessão obrigatório para gerar identificador (hash)
    $p = new Pagamento();
    $idSessao = $p->iniciaPagamentoAction();
               
?>
    <!-- Este forme é necessário para que os parâmetros sejam passados para php -->
    <form action="?realizar=<?php echo $forma ?>" method="post" id="frmPag" class="hide">
        
        <input type="text" id="idSessao" value="<?php echo $idSessao ?>" name="txtIdSessao">
        
        <input type="text" id="hashPagSeguro" value="" name="txtHash">
        
        <input type="text" id="BandeiraPagSeguroName" value="" name="txtBandeiraName">
        
        <input type="text" id="BandeiraPagSeguroBin" value="" name="txtBandeiraBin">
        
        <input type="text" id="tokenPagamentoCartao" value="" name="txtToken">

        <input type="text" id="numCartao" value="<?php echo $nmr_cartao ?>" name="txtNumCartao">
        
        <input type="text" id="cvv" value="<?php echo $cvv ?>" name="txtCvv">
        
        <input type="text" id="expiraMes" value="<?php echo $expiracaoMes ?>" name="txtExpiraMes">
        
        <input type="text" id="expiraAno" value="<?php echo $expiracaoAno ?>" name="txtExpiraAno">
        
<!--        <input type="submit" class="botao" value="Autorizar pagamento" name="btnAuto"> -->
        
    </form>
