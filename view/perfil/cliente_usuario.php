<?php
    
    $id = 3;

    $controller = new ControllerCliente();
    $rs = $controller->BuscarDadosUsuario($id);
    
    if($rs != false){
        
        $foto = $rs->foto;
        $id = $rs->id;
        $nome = $rs->nome;
        $email = $rs->email;
        $senha = $rs->senha;
        $dia = $rs->dia;
        $mes = $rs->mes;
        $ano = $rs->ano;
        $sexo = $rs->sexo;
        $ddd = $rs->ddd;
        $celular = $rs->celular;
        $uf_estado = $rs->uf;
        $estado = $rs->estado;
        $id_cidade = $rs->id_cidade;
        $cidade = $rs->cidade;
        $enteresse = $rs->enteresse;
        
        if($enteresse == ''){
            $enteresse = 'Não especificado';
        
        }elseif($enteresse == 1){
            $enteresse = 'Mulheres';
            
        }elseif($enteresse == 2){
            $enteresse = 'Homens';
            
        }
        
        if($foto == '' && $sexo == 1){
            $foto = 'icones/usuaria.jpg';
            
        }elseif($foto == '' && $sexo == 2){
            $foto = 'icones/usuario.jpg';
        }
        
    }
    
?>
    <section id="content">
        <h1 class="titulo_maior"> Perfil - <?php echo $nome ?> </h1>
        <?php 
            if(empty($_GET['editar']) || $_GET['editar'] != 'dados'){ 
                if($sexo == 1){
                    $sexo = 'Feminino';
                }else{
                    $sexo = 'Masculino';
                }
        ?>
            
        <div id="foto_perfil">
            <img src="<?php echo $foto ?>" alt="foto de perfil usuário">
        </div>
        <div id="ver_dados">
            <ul class="lst_dados_ver">
                <li>
                    <p class="label_dados"> Nome </p>
                    <span><?php echo $nome ?></span>
                </li>
                <li>
                    <p class="label_dados"> E-mail</p>
                    <span><?php echo $email ?></span>
                </li>
                <li>
                    <p class="label_dados"> Celular </p>
                    <span><?php echo $celular ?></span>
                </li>
                <li>
                    <p class="label_dados"> Nascimento </p>
                    <span><?php echo $dia.'/'.$mes.'/'.$ano ?></span>
                </li>
                <li>
                    <p class="label_dados"> Sexo </p>
                    <span><?php echo $sexo ?></span>
                </li>
                <li>
                    <p class="label_dados"> Estado </p>
                    <span><?php echo $estado ?></span>
                </li>
                <li>
                    <p class="label_dados"> Cidade </p>
                    <span><?php echo $cidade ?></span>
                </li>
                <li>
                    <p><label> Enteresse </label></p>
                    <span><?php echo $enteresse ?></span>
                </li>
            </ul>
            <div class="editar_dados"><a href="?perfil=cliente&editar=dados#content"> Editar dados </a></div>
        </div>
        
        <?php
        }elseif($_GET['editar'] == 'dados'){
        ?>
        <form action="router.php?controller=cliente&modo=alterar&id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div id="foto_perfil">
                <img src="<?php echo $foto ?>" alt="foto de perfil usuário">
            </div>
            <div>
                <input type="file" name="flFotoPerfil">
            </div>
            <div id="dados">
                <ul class="lst_dados">
                    <li>
                        <p><label> Nome </label></p>
                        <input type="text" name="txtNome" value="<?php echo $nome ?>">
                    </li>
                    <li>
                        <p><label> E-mail</label></p>
                        <input type="email" name="txtEmail" value="<?php echo $email ?>">
                    </li>
                    <li> 
                        <p><label> Enteresse </label></p>
                        <select name="slc_prefere">
                                <option value="1"> Mulheres </option>
                                <option value="2"> Homens </option>
                                <option value="3"> Os dois </option>
                        </select>
                    </li>
                    <li>
                        <p><label> Celular </label></p>
                        <input type="text" name="txtDDD" maxlength="2" size="1" value="<?php echo $ddd ?>" placeholder="ddd" >
                        <input type="text" name="txtCel" maxlength="9" size="10" value="<?php echo $celular ?>" placeholder="celular">
                    </li>
                    <li>
                        <p><label> Nascimento </label></p>
                        <select name="slc_dia">
                             <option value="0"> Dia </option>
                             <?php

                                $cont = 1;
                                while($cont <= 31){
                                    if($dia == $cont){
                                        $slctd = 'selected';
                                    }else{
                                        $slctd = '';
                                    }

                                    if($cont < 10){
                                        echo('<option value="0'.$cont.'" '.$slctd.'>0'.$cont.'</option>');

                                    }else{
                                        echo('<option value="'.$cont.'" '.$slctd.'>'.$cont.'</option>');

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
                                        $slctd = 'selected';
                                    }else{
                                        $slctd = '';
                                    }

                                    if($cont < 10){
                                        echo('<option value="0'.$cont.'" '.$slctd.'>0'.$cont.'</option>');

                                    }else{
                                        echo('<option value="'.$cont.'" '.$slctd.'>'.$cont.'</option>');

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
                                        $slctd = 'selected';
                                    }else{
                                        $slctd = '';
                                    }

                                    echo('<option value="'.$cont.'" '.$slctd.'>'.$cont.'</option>');

                                    $cont--;
                                }
                             ?>
                         </select>
                    </li>
                    <li>
                        <p><label> Sexo </label></p>
                        <select name="slc_sexo">
                                <option value="1"> Feminino </option>
                                <option value="2"> Masculino </option>
                        </select>
                    </li>
                    <li>
                        <p><label for="cod_estados">Estado </label></p>
                        <select name="cod_estados" id="cod_estados">
                            <option value="0"> selecione </option>
                            <?php
                                $controller_estado = new ControllerCliente();
                                $result = $controller_estado->BuscarEstados();

                                 if($result != null){
                                    $cont = 0;
                                    while($cont < count($result)){
                                        $id_estado = $result[$cont]->id_estado;
                                        $estado = $result[$cont]->estado;
                                        $uf = $result[$cont]->uf;

                            ?>

                                <option value="<?php echo $uf ?>"> <?php echo $uf ?> </option>

                            <?php
                                        $cont++;
                                    }
                                 }
                            ?>
                        </select>
                    </li>
                    <li>
                        <p><label for="cod_cidades"> Cidade </label></p>
                        <span class="carregando">Aguarde, carregando...</span>
                        <select name="cod_cidades" id="cod_cidades">
                            <option value="">-- Escolha um estado --</option>
                        </select>

                    </li>
                </ul>
                <div class="editar_dados"> 
                     <input type="submit" value="Salvar dados" class="botao" name="btnSalvar"> | 
                    <a href="?perfil=cliente#content"> Cancelar </a>
                </div>

            </div>
        </form>
           
        <?php
            }
            
            if(empty($_GET['editar']) || $_GET['editar'] != 'informacoes'){
        ?>
        <div id="informacoes">
            <ul class="lst_dados_ver">
                <li>
                    <p class="label_dados"> Senha </p>
                    <span><?php echo $senha ?></span>
                </li>
            </ul>
            <div class="editar_dados"><a href="?perfil=cliente&editar=informacoes#content"> Editar dados </a></div>
        </div>
        <?php 
            }elseif($_GET['editar'] == 'informacoes'){
        ?>
        <div id="informacoes">
        <form action="router.php?controller=cliente&modo=alterar-nivel-dois&id=<?php echo $id ?>" method="post">
            <ul class="lst_dados">
                <li>
                   <p><label> Senha anterior </label></p>
                    <input type="password" name="txtSenha" value="<?php echo $senha ?>">
                </li>
                <li>
                   <p><label> Nova senha </label></p>
                    <input type="password" name="txtSenha" value="<?php echo $senha ?>">
                </li>
                <li>
                   <p><label> Confirmar senha </label></p>
                    <input type="password" name="txtSenha" value="<?php echo $senha ?>">
                </li>
            </ul>
            <div class="editar_dados"> 
                <input type="submit" value="Salvar dados" class="botao" name="btnSalvar"> | 
                <a href="?perfil=cliente#content"> Cancelar </a>
            </div>
        </form>
        </div>
        <?php
            }
        ?>
        <div id="sugestoes">
            <h1 class="titulo"> Sugestões </h1>
            <ul class="lst_sugestoes">
                <li>
                    <a href="perfil.php">
                        <span class="perfil_sugestao">
                             <p> Nome: </p>
                             <p> Peso: </p>
                             <p> Idade: </p>
                        </span>
                        <img src="imagens/free-wallpaper.jpg" class="img_peril">
                    </a>
                </li>
                <li> 
                    <p class="perfil_sugestao"> Perfil </p>
                    <img src="imagens/back.png" class="img_peril">
                </li>
                <li> 
                    <p class="perfil_sugestao"> Perfil </p>
                    <img src="imagens/logo.png" class="img_peril">
                </li>
            </ul>
        </div>
    </section>
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