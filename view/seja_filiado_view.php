
<?php
    
    $filiado = new Filiado();
    
    if (empty($_GET['etapa'])) {
?>

    <h1 class="titulo"> Seja um acompanhante e divulgue-se! </h1>
    <p class="centro"> Preencha os dados a seguir para cadastrar-se.</p>
    <div class="content_dados_1">
        
        <form action="?etapa=2" method="post">
        <ul class="lst_dados_1">
            
            <li><p> *Nome real: <span class="nomeReal">(Vísivel apenas para você)</span> </p> 
                <input type="text" name="txtNome" maxlength="50" pattern="[a-zA-Z\s]+" required oninvalid="setCustomValidity('Preencha o nome (Apenas letras)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *Nome público: <span class="nomeReal">(Vísivel à todos)</span> </p> 
                <input type="text" name="txtApelido" maxlength="30" pattern="[a-zA-Z\s]+" required oninvalid="setCustomValidity('Preencha o nome (Apenas letras)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *Data de nascimeto: </p> 
                
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
            
            <li><p> *Sexo: </p> 
                <select name="slc_sexo">
                    <option value="0"> Selecione </option>
                    <option value="1"> Feminino </option>
                    <option value="2"> Masculino </option>
                </select>
            </li>
            
            <li><p> *Senha: </p> 
                <input type="password" name="txtSenha" maxlength="10" pattern=".{6,10}" required oninvalid="setCustomValidity('Escolha uma senha (de 6 à 10 caracteres)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *Confirmar senha: </p> 
                <input type="password" name="txtConfrmSenha" maxlength="10" required oninvalid="setCustomValidity('Senhas não coincidem')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *E-mail: </p> 
                <input type="text" name="txtEmail" maxlength="100" required oninvalid="setCustomValidity('Preencha o campo e-mail')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *Celular 1: <img src="icones/whatsapp.png" alt="whatsapp" class="icone"></p> 
                <input type="text" name="txtDDD1" maxlength="2" size="1" pattern="[0-9]+" placeholder="00" required oninvalid="setCustomValidity('Preencha o ddd (apenas numeros)')" onchange="try{setCustomValidity('')}catch(e){}">
                <input type="text" name="txtCel1" maxlength="9" size="10" pattern="[0-9]+" placeholder="12348765" required oninvalid="setCustomValidity('Preencha o celular (apenas numeros)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> Celular 2 (opcional): </p> 
                <input type="text" name="txtDDD2" maxlength="2" size="1" pattern="[0-9]+" placeholder="00" oninvalid="setCustomValidity('Preencha o ddd (apenas numeros)')">
                <input type="text" name="txtCel2" maxlength="9" size="10" pattern="[0-9]+" placeholder="12348765" oninvalid="setCustomValidity('Preencha o celular (apenas numeros)')" >
            </li>
            
            <li><p> *Etnia: </p> 
                <select name="slc_etnia" required>
                    <option value="0"> Selecione </option>
                <?php
                
                    require_once('controller/filiado_controller.php');
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarEtnias();
                    
                    if($rs != null){
                        $cont = 0;
                        
                        while($cont < count($rs)){
                            $id_et = $rs[$cont]->id_etnia;
                            $etnia = $rs[$cont]->etnia;
                            
                ?>
                    <option value="<?php echo $id_et ?>"> <?php echo $etnia ?> </option>
                <?php          
                            $cont++;
                        }
                    }                    
                        
                ?>
                </select>
            </li>
            
            <li><p> Peso (opcional): </p> 
                <input type="text" name="txtPeso" maxlength="3" size="4" > KG 
            </li>
            
            <li><p> *Altura: </p> 
                <input type="text" name="txtAltura" pattern="[1-2]{1},[0-9]{2}" maxlength="4" size="3" required oninvalid="setCustomValidity('Preencha o campo altura(Ex:1,70)')" onchange="try{setCustomValidity('')}catch(e){}">
            </li>
            
            <li><p> *Acompanha: </p> 
                <select name="slc_acompanha" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Mulheres </option>
                    <option value="2"> Homens </option>
                    <option value="3"> Os dois </option>
                </select>
            </li>
            <li><p> *CEP:  </p>
                 <input type="text" id="cep" name="CEP" pattern="[0-9]+" maxlength="9">
            </li>
            <li><p> *UF:  </p>
                 <input type="text" id="uf" name="txtUf" placeholder="Preencha o CEP" readonly>
            </li>
            <li><p> *Cidade:</p>
                 <input type="text" id="cidade" name="txtCidade" placeholder="Preencha o CEP" readonly>
            </li>
            <li><p> *Valor que deseja cobrar: </p> 
                R$
                <input type="text" name="txtValor" maxlength="6" required size="3" pattern="[0-9]+" oninvalid="setCustomValidity('Escolha o valor que deseja cobrar (apenas números)')" onchange="try{setCustomValidity('')}catch(e){}">,00
                / hora
            </li>
            <li><p> *CPF:(Apenas números) </p> 
                <input type="text" name="txtCPF" maxlength="11" required pattern="[0-9]+" oninvalid="setCustomValidity('Preencha o campo CPF')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </li>
            
            <?php
                if(isset($_GET['Erro'])){
                    if($_GET['Erro'] == 'Senha')
                        $msg = 'Senhas não coincidem';
                    elseif($_GET['Erro'] == 'Idade')
                        $msg = 'Pessoas com menos de 18 anos não podem se cadastrar';
                    elseif($_GET['Erro'] == 'cadastro')
                        $msg = 'Não foi possivel realizar o cadastro tente mais tarde';
                    elseif($_GET['Erro'] == 'Email')
                        $msg = 'Este e-mail já está sendo usado';
                    else
                        $msg = 'Erro';
            ?>
                <li id="erro">
                    <?php echo $msg ?>
                </li>
            <?php
                }
            ?>
            
        </ul>
            <input type="submit" value="Próximo &raquo;" class="botao right" name="btnProx">

        </form>
        
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
                                    $("#frm").attr('action', 'router.php?controller=cliente&modo=inserir');
                                    $("#frm").attr('method', 'post');
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
    </div> 
    
<?php
    } elseif($_GET['etapa'] == '2') {
        
        if(isset($_POST['btnProx'])){

            $apelido = $_POST['txtApelido'];
            $nome = $_POST['txtNome'];
            $nasc = $_POST['slc_ano'].'-'.$_POST['slc_mes'].'-'.$_POST['slc_dia'];
            $email = $_POST['txtEmail'];
            $senha = $_POST['txtSenha'];
            $confrmSenha = $_POST['txtConfrmSenha'];
            $ddd1 = $_POST['txtDDD1'];
            $ddd2 = $_POST['txtDDD2'];
            $celular1 = $_POST['txtCel1'];
            $celular2 = $_POST['txtCel2'];
            $etnia = $_POST['slc_etnia'];
            $sexo = $_POST['slc_sexo'];
            $altura = $_POST['txtAltura'];
            $peso = $_POST['txtPeso'];
            $acompanha = $_POST['slc_acompanha'];
            $cidade = $_POST['txtCidade'];
            $estado = $_POST['txtUf'];
            $cobra = $_POST['txtValor'];
            $cpf = $_POST['txtCPF'];

            $rsp = $filiado->setFiliado(
                $nome, $apelido, $nasc, $email, $senha, $confrmSenha, $ddd1, $celular1, $ddd2, 
                $celular2, $etnia, $sexo, $altura, $peso, $acompanha, $cidade, $estado, $cobra, $cpf);
            
        }
        
        $desconto = new ControllerAcompanhante();
        $desc = $desconto->BuscarStatusDesconto();
        
        if($desc != null or $desc != 2){
            if($desc['status'] == 1){
                $height = 'style="height:850px;"';
            }else{
                $height = '';
            }
        }else{
            $height = '';
        }
?>

    <h1 class="titulo"> Escolha o tipo da conta! </h1>
    <div class="content_dados_2" <?php echo $height ?> >
        <form action="router<?php echo $php ?>?controller=acompanhante&modo=inserir" method="post">
            
            <p class="sobre_pag"> Escolha uma das contas a seguir: <br>
            
        <?php
            require_once('controller/filiado_controller.php');
            $controller = new ControllerAcompanhante();
            $rs = $controller->BuscarTiposConta();
            
            if(isset($_GET['escolha'])){
                
                $classe = 'escolha';
            }
            
            if($rs != null){
                $cont = 0;
                $total = count($rs);
                while($cont < count($rs)){
        ?>
            <a href="#estilo" onclick="PegarPlano('<?php echo $rs[$cont]->tipo_conta ?>', '<?php echo $cont ?>', '<?php echo $total ?>');">
            <div class="tipo_conta <?php echo $classe ?>" id="conta<?php echo $cont ?>">
                
                <p class="titulo"> <?php echo $rs[$cont]->titulo ?> </p>
                <p class="valor"> Preço: <?php echo $rs[$cont]->valor ?>,00 / Mês </p>
                <p> Quantidade de fotos: <?php echo $rs[$cont]->qtd_fotos ?> </p>
                <p> Quantidade de videos: <?php echo $rs[$cont]->qtd_videos ?> </p>
                <p> Cobrança: mensalmente dia 10 </p>
            </div>
            </a>
        <?php 
                    $cont++;
                }
            }else{
                echo 'Não foram encontrados planos';
            }
        
        
        if($desc != null or $desc != 2){
            if($desc['status'] == 1){
    ?>
            <div class="margembottom"></div>
            <div class="promocao">
                <p class="titulo_promocao"> <strong>Promoção!</strong> </p>
                <p> Primeiro mês grátis, cadastre-se hoje e pague apenas em Março </p>
                <p class="detalhepromocao"> Ao se cadastrar você concorda em permanecer utilizando o site por no minimo 2 (dois) meses </p>
            </div>
    <?php
            }
        }
    ?>            
            <div class="termos">
                <?php 
                    $rs = $filiado->getTermos();
                    echo $rs;
                ?>
            </div>
            <p class="hide"><input type="text" name="txtTipo" id="tipoConta"></p>
            <div class="termos_confirmar">
                <p><input type="checkbox" name="ckTermos" onclick="termos()" id="check"> Li e concordo com os termos </p>
                <input type="submit" value="Concluir" name="btnProx2" disabled class="botao desabilitado" id="btnConcordo">
            </div>
        </form>
    </div>
        
<?php
        }
    
?>
        <script src="js/jquery-3.2.1.min.js" ></script>

        <!-- Adicionando Javascript -->
        <script >

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
            
        </script>
    
