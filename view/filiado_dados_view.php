<?php
    if($_GET['editar'] == 'pagar-private'){
        $titulo = 'Preencha os dados a seguir para realizar o pagamento';
        $botao = 'Próximo';
    }else{
        $titulo = 'Alterar dados';
        $botao = 'Salvar';
    }

?>
    <h1 class="titulo_maior"> <?php echo $titulo ?> </h1>
    <div id="editar_dados">
<?php 
    if($_GET['editar'] == 'dados'){
        
            $controller = new ControllerAcompanhante();
            $rs = $controller->BuscarDadosUsuario();
            
            if($rs != false){

                $uf = $rs->uf;
                $cidade = $rs->cidade;
                $nome = $rs->nome;
                $email = $rs->email;
                $senha = $rs->senha;
                $sexo = $rs->sexo;
                $cor = $rs->cabelo;
                $etniafld = $rs->etnia;
                $altura = $rs->altura;
                $peso = $rs->peso;
                $dia = $rs->dia;
                $mes = $rs->mes;
                $ano = $rs->ano;
                $cobrar = $rs->cobrar;
                $ddd1 = $rs->ddd1;
                $celular1 = $rs->celular1;
                $ddd2 = $rs->ddd2;
                $celular2 = $rs->celular2;
                $acompanha = $rs->acompanha;
                
                if($rs->apresentacao != 'Não há apresentação'){
                    $apresentacao = $rs->apresentacao;
                }else{
                    $apresentacao = '';
                }
                
                /* Se é homem ou mulher */
                if($sexo == 'Feminino'){
                    $sf = "selected";
                    $sm = "";
                        
                }elseif($sexo == 'Masculino'){
                    $sf = "";
                    $sm = "selected";
                }else{
                    $sf = "";
                    $sm = "";
                }
                
                /* Acompanha mulheres, homes ou os dois respectivamente */
                if($acompanha == 'Mulheres'){
                    $am = "selected";
                    $ah = '';
                    $ad = '';
                    
                }elseif($acompanha == 'Homens'){
                    $am = '';
                    $ah = "selected";
                    $ad = '';
                    
                }elseif($acompanha == 'Os dois'){
                    $am = '';
                    $ah = '';
                    $ad = "selected";
                        
                }else{
                    $am = '';
                    $ah = '';
                    $ad = '';
                }
                
                
            }

?>
    <form action="router.php?controller=acompanhante&modo=alterar&q=dados" method="post" id="form1">
        <ul class="lst_dados">
            <li> <p>Nome de usuário:</p>
                <input type="text" name="txtNome" value="<?php echo $nome ?>" maxlength="20">
            </li>
            <li> <p> E-mail: </p>       
                <input type="text" name="txtEmail" value="<?php echo $email ?>" maxlength="100">
            </li>
            <li><p> *Celular 1: </p> 
                <input type="text" name="txtDDD1" maxlength="2" size="1" value="<?php echo $ddd1 ?>" placeholder="00" >
                <input type="text" name="txtCel1" maxlength="9" size="10" value="<?php echo $celular1 ?>" placeholder="12348765" >
            </li>
            
            <li><p> Celular 2 (opcional): </p> 
                <input type="text" name="txtDDD2" maxlength="2" size="1" value="<?php echo $ddd2 ?>" placeholder="00">
                <input type="text" name="txtCel2" maxlength="9" size="10" value="<?php echo $celular2 ?>" placeholder="12348765">
            </li>
            <li><p> *Data de nascimeto: </p> 
                
                 <select name="slc_dia">
                     <option value="0"> Dia </option>
                     <?php
                        $cont = 1;
                        while($cont <= 31){
                            if($dia == $cont){
                                $slt = 'selected';
                                    
                            }else{
                                $slt = '';
                            }
                            if($cont < 10){
                                echo('<option value="0'.$cont.'" '.$slt.'>0'.$cont.'</option>');
                                
                            }else{
                                echo('<option value="'.$cont.'" '.$slt.'>'.$cont.'</option>');
                                
                            }
                            
                            $cont++;
                        }
                     ?>
                 </select>
                 <select name="slc_mes">
                     <option value="0"> Mês </option>
                     <?php
                        $cont = 1;
                        while($cont <= 12){
                            if($mes == $cont){
                                $slt = 'selected';
                                    
                            }else{
                                $slt = '';
                            }
                            if($cont < 10){
                                echo('<option value="0'.$cont.'" '.$slt.'>0'.$cont.'</option>');
                                
                            }else{
                                echo('<option value="'.$cont.'" '.$slt.'>'.$cont.'</option>');
                                
                            }
                            $cont++;
                        }
                     ?>
                 </select>
                 <select name="slc_ano">
                     <option value="0"> Ano </option>
                     <?php
                        $cont = 2018;
                        while($cont >= 1950){
                            if($ano == $cont){
                                $slt = 'selected';
                                    
                            }else{
                                $slt = '';
                            }
                            echo('<option value="'.$cont.'" '.$slt.'>'.$cont.'</option>');
                            
                            $cont--;
                        }
                     ?>
                 </select>
            </li>
            
            
            <li><p> *Etnia: </p> 
                <select name="slc_etnia">
                    <option value="0"> Selecione </option>
                <?php
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarEtnias();
                    
                    if($rs != null){
                        $cont = 0;
                        
                        while($cont < count($rs)){
                            $id_et = $rs[$cont]->id_etnia;
                            $etnia = $rs[$cont]->etnia;
                            
                            
                            if($etniafld == $etnia){
                                $id_et = 'value="'.$id_et.'" selected';
                                    
                            }else{
                                $id_et = 'value="'.$id_et.'" ';
                            }
                            
                ?>
                    <option <?php echo $id_et ?>> <?php echo $etnia ?> </option>
                <?php          
                            $cont++;
                        }
                    }
                        
                ?>
                </select>
            </li>
            
            <li> <p> Cor de cabelo:</p> 
                <select name="slc_cor_cabelo">
                    <option value="0"> Selecione </option>
                <?php
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarCorCabelo();
                    
                    if($rs != null){
                        $cont = 0;
                        
                        while($cont < count($rs)){
                            $id_cabelo = $rs[$cont]->id_cabelo;
                            $cor = $rs[$cont]->cor;
                            
                            if($cor == $id_cabelo){
                                $id_cabelo = 'value="'.$id_cabelo.'" selected';
                                    
                            }else{
                                $id_cabelo = 'value="'.$id_cabelo.'" ';
                            }
                            
                ?>
                    <option <?php echo $id_cabelo; ?> > <?php echo $cor ?> </option>
                <?php          
                            $cont++;
                        }
                    }                    
                        
                ?>
                </select>
            </li>
            <li><p> *Sexo: </p> 
                <select name="slc_sexo" required>
                    <option value="0"> Selecione </option>
                    <option value="1" <?php echo $sf ?>> Feminino </option>
                    <option value="2" <?php echo $sm ?>> Masculino </option>
                </select>
            </li>
            <li> <p> Altura: </p>       
                <input type="text" name="txtAltura" value="<?php echo $altura ?>" size="2" maxlength="4">
            </li>
            <li> <p> Peso: </p>         
                <input type="text" name="txtPeso" value="<?php echo $peso ?>" size="2" maxlength="3"> Kg
            </li>
            
            <li><p> Acompanha: </p> 
                <select name="slc_acompanha">
                    <option value="0"> Selecione </option>
                    <option value="1" <?php echo $am ?>> Mulheres </option>
                    <option value="2" <?php echo $ah ?>> Homens </option>
                    <option value="3" <?php echo $ad ?>> Os dois </option>
                </select>
            </li>
            <li><p>Valor para contratar:</p>
                <input type="text" name="txtCobrar" value="<?php echo $cobrar ?>" size="3" maxlength="10">,00
            </li>
            <li><p> CEP:  </p>
                 <input type="text" id="cep" name="CEP" maxlength="9" placeholder="Para alterar estado ou cidade">
            </li>
            <li><p> UF:  </p>
                 <input type="text" value="<?php echo $uf ?>" id="uf" name="txtUf" maxlength="10">
            </li>
            <li><p> Cidade:</p>
                 <input type="text" value="<?php echo $cidade ?>" id="cidade" name="txtCidade" maxlength="10">
            </li>
            <li> <p> Apresentação: </p> 
                <textarea name="txtApresentacao" cols="50" rows="10" maxlength="300"><?php echo $apresentacao ?></textarea>
            </li>
        </ul>
        <input type="submit" name="btnSalvar" value="Salvar" class="botao">
    </form>    
<?php
    }elseif($_GET['editar'] == 'dados-private' || $_GET['editar'] == 'pagar-private'){
        
        if($_GET['editar'] == 'pagar-private'){
            $q = 'q=pagar';
        }else{
            $q = 'q=dados-private';
        }
        
        $dados = new ControllerAcompanhante();
        $rs = $dados->BuscarDadosPag();
            
        if($rs != null){
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
            $numero_cartao = $rs->numero_cartaodc;
            $expiracaoMes = $rs->expiracaoMes;
            $expiracaoAno = $rs->expiracaoAno;
            $modo= 'modo=alterar';
                
        }else{
            $nome = '';
            $sobrenome = '';
            $ddd = '';
            $telefone = '';
            $cep = '';
            $rua = '';
            $numero = '';
            $bairro = '';
            $cidade = '';
            $estado = '';
            $cpf = '';
            $cvv = '';
            $numero_cartao = '';
            $expiracaoMes = '';
            $expiracaoAno = '';
            $modo= 'modo=inserir';
        }
            
            
    if($_GET['editar'] == 'dados-private' or empty($_GET['forma']) or $_GET['forma'] == 'card'){
?>  
     
    <form action="router.php?controller=acompanhante&<?php echo $modo.'&'.$q ?>&forma=card" method="post" id="form2">
        <ul class="lst_dados">
            <li> <p>Nome: </p>
                <input type="text" name="txtNome" value="<?php echo $nome ?>" maxlength="30">
            </li> 
            <li> <p>Sobrenome: </p>
                <input type="text" name="txtSobrenome" value="<?php echo $sobrenome ?>" maxlength="30">
            </li> 
            <li> <p>Telefone: </p>
                <input type="text" name="txtDDD" value="<?php echo $ddd ?>" maxlength="2" size="2" placeholder="DDD">
                <input type="text" name="txtTel" value="<?php echo $telefone ?>" maxlength="8">
            </li> 
            <li> <p>CPF (apenas numeros): </p>
                <input type="text" name="txtCpf" value="<?php echo $cpf ?>" maxlength="11">
            </li> 
            <li> <p>CEP (apenas numeros):  </p>
                <input type="text" name="txtCEP" id="cep" value="<?php echo $cep ?>" maxlength="8">
            </li> 
            <li> <p>Rua: </p>
                <input type="text" name="txtRua" id="rua" value="<?php echo $rua ?>" readonly>
            </li> 
            <li> <p>Numero: </p>
                <input type="text" name="txtNumero" value="<?php echo $numero ?>" maxlength="4" size="2">
            </li> 
            <li> <p>Bairro: </p>
                <input type="text" name="txtBairro" id="bairro" value="<?php echo $bairro ?>" readonly>
            </li> 
            <li> <p>Cidade: </p>
                <input type="text" name="txtCidade" id="cidade" value="<?php echo $cidade ?>" readonly>
            </li> 
            <li> <p>Estado: </p>
                <input type="text" name="txtUf" id="uf" value="<?php echo $estado ?>" readonly>
            </li> 
            <li> <p>Numero do cartão: </p>
                <input type="text" name="txtNumeroCartao" value="<?php echo $numero_cartao ?>" maxlength="16">
            </li> 
            <li> <p>Mês de expiração: </p>
                <input type="text" name="txtMesExpira" value="<?php echo $expiracaoMes ?>" maxlength="2" size="2">
            </li> 
            <li> <p>Ano de expiração: </p>
                <input type="text" name="txtAnoExpira" value="<?php echo $expiracaoAno ?>" maxlength="4" size="4">
            </li> 
            <li> <p>CVV: </p>
                <input type="text" name="txtCVV" value="<?php echo $cvv ?>" maxlength="4" id="cvv">
            </li>    
        </ul>
        <p><input type="submit" name="btnSalvar" value="<?php echo $botao; ?>" class="botao"> 
            <a href="perfil-filiado.php"> Cancelar </a>
        </p>
        
    </form>
        
<?php
        }elseif($_GET['forma'] == 'boleto'){
?>
    <form action="router.php?controller=acompanhante&<?php echo $modo.'&'.$q ?>&forma=boleto" method="post" id="form3">
        <ul class="lst_dados">
            <li> <p>Nome: </p>
                <input type="text" name="txtNome" value="<?php echo $nome ?>" maxlength="30">
            </li> 
            <li> <p>Sobrenome: </p>
                <input type="text" name="txtSobrenome" value="<?php echo $sobrenome ?>" maxlength="30">
            </li> 
            <li> <p>Telefone: </p>
                <input type="text" name="txtDDD" value="<?php echo $ddd ?>" maxlength="2" size="2" placeholder="DDD">
                <input type="text" name="txtTel" value="<?php echo $telefone ?>" maxlength="8">
            </li> 
            <li> <p>CPF (apenas numeros): </p>
                <input type="text" name="txtCpf" value="<?php echo $cpf ?>" maxlength="11">
            </li> 
            <li> <p>CEP (apenas numeros):  </p>
                <input type="text" name="txtCEP" id="cep" value="<?php echo $cep ?>" maxlength="8">
            </li> 
            <li> <p>Rua: </p>
                <input type="text" name="txtRua" id="rua" value="<?php echo $rua ?>" readonly>
            </li> 
            <li> <p>Numero: </p>
                <input type="text" name="txtNumero" value="<?php echo $numero ?>" maxlength="4" size="2">
            </li> 
            <li> <p>Bairro: </p>
                <input type="text" name="txtBairro" id="bairro" value="<?php echo $bairro ?>" readonly>
            </li> 
            <li> <p>Cidade: </p>
                <input type="text" name="txtCidade" id="cidade" value="<?php echo $cidade ?>" readonly>
            </li> 
            <li> <p>Estado: </p>
                <input type="text" name="txtUf" id="uf" value="<?php echo $estado ?>" readonly>
            </li> 
        </ul>
        <p><input type="submit" name="btnSalvar" value="<?php echo $botao; ?>" class="botao"> 
            <a href="perfil-filiado.php"> Cancelar </a>
        </p>
        
    </form>
<?php
        }
        
    }elseif(isset($_GET['editar']) == 'tipo-conta'){
        
        $dados = new ControllerAcompanhante();
        $resp = $dados->BuscarDadosUsuario();
        
        if($resp != null){
            $senha = $resp->senha;
        }
        
        $result = $dados->BuscarTipoConta();
        
        if($result != null){
            $id_tipo_conta = $result->id_tipo_conta;
        }
        
        $rs = $dados->BuscarTiposConta();
        
        
?>
        
    <form id="frmPlano" method="post" action="router.php?controller=acompanhante&modo=plano">
        <p class="titulo"> Plano: </p>
        
        <div id="planos">
<?php
        if($rs != null){
            $cont = 0;
            $total = count($rs);
            while($cont < count($rs)){
                
                if($id_tipo_conta == $rs[$cont]->tipo_conta){
                    $classe = 'selected';
                }else{
                    $classe = '';
                }
?>    
            <a href="#" onclick="PegarPlano('<?php echo $rs[$cont]->tipo_conta ?>', '<?php echo $cont ?>', '<?php echo $total ?>');">
                <div class="tipo_conta <?php echo $classe ?>" id="conta<?php echo $cont ?>">
                        <?php echo $rs[$cont]->titulo ?>
                </div>
            </a>
<?php
                $cont++;
            }
        }
?> 
        </div>
        
        <p> Digite sua senha: </p>
        <input type="password" name="txtSenha" id="senhaDigit" required>
        <span id="alerta"> Senha invalida </span>
        <p class="hide"><input type="text" name="txtSenha" value="<?php echo $senha ?>" id="senha"></p>
        
        <p class="hide"><input type="text" name="txtTipo" id="tipoConta"></p>
        
        <p>
            <input type="submit" name="btnAlterar" value="Salvar" class="botao desabilitado" disabled id="salvar">
            <a href="perfil-filiado.php"> Cancelar </a>
        </p>
    
    </form>
        
<?php
        }
    
