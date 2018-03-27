<?php
    date_default_timezone_set('America/Sao_Paulo');

    /***** Buscar dados do usuário ******/
    $dados = new ControllerAcompanhante();
    $rs = $dados->BuscarDadosPag();

    if($rs != null and !empty($_SESSION['id_filiado'])){
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
        $desconto = $rs->desconto;
        $cpf = $rs->cpfdc;
        $cvv = $rs->cvvdc;
        $nmr_cartao = $rs->numero_cartaodc;
        $expiracaoMes = $rs->expiracaoMes;
        $expiracaoAno = $rs->expiracaoAno;
        $showgif = true;
        
    }else{
        /*** Se não houverem dados o usuário é redirecionado para a página para preenche-los ***/
        $redirect = 'filiado-dados'.$php.'?editar=pagar-private';
        ?>
            <script>
                window.location.href = "<?php echo $redirect ?>";
            </script>
        <?php
        //header('location:filiado-dados'.$php.'?editar=pagar-private');
    }
 

    $forma = 0;

    if(!empty($_GET['forma'])){
        $forma = $_GET['forma'];
    }

    //gera o código de sessão obrigatório para gerar identificador (hash)
    $p = new Pagamento();
    $idSessao = $p->iniciaPagamentoAction();
    
    if(isset($_GET['confirmar'])){
?>
    <!-- Este forme é necessário para que os parâmetros sejam passados para php -->
    <form action="?realizar=<?php echo $forma ?>" method="post" id="frmPag" class="hide">
        <p> Não mudar os dados a seguir, é apenas para vizualização </p>
        <p> Id da Sessão: <input type="text" id="idSessao" value="<?php echo $idSessao ?>" name="txtIdSessao"></p>
        
        <p> Hash: <input type="text" id="hashPagSeguro" name="txtHash"></p>
        
        <p> Bandeira do cartão: <input type="text" id="BandeiraPagSeguroName" name="txtBandeiraName"></p>
        
        <p> Bandeira pagseguro: <input type="text" id="BandeiraPagSeguroBin" name="txtBandeiraBin"></p>
        
        <p> Token: <input type="text" id="tokenPagamentoCartao" name="txtToken"></p>

        <p> Num Cartão: <input type="text" id="numCartao" value="<?php echo $nmr_cartao ?>" name="txtNumCartao"></p>
        
        <p> CVV: <input type="text" id="cvv" value="<?php echo $cvv ?>" name="txtCvv"></p>
        
        <p> Expiracao mês: <input type="text" id="expiraMes" value="<?php echo $expiracaoMes ?>" name="txtExpiraMes"></p>
        
        <p> Expiracao Ano: <input type="text" id="expiraAno" value="<?php echo $expiracaoAno ?>" name="txtExpiraAno"></p>
        <br>
        <br>
<!--        <input type="submit" class="botao" value="Tudo OKay" name="btnAuto"> -->
        
    </form>

<?php  
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
                
            }
            
            $res = $dados->BuscarTipoConta();
            if($res != null){
                $valor = $res->valor - $desconto;
            }
            
            $id_filiado = $_SESSION['id_filiado'];
            
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
                'reference' => 'mensal'.$id_filiado.date('y-m-d'),
                'itemAmount1' => $valor.'.00'
            ];
                
            $pag = new Pagamento();
            $retorno = $pag->efetuaPagamentoCartao($dados);
            
            if(@$retorno["erro"]){
                echo '<center><p>Erro:</p>'.$retorno["erro"].'</center>';
                echo '<center>'.$retorno["code"].'</center>';
                echo '<center>'.$retorno["token"].'</center>';
                echo '<div class="titulo_maior"><a href="perfil-filiado.php"> Voltar para o perfil </a></div>';
                echo '<br>';
                
                $showgif = false;
                
            }else{
                //var_dump($retorno);
                
                $dadosPagBd = [
                    'date' => date('Y/m/d H:i'),
                    'valor' => $valor,
                    'desconto' => $desconto,
                    'code' => $retorno['code'],
                    'referencia' => $dados['reference']
                ];
                
                //var_dump($dadosPagBd);
                
                if($dadosPagBd['referencia'] != null){
                
                    $controller = new ControllerAcompanhante();
                    $resp = $controller->InserirMensalidadePag('card', $dadosPagBd);
                
                    if($resp == true){
                        echo '<br>';
                        echo '<center><p style="color:#0B6121;">Sucesso! Pagamento realizado</p></center>';
                        echo '<br>';
                        echo '<center><p><a href="perfil-filiado.php?Sucesso=sucesso"> &laquo; Voltar ao perfil </a></p></center>';
                        echo '<br>';
                        echo '<p>'.$dadosPagBd['date'].'</p>';
                        
                        $showgif = false;
                
                    }
                }else{
            ?>
                <script>
                    alert('Houve um erro de processamento de dados');
                    window.location.href = "perfil-filiado.php?Erro=erro";
                </script>

            <?php
                }
            }
                
        /************ Se o pagamento for realizado via cartão ***********/
        }elseif($_GET['realizar'] == 'boleto'){
            
            $hash = $_POST['txtHash'];
            
            $id_filiado = $_SESSION['id_filiado'];
            
            $rsp = $dados->BuscarDadosUsuario();
            if($rsp != null){
                $email = $rsp->email;
            }
            
            $res = $dados->BuscarTipoConta();
            if($res != null){
                $valor = $res->valor - $desconto;
            }
            
            $dados = [
                'hash' => $hash,
                'senderName' => $nome.' '.$sobrenome,
                'senderAreaCode' => $ddd,
                'senderPhone' => $telefone,
                'senderEmail' => $email,
                'senderCPF' => $cpf,
                'reference' => 'mensal'.$id_filiado.date('y-m-d'),
                'itemAmount' => $valor.'.00'
            ];
            
            $pag = new Pagamento();
            $retorno = $pag->efetuaPagamentoBoleto($dados);
            
            if(@$retorno["erro"]){
                echo '<center><p>Erro:</p>'.$retorno["erro"].'</center>';
                echo '<center><p>Code:</p>'.$retorno["code"].'</center>';
                echo '<div class="titulo_maior"><a href="perfil-filiado.php"> Voltar para o perfil </a></div>';
                
                $showgif = false;
                
            }else{
                $dadosPagBd = [
                    'date' => date('Y/m/d H:i'),
                    'valor' => $valor,
                    'desconto' => $desconto,
                    'code' => $retorno['code'],
                    'referencia' => $dados['reference']
                ];
                
                $controller = new ControllerAcompanhante();
                $resp = $controller->InserirMensalidadePag('boleto', $dadosPagBd);
                
                if($resp == true){
                    
                    if($retorno['paymentLink'] != null){
                        echo "<br>";
                        echo '<center><a href="'.$retorno['paymentLink'].'" target="_blank"> Link para o boleto </a></center>';
            
                    }else{
                        ?><script> window.location.href = "perfil-filiado.php?ERROLink"; </script> <?php  
                    }
                }else{
                    ?> <script> window.location.href = "perfil-filiado.php?ERROBd"; </script> <?php  
                }
                
            }
            
        }
    }

    /**** Se a forma de pagamento for igual a cartão ****/
    if(isset($_GET['confirmar']) and $_GET['forma'] == 'card'){
        
      if(!empty($_SESSION['id_filiado'])){
         
?>
    <script src="js/jquery-3.2.1.min.js" ></script>
    <script>
        
        $(document).ready(function() {
            
            SetarIdSession();
            
            setTimeout(function(){
                GetBrand();
            }, 1000);   
            
            setTimeout(function(){
                GerarToken();
            }, 2000);
            
            setTimeout(function(){
                GerarIdentificador();
                
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
        <script>
            
            $(document).ready(function() {
                 
                SetarIdSession();
                
                setTimeout(function(){
                    GerarIdentificador();
                    $('#frmPag').submit();
                    
                }, 2000);
            });
                
        </script>

<?php
        }
    }
               
?>
        
<!--
************************ CLASSES REFERENTES AO PAGSEGURO **************************
-->

    <!-- URL Oficial -->
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>

    <!--    Em Sandbox:
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>
 -->
    <script>

    function SetarIdSession(){
        
        idSessao = $('#idSessao').val();
        PagSeguroDirectPayment.setSessionId(idSessao);
        
    }
	
    function GerarIdentificador(){
        
        identificador = PagSeguroDirectPayment.getSenderHash();
        $("#hashPagSeguro").val(identificador);
        
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


    if($showgif == true){
?>

    <div class="imgcarregando">
       <img src="icones/carregando.gif">
    </div>

<?php
    }
?>
