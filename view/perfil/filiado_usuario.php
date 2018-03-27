<?php
    
    $controller = new ControllerAcompanhante();
    $rs = $controller->BuscarDadosUsuario();
        
    if($rs != false){
        
        $uf = $rs->uf;
        $estado = $rs->estado;
        $cidade = $rs->cidade;
        $nome = $rs->nome;
        $apelido = $rs->apelido;
        $sobrenome = $rs->sobrenome;
        $email = $rs->email;
        $sexo = $rs->sexo;
        $foto = $rs->foto;
        $cor = $rs->cabelo;
        $etnia = $rs->etnia;
        $altura = $rs->altura;
        $peso = $rs->peso;
        $dia = $rs->dia;
        $mes = $rs->mes;
        $ano = $rs->ano;
        $apresentacao = $rs->apresentacao;
        $cobrar = $rs->cobrar;
        $ddd1 = $rs->ddd1;
        $ddd2 = $rs->ddd2;
        $celular1 = $rs->celular1;
        $celular2 = $rs->celular2;
        $titulo = $rs->titulo;
        $valor = $rs->valor;
        $qtd_fotos = $rs->qtd_fotos;
        $qtd_videos = $rs->qtd_videos;
        $acompanha = $rs->acompanha;
        
        $senhaExcluir = $rs->senha;
        
        $sen = strlen($rs->senha);
        $cont = 0;
        $senha = '';
        while($cont < $sen){
            $senha = $senha.'*';
            $cont++;
        }
    }

    $rs = $controller->BuscarDadosPag();
    if($rs != null){
        $desconto = $rs->desconto;
        $valor = $valor - $desconto;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $diah = date('d');
    $diapag = '26';
    
    $pagMes = $controller->getStatusPagamento();
      
    if($pagMes == 'naopaga' and $diah == $diapag){//Ainda não pago

        $mensalidade = '<div class="mensalidade">
        Não esqueça de <a href="filiado-dados'.$php.'?editar=pagar-private">efetuar o pagamento </a> referente à este mês! Valor: '.$valor.',00
        </div>';

    }elseif($pagMes == 'promocao' and $diah == $diapag){
        $mensalidade = 
            '<div class="mensalidade">
                Neste mês sua mensalidade será gratuita devido a promoção! 
            </div>';
    }elseif($pagMes == 'atraso'){ //Será excluida

        $mensalidade = '<div class="mensalidade">
        Sua conta está desativada <a href="filiado-dados'.$php.'?editar=pagar-private">efetue o pagamento </a>
        referente à este mês ou sua conta será <span style="color:#8A0808">excluida!</span>! Valor: '.$valor.',00
        </div>';

    }elseif($pagMes == 'paga'){//Pago
        $mensalidade = '';

    }elseif($pagMes == 'excluido'){ //Excluia
        $mensalidade = 'Conta excluida';
    }else{
        $mensalidade = '';
    }
    
    
?>

    <?php echo $mensalidade ?>
    
    <h1 class="titulo_maior"> Olá, <?php echo $nome ?> </h1>

    <div class="content_foto_perfil"> <!-- *** Foto perfil *** -->
        <div class="foto_perfil">
            <img src="<?php echo $foto ?>" alt="Foto perfil">
        </div>
        
    </div>
    <div class="content_dados"> <!--  Dados Publicos do acompanhante  -->
        <p class="titulo"> Dados públicos 
            <a href="filiado-dados<?php echo $php ?>?editar=dados">
            <img src="icones/editar.ico" class="icone" title="editar" alt="Editar">
            </a>
        </p>
        <p> Estes dados são exibidos aos clientes para que eles possam saber detalhes sobre você </p>
        
        <ul class="lst_dados">
            <li> <p>Nome real:</p><?php echo $nome ?> </li>
            <li> <p>Nome público:</p><?php echo $apelido ?> </li>
            <li> <p> Nascimento: </p>   <?php echo $dia.'/'.$mes.'/'.$ano  ?> </li>
            <li> <p> E-mail: </p>       <?php echo $email ?> </li>
            <li> <p> Celular 1: </p>    <?php echo '('.$ddd1.')'.$celular1 ?> 
                 <img src="icones/whatsapp.png" class="icone" style="margin-top:-15px;"></li>
            <li> <p> Celular 2: </p>    <?php echo '('.$ddd2.')'.$celular2 ?> </li>
            <li> <p> Etnia: </p>        <?php echo $etnia ?> </li>
            <li> <p> Cor de cabelo:</p> <?php echo $cor ?> </li>
            <li> <p> Sexo: </p>         <?php echo $sexo ?> </li>
            <li> <p> Altura: </p>       <?php echo $altura ?> </li>
            <li> <p> Peso: </p>         <?php echo $peso ?> Kg </li>
            <li> <p> Cidade: </p>       <?php echo $cidade ?> </li>
            <li> <p> Estado: </p>       <?php echo $estado ?> </li>
            <li> <p> Atente: </p>       <?php echo $acompanha ?> </li>
        <li><p>Valor para contratar:</p><?php echo $cobrar ?>,00 / hora </li>
            <li> <p> Senha: </p>       <?php echo $senha ?> </li>
        </ul>
        <div class="apresentacao">
            <p> Apresentacao </p>
            <?php echo $apresentacao ?>
        </div>
    </div>
    <div class="content_midia"> <!-- ****** Imagens ****** -->
        <p class="titulo"> Imagens 
            <a href="filiado-fotos<?php echo $php ?>?editar=fotos">
            <img src="icones/editar.ico" class="icone" title="editar" alt="Editar">
            </a>
        </p>
        <p> Estas imagens serão exibidas no seu perfil, a quantidade de imagens é escolhida de acordo com o seu tipo de conta </p>
        
        <?php
            $controller = new ControllerAcompanhante();
            $rs = $controller->BuscarImagensFiliado();
            
            if($rs != false){
                $cont = 0;
                while($cont < count($rs)){
        ?>
            <div class="imgs">
                <img src="<?php echo $rs[$cont]->foto ?>" alt="Fotos">
            </div>
        
        <?php
                $cont++;
                }
            }
            if(count($rs) < $qtd_fotos){
        ?>
            <div class="imgs">
                <a href="filiado-fotos<?php echo $php ?>">
                    <img src="imagens/adicionar.png" alt="add imagem" title="adcionar imagem">
                </a>
            </div>
        <?php
            }
        ?>
        
        
        
        <div style="clear: both;"></div> 
    </div>

    <div class="content_midia"> <!-- ****** Videos ****** -->
        <p class="titulo"> Videos 
            <a href="filiado-fotos<?php echo $php ?>?editar=videos">
            <img src="icones/editar.ico" class="icone" title="editar" alt="Editar">
            </a>
        </p>
        <p> Estes videos serão exibidos no seu perfil, a quantidade é escolhida de acordo com o seu tipo de conta </p>
        
        <?php
            $controller = new ControllerAcompanhante();
            $rs = $controller->BuscarVideosFiliado();
            
            if($rs != false){
                $cont = 0;
                while($cont < count($rs)){
        ?>
            <div class="videos">
                <video width="350" height="300" controls loop controlsList="nodownload">
                    <source src="<?php echo $rs[$cont]->video ?>" type="video/mp4">
                    <object width="400" height="260">
                        <param name="allowFullScreen" value="true"/>
                        <param name="allowscriptaccess" value="always"/>
                    </object>
                </video>
            </div>
        
        <?php
                $cont++;
                }
            }
            if(count($rs) < $qtd_videos){
        ?>
            <div class="imgs">
                <a href="filiado-fotos<?php echo $php ?>">
                    <img src="imagens/adicionar.png" alt="add imagem" title="adcionar imagem">
                </a>
            </div>
        <?php
            }
        ?>
        
        <div style="clear: both;"></div> 
    </div>
    
    <?php
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
            $uf = $rs->uf;
            $cpf = $rs->cpf;
            $cvv = $rs->cvv;
            $desconto = $rs->desconto;
            $numero_cartao = $rs->numero_cartao;
            $expiracaoMes = $rs->expiracaoMes;
            $expiracaoAno = $rs->expiracaoAno;
            
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
        }
    ?>
    
    <div class="content_dados_seguranca"> <!-- *** Dados Privados *** -->
        <p class="titulo"> Dados privados <a href="filiado-dados<?php echo $php ?>?editar=dados-private">
            <img src="icones/editar.ico" class="icone" title="editar">
            </a>
        </p>
        <p> Os dados a seguir são ultilizados <b>apenas para efetuar o pagamento</b> e não serão compartilhados com nenhum outro usuário </p>
        
        <ul class="lst_dados">
            <li> <p>Nome:              </p><?php echo $nome ?> </li> 
            <li> <p>Sobrenome:         </p><?php echo $sobrenome ?> </li> 
            <li> <p>Telefone:          </p><?php echo '('.$ddd.')'.$telefone ?> </li> 
            <li> <p>CPF:               </p><?php echo $cpf ?> </li> 
            <li> <p>CEP:               </p><?php echo $cep ?> </li> 
            <li> <p>Rua:               </p><?php echo $rua ?> </li> 
            <li> <p>Numero:            </p><?php echo $numero ?> </li> 
            <li> <p>Bairro:            </p><?php echo $bairro ?> </li> 
            <li> <p>Cidade:            </p><?php echo $cidade ?> </li> 
            <li> <p>Estado:            </p><?php echo $uf ?> </li> 
            <li> <p>Numero do cartão:  </p><?php echo $numero_cartao ?> </li> 
            <li> <p>CVV:               </p><?php echo $cvv ?> </li> 
            <li> <p>Mês de expiração:  </p><?php echo $expiracaoMes ?> </li> 
            <li> <p>Ano de expiração:  </p><?php echo $expiracaoAno ?> </li> 
        </ul>
    </div>

    <div class="sua_conta" id="tipo_conta"> <!-- ****** Tipo de conta ****** -->
        <p class="titulo"> Seu tipo de conta </p>

        <div class="tipo_conta">
            <p class="titulo"> <?php echo $titulo ?> </p>
            <p class="valor"> Preço: <?php echo $valor ?>,00 / Mês </p>
            <p> Quantidade de fotos: <?php echo $qtd_fotos ?> </p>
            <p> Quantidade de videos: <?php echo $qtd_videos ?> </p>
        </div>
        
        <div class="clear"></div>
        
        <?php 
            $dia = date('d');
                                             
            if($pagMes == 'promocao' or $pagMes == 'paga' or $dia < 5 or $dia > $diapag){
        ?>
        
        <p class="clear"><a href="filiado-dados<?php echo $php ?>?editar=tipo-conta"> Alterar tipo de conta &raquo; </a></p>
        
        <?php  
            }else{ 
        ?>
        
        <p class="clear"> Não é possível alterar seu tipo de conta nos dias próximos ao pagamento </p>
        
        <?php  } ?>
    </div>

    <div id="delete_conta">
        <a href="#delete_conta" onclick="ShowCampoSenha()">
            <p> Exclur conta </p>
        </a>
        <div class="hide" id="abrirCampos">
            <p id="text"> Digite sua senha para continuar: </p>
            <input type="password" name="txtSenha" id="txtSenha" placeholder="senha">
            <input type="password" name="senha" id="senha" value="<?php echo $senhaExcluir ?>" class="hiden">
            <input type="submit" name="btnConfirmar" value="Confirmar" id="confirmar" onclick="confirmDelete()" class="botao">
            <a href="perfil-filiado<?php echo $php ?>"> Cancelar </a>
        </div>
    </div>
    <script src="js/jquery-3.2.1.min.js" ></script>
    <script>
        
        function ShowCampoSenha(){
            $('#abrirCampos').removeClass('hide');
            $('#delete_conta').css('height', '100px');
            
        }
        
        function confirmDelete(){
            
            txtsenha = $('#txtSenha').val();
            senha = $('#senha').val();
            
            if(txtsenha == senha){
                decisao = confirm('Deseja realmente exluir sua conta?')

                if(decisao){
                    window.location.href = "router<?php echo $php ?>?controller=acompanhante&modo=excluir";

                }else{
                    return false;
                }
            }else{
                $('#text').html('Senha invalida');
            }
        }
        
    </script>