?>
        
    </div>
        <script src="js/jquery-3.2.1.min.js" ></script>

        <!-- Adicionando Javascript -->
        <script >

            $(document).ready(function() {

                $("#botao").val("Digite um cep");

                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                }

                //Quando o campo cep perde o foco.
                $("#cep").blur(function() {

                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if(validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#rua").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#botao").val("Salvar");
                            $("#frm").attr('action', 'contratar.php');

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });
            
            function PegarPlano(id, value, total){
                div = '#conta' + value;
                
                $('#tipoConta').val(id);
                
                $(div).css('border', 'double 4px red');
                
                cont = 0;
                while(cont <= total){
                    
                    if(cont != value){
                        divs = '#conta' + cont;
                    
                        $(divs).css('border', 'solid 1px #CDCDCD');
                    }
                
                    cont++;
                }
                
            }
            
            $('#senhaDigit').focusout(function(){
                
                senha = $('#senha').val();
                senhaDigit = $('#senhaDigit').val();
                
                if(senhaDigit == senha){
                   
                    $('#alerta').css('visibility', 'hidden');
                    document.getElementById('salvar').disabled = ""; 
                    $('#salvar').removeClass('desabilitado');
                }else{
                    $('#alerta').css('visibility', 'visible');
                }
                
            });
            
        </script>
    

    