    <?php

        include_once('controller/cliente_controller.php');
        
    ?>
    <div id="divisao">
    <div class="titulo"> Cadastre-se para contratar um dos nossos aompanhantes! </div>
    <form method="post" action="router.php?controller=cliente&modo=inserir" id="frm" class="cont_alinhar">
        <ul class="lst_cadastrar_dados">
            <li> 
                 <p> Nome:</p>
                 <input type="text" name="txtNome" maxlength="50" pattern="[a-zA-Z]+" placeholder="Ex: Usuario" required oninvalid="setCustomValidity('Preencha o nome (apenas letras)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            <li>
                 <p> E-mail:</p>
                 <input type="email" name="txtEmail" placeholder="Ex: usuario@email.com" required oninvalid="setCustomValidity('Preencha o e-mail')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            <li>
                 <p> Sexo:</p>
                <select name="slc_sexo">
                    <option value="0"> Selecione </option>
                    <option value="1"> Feminino </option>
                    <option value="2"> Masculino </option>
                </select>
            </li>
            <li>
                 <p> Senha:</p>
                 <input type="password" name="txtSenha" maxlength="10" pattern=".{6,10}" required oninvalid="setCustomValidity('Escolha uma senha (de 6 à 10 caracteres)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            <li>
                 <p> Confirmar senha:</p>
                 <input type="password" name="txtConfrmSenha" maxlength="10" pattern=".{6,10}" required oninvalid="setCustomValidity('Senhas não coincidem')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            <li>
                 <p> Celular:</p>
                 <input type="text" name="txtDDD" maxlength="2" size="1" placeholder="00" pattern="[0-9]+" required oninvalid="setCustomValidity('Preencha o ddd (apenas numeros)')" onchange="try{setCustomValidity('')}catch(e){}">
                 <input type="text" name="txtCel" maxlength="9" size="10" placeholder="12348765" pattern="[0-9]+" required oninvalid="setCustomValidity('Preencha o celular (apenas numeros)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
        </ul>
        <ul class="lst_cadastrar_dados">
            <li><p> CEP:  </p>
                 <input type="text" id="cep" pattern="[0-9]+" name="CEP" maxlength="9">
            </li>
            <li><p> UF:  </p>
                 <input type="text" id="uf" name="txtUf" maxlength="10">
            </li>
            <li><p> Cidade:</p>
                 <input type="text" id="cidade" name="txtCidade" maxlength="10">
            </li>
            <li>
                 <p> Data de Nascimento:</p>
            </li>
            <li>
                 <select name="slc_dia">
                     <option value="0"> Dia </option>
                     <?php
                        $cont = 1;
                        while($cont <= 31){
                            if($cont < 10){
                                echo('<option value="0'.$cont.'">0'.$cont.'</option>');
                                
                            }else{
                                echo('<option value="'.$cont.'">'.$cont.'</option>');
                                
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
                            if($cont < 10){
                                echo('<option value="0'.$cont.'">0'.$cont.'</option>');
                                
                            }else{
                                echo('<option value="'.$cont.'">'.$cont.'</option>');
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
                            
                            echo('<option value="'.$cont.'">'.$cont.'</option>');
                            
                            $cont--;
                        }
                     ?>
                 </select>
            </li>
            <li> 
                <p> Enteresse:</p>
                <select name="slc_enteresse" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Mulheres </option>
                    <option value="2"> Homens </option>
                    <option value="3"> Os dois </option>
                </select>
            </li>
            <li>
                
                <?php
                    if(isset($_GET['erro'])){
                        echo ('<p class="alert">');
                            $erro = $_GET['erro'];

                            switch ($erro){
                                case 'idade':
                                    echo('Você não deve se cadastrar se tiver menos de 18 anos!');

                                break;

                                case 'email':
                                    echo('O e-mail escolhido já foi cadastrado, escolha outro e tente novamente');
                                break;

                                case 'senha':
                                    echo('Senhas não coincidem');
                                break;


                            }
                        
                        echo('
                            <span class="botao_ok">
                                <a href="seja-cliente.php"> OK </a>
                            </span>
                        </p>');
                        
                    }
                ?>
                    
            </li>
        </ul>
        <div class="clear"></div>
        <div class="termos">
        <?php
            
            $termos = new ControllerCliente();
            $rs = $termos->getTermos();
            
            echo $rs;
            
        ?>
        </div>
        <p class="concordo"> <input type="checkbox" id="check" name="check" onclick="termos()"> Li e concorco com os temos de uso do site. </p>
        <input type="submit" name="btnSavar" id="btnSavar" value="Cadastrar" class="botao desabilitado" disabled='disabled'>
    </form>
        
    </div>
    <script>
        function termos(){

            if(document.getElementById('check').checked == true){ 	 
                document.getElementById('btnSavar').disabled = ""; 
                $('#btnSavar').removeClass('desabilitado');
            }  
            if(document.getElementById('check').checked == false){
                document.getElementById('btnSavar').disabled = "disabled";
                $('#btnSavar').addClass('desabilitado');
            }
        }
    </script>

    <script src="js/jquery-3.2.1.min.js" ></script>

    <!-- Adicionando Javascript -->
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
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
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } 
                            else {
                                
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } 
                    else {
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } 
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
    