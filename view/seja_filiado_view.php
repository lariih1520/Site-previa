<div id="estilo">

<?php
    include_once('controller/filiado.php');
    $filiado = new Filiado();
    
    if (empty($_GET)) {
?>

    <h1 class="titulo"> Seja um acompanhante e divulgue-se! </h1>
    <p class="centro"> Preencha os dados a seguir para cadastrar-se.</p>
    <div class="content_dados_1">
        
        <form action="?etapa=2" method="post">
        <ul class="lst_dados_1">
            
            <li><p> *Nome: </p> 
                <input type="text" name="txtNome" maxlength="" required oninvalid="setCustomValidity('Preencha o nome')"></li>
            
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
                <select name="slc_sexo" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Feminino </option>
                    <option value="2"> Masculino </option>
                </select>
            </li>
            
            <li><p> *Senha: </p> 
                <input type="password" name="txtSenha" maxlength="" required oninvalid="setCustomValidity('Preencha a senha')"></li>
            
            <li><p> *Confirmar senha: </p> 
                <input type="password" name="txtConfrmSenha" maxlength="" required oninvalid="setCustomValidity('Confirme a senha')"></li>
            
            <li><p> *E-mail: </p> 
                <input type="text" name="txtEmail" maxlength="" required oninvalid="setCustomValidity('Preencha o e-mail')"></li>
            
            <li><p> *Celular 1: </p> 
                <input type="text" name="txtDDD1" maxlength="2" size="1" placeholder="00" required oninvalid="setCustomValidity('Preencha o ddd')">
                <input type="text" name="txtCel1" maxlength="9" size="10" placeholder="12348765" required oninvalid="setCustomValidity('Preencha o celular')">
            </li>
            
            <li><p> Celular 2 (opcional): </p> 
                <input type="text" name="txtDDD2" maxlength="2" size="1" required placeholder="00">
                <input type="text" name="txtCel2" maxlength="9" size="10" required placeholder="12348765">
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
                <input type="text" name="txtPeso" maxlength="3" size="3" > KG </li>
            
            <li><p> *Altura: </p> 
                <input type="text" name="txtAltura" maxlength="4" size="3" required oninvalid="setCustomValidity('Preencha o campo altura')"></li>
            
            <li><p> *Acompanha: </p> 
                <select name="slc_acompanha" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Mulheres </option>
                    <option value="2"> Homens </option>
                    <option value="3"> Os dois </option>
                </select>
            </li>
            <li><p> CEP:  </p>
                 <input type="text" id="cep" name="CEP" maxlength="9">
            </li>
            <li><p> UF:  </p>
                 <input type="text" id="uf" name="txtUf" maxlength="10">
            </li>
            <li><p> Cidade:</p>
                 <input type="text" id="cidade" name="txtCidade" maxlength="10">
            </li>
            <li><p> *Valor que deseja cobrar: </p> 
                <input type="text" name="txtValor" maxlength="6" required size="5" oninvalid="setCustomValidity('Escolha o valor que deseja cobrar')">,00
            </li>
            
        </ul>
            <input type="submit" value="Próximo &raquo;" class="botao right" name="btnProx">

        </form>
        
        <script src="js/jquery-3.2.1.min.js" ></script>

        <!-- Adicionando Javascript -->
        <script type="text/javascript" >

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

            $rsp = $filiado->setFiliado(
                $nome, $nasc, $email, $senha, $confrmSenha, $ddd1, $celular1, $ddd2, 
                $celular2, $etnia, $sexo, $altura, $peso, $acompanha, $cidade, $estado, $cobra);
            
        }
        
        $tipo = '';
        if(isset($_GET['tipo'])){
            $tipo = '&tipo='.$_GET['tipo'];
        }
?>

    <h1 class="titulo"> Escolha o tipo da conta! </h1>
    <div class="content_dados_2">
        <form action="router.php?controller=acompanhante&modo=inserir<?php echo $tipo ?>" method="post">
            
            <p class="sobre_pag"> Valor mensal dia 10 <br>
            
        <?php
            require_once('controller/filiado_controller.php');
            $controller = new ControllerAcompanhante();
            $rs = $controller->BuscarTiposConta();
            
            if($rs != null){
                $cont = 0;
                while($cont < count($rs)){
        ?>
            <a href="?etapa=2&tipo=<?php echo $rs[$cont]->tipo_conta ?>">
            <div class="tipo_conta">
                <p class="titulo"> <?php echo $rs[$cont]->titulo ?> </p>
                <p class="valor"> Preço: <?php echo $rs[$cont]->valor ?>,00 / Mês </p>
                <p> Quantidade de fotos: <?php echo $rs[$cont]->qtd_fotos ?> </p>
                <p> Quantidade de videos: <?php echo $rs[$cont]->qtd_videos ?> </p>
            </div>
            </a>
        <?php 
                    $cont++;
                }
            }
        ?>            
            <div class="termos">
                <?php 
                    $rs = $filiado->getTermos();
                    echo $rs;
                ?>
            </div>
            <div class="termos_confirmar">
                <p><input type="checkbox" name="ckTermos" onclick="termos()" id="check"> Li e concordo com os termos </p>
                <input type="submit" value="Concluir" name="btnProx2" disabled class="botao desabilitado" id="btnConcordo">
            </div>
        </form>
    </div>

<?php
    } 
?>

</div>
