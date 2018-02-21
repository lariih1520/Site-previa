    <?php

        include_once('controller/cliente_controller.php');
        
    ?>
    <div id="divisao">
    <div class="titulo"> Cadastre-se para contratar um dos nossos aompanhantes! </div>
    <form action="router.php?controller=cliente&modo=inserir" method="post" class="cont_alinhar">
        <ul class="lst_cadastrar_dados">
            <li> 
                 <p> Nome:</p>
                 <input type="text" name="txtNome" placeholder="Ex: Usuario" value="" required>
            </li>
            <li>
                 <p> E-mail:</p>
                 <input type="email" name="txtEmail" placeholder="Ex: usuario@email.com" value="" required>
            </li>
            <li>
                 <p> Senha:</p>
                 <input type="password" name="txtSenha" maxlength="10" required>
            </li>
            <li>
                 <p> Confirmar senha:</p>
                 <input type="password" name="txtConfrmSenha" maxlength="10" required>
            </li>
            <li>
                 <p> Celular:</p>
                 <input type="text" name="txtDDD" maxlength="2" size="1" placeholder="00" value="" required>
                 <input type="text" name="txtCel" maxlength="9" size="10" placeholder="12348765" value="" required>
            </li>
        </ul>
        <ul class="lst_cadastrar_dados">
            <li>
                 <p> Sexo:</p>
                <select name="slc_sexo" required>
                    <option value="0"> Selecione </option>
                    <option value="1"> Feminino </option>
                    <option value="2"> Masculino </option>
                </select>
            </li>
            <li>
                <p><label for="cod_estados">Estado:</label></p>
                <select name="cod_estados" id="cod_estados">
                    <option value="0"> selecione </option>
                    <?php
                        $controller = new ControllerCliente();
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