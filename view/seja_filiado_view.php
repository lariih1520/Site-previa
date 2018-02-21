<div id="estilo">

<?php
    include_once('controller/filiado.php');
    $filiado = new Filiado();
    
    if (empty($_GET)) {
?>

    <h1 class="titulo"> Seja um acompanhante e duvulgue-se! </h1>
    <p class="centro"> Preencha os dados a seguir para cadastrar-se, essas informações ajudam os clientes a encontrar o seu perfil. Essses são os dados publicos </p>
    <div class="content_dados_1">
        
        <form action="?etapa=2" method="post">
        <ul class="lst_dados_1">
            
            <li><p> *Nome: </p> 
                <input type="text" name="txtNome" maxlength=""></li>
            
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
                <input type="password" name="txtSenha" maxlength=""></li>
            
            <li><p> *Confirmar senha: </p> 
                <input type="password" name="txtConfrmSenha" maxlength=""></li>
            
            <li><p> *E-mail: </p> 
                <input type="text" name="txtEmail" maxlength=""></li>
            
            <li><p> *Celular 1: </p> 
                <input type="text" name="txtDDD1" maxlength="2" size="1" placeholder="00" required>
                <input type="text" name="txtCel1" maxlength="9" size="10" placeholder="12348765" required>
            </li>
            
            <li><p> Celular 2 (opcional): </p> 
                <input type="text" name="txtDDD2" maxlength="2" size="1" placeholder="00">
                <input type="text" name="txtCel2" maxlength="9" size="10" placeholder="12348765">
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
            
            <li><p> Peso: </p> 
                <input type="text" name="txtPeso" maxlength="3" size="3"> KG </li>
            
            <li><p> *Altura: </p> 
                <input type="text" name="txtAltura" maxlength="4" size="3"></li>
            
            <li><p> *Acompanha: </p> 
                <select name="slc_acompanha" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Mulheres </option>
                    <option value="2"> Homens </option>
                    <option value="3"> Os dois </option>
                </select>
            </li>
            
            <li>
                <p><label for="cod_estados">Estado:</label></p>
                <select name="cod_estados" id="cod_estados">
                    <option value="0"> selecione </option>
                    <?php
                        include_once('controller/filiado_controller.php');
                        $controller = new ControllerAcompanhante();
                        $rs = $controller->BuscarEstados();

                         if($rs != null){
                            $cont = 0;
                            while($cont < count($rs)){
                                $id_estado = $rs[$cont]->id_estado;
                                $estado = $rs[$cont]->estado;
                                $uf = $rs[$cont]->uf;
                    ?>

                        <option value="<?php echo $uf ?>"><?php echo $estado ?></option>

                    <?php
                                $cont++;
                            }
                         }
                    ?>
                </select>
            </li>
            <li>
                <p><label for="cod_cidades">Cidade:</label></p>
                <span class="carregando">Aguarde, carregando...</span>
                <select name="cod_cidades" id="cod_cidades" required>
                    <option value="">-- Escolha um estado --</option>
                </select>
                
            </li>
            
            <li><p> *Valor que deseja cobrar: </p> 
                <input type="text" name="txtValor" maxlength="6" size="5">,00
            </li>
            
        </ul>
            <input type="submit" value="Próximo &raquo;" class="botao right" name="btnProx">

        </form>
        
    </div>
    <script src="js/jsapi.js"></script>
    <script type="text/javascript">
      google.load('jquery', '1.3');
    </script>		

    <script type="text/javascript">
    $(function(){
        $('#cod_estados').change(function(){
            if( $(this).val() ) {
                $('#cod_cidades').hide();
                $('.carregando').show();
                $.getJSON('model/cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                    var options = '<option value="0"> Selecione </option>';	
                    for (var i = 0; i < j.length; i++) {
                        options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                    }	
                    $('#cod_cidades').html(options).show();
                    $('.carregando').hide();
                });
            } else {
                $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
            }
        });
    });
    </script>
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
            $cidade = $_POST['cod_cidades'];
            $estado = $_POST['cod_estados'];
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
            
            <a href="?etapa=2&tipo=1">
            <div class="tipo_conta">
                <p class="titulo"> Titulo </p>
                <p class="valor"> Mensalidade </p>
                <p> Quantidade de fotos </p>
                <p> Quantidade de videos </p>
            </div>
            </a>
            <a href="?etapa=2&tipo=2">
            <div class="tipo_conta">
                <p class="titulo"> Titulo </p>
                <p class="valor"> Mensalidade </p>
                <p> Quantidade de fotos </p>
                <p> Quantidade de videos </p>
            </div>
            </a>
            <a href="?etapa=2&tipo=3">
            <div class="tipo_conta">
                <p class="titulo"> Titulo </p>
                <p class="valor"> Mensalidade </p>
                <p> Quantidade de fotos </p>
                <p> Quantidade de videos </p>
            </div>
            </a>
                
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


<!-- ************* Dados cartão *************

    <h1 class="titulo"> Quase lá! </h1>
    <div class="content_dados_3">
            <p> Os dados a seguir são referentes ao titular do cartão </p>
        
        /*<form action="router.php?controller=acompanhante&modo=inserir">*/
        
            <form method="get" action="." id="frm">
            <ul class="lst_dados_1">
                <li> <p> CPF </p>
                    <input type="text" name="txtCep" maxlength=""> </li>
                <li> <p> Numero do cartão </p>
                    <input type="text" name="txtNmrCard" maxlength=""> </li>
                <li> <p> cvv </p>
                    <input type="text" name="txtCVV" maxlength=""> </li>
                <li> <p> Mês de expiração </p>
                    <input type="text" name="txtMesInsp" maxlength=""> </li>
                <li> <p> Ano de espiração </p>
                    <input type="text" name="txtAnoInsp" maxlength=""> </li>
                <li> <p> Nome </p>
                    <input type="text" name="txtNome" maxlength=""> </li>
                <li> <p> Sobrenome </p>
                    <input type="text" name="txtSobrenome" maxlength=""> </li>
                <li> <p> E-mail </p>
                    <input type="text" name="txtEmail" maxlength=""> </li>
                <li> <p> Telefone </p>
                    <input type="text" name="txtDddTel" maxlength="2" size="2">
                    <input type="text" name="txtTel" maxlength="" size="8"> </li>
                <li> <p> CEP </p>
                    <input type="text" name="txtCep" id="cep" size="10" maxlength="9"> </li>
                <li> <p> Estado </p>
                    <input type="text" name="txtEstado" id="uf"> </li>
                <li> <p> Cidade </p>
                    <input type="text" name="txtCidade" id="cidade"> </li>
                <li> <p> Rua </p>
                    <input type="text" name="txtRua" id="rua"> </li>
                <li> <p> N° </p>
                    <input type="text" name="txtNmr" maxlength="5" size="4"> </li>
                <li> <p> Bairro </p>
                    <input type="text" name="txtBairro" maxlength="5" id="bairro"> </li>
                
                    <input type="text" name="txtTipoConta" value="<?php echo $tipo ?>" style="display:none;">

            </ul>
            <p><input type="submit" value="Concluido!" class="botao" name="btnSalvar"></p>
        </form>
    </div>
-->