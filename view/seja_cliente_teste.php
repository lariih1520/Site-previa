    <?php
        include_once('controller/cliente_controller.php');
    ?>
    <div class="titulo"> Cadastre-se para contratar um dos nossos aompanhantes! </div>
    <form action="router.php?controller=cliente&modo=inserir" method="post" class="cont_alinhar">
        <ul class="lst_cadastrar_dados">
            <li> 
                 <p> Nome:</p>
                 <input type="text" name="txtNome" placeholder="Ex: Usuario">
            </li>
            <li>
                 <p> E-mail:</p>
                 <input type="text" name="txtEmail" placeholder="Ex: usuario@email.com">
            </li>
            <li>
                 <p> Senha:</p>
                 <input type="password" name="txtSenha" maxlength="10">
            </li>
            <li>
                 <p> Confirmar senha:</p>
                 <input type="password" name="txtConfrmSenha" maxlength="10">
            </li>
        </ul>
        <ul class="lst_cadastrar_dados">
            <li>
                 <p> Sexo:</p>
                <select name="slc_sexo">
                    <option value="0"> Selecione </option>
                    <option value="1"> Feminino </option>
                    <option value="2"> Masculino </option>
                </select>
            </li>
            <li>
                <label for="cod_estados">Estado:</label>
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
                 <label for="cod_cidades">Cidade:</label>
                <span class="carregando">Aguarde, carregando...</span>
                <select name="cod_cidades" id="cod_cidades">
                    <option value="">-- Escolha um estado --</option>
                </select>
                
            </li>
            <li>
                 <p> Data de Nascimento:</p>
                 <input type="text" name="txtNasc" placeholder="01-01-2000" maxlength="10">
            </li>
        </ul>
        <input type="submit" name="btnSavar" value="Cadastrar" class="botao">
    </form>
    <script src="http://www.google.com/jsapi"></script>
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