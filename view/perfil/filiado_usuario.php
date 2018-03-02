<?php
    
    $controller = new ControllerAcompanhante();
    $rs = $controller->BuscarDadosUsuario();
        
    if($rs != false){
        
        $uf = $rs->uf;
        $estado = $rs->estado;
        $cidade = $rs->cidade;
        $nome = $rs->nome;
        $sobrenome = $rs->sobrenome;
        $email = $rs->email;
        $senha = $rs->senha;
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
        $celular1 = $rs->celular1;
        $celular2 = $rs->celular2;
        $titulo = $rs->titulo;
        $valor = $rs->valor;
        $qtd_fotos = $rs->qtd_fotos;
        $qtd_videos = $rs->qtd_videos;
        
    }

    date_default_timezone_set('America/Sao_Paulo');
    $diah = (date('d'));

    if($diah == 02){
        $mensalidade = '<div class="mensalidade">
        Não esqueça de <a href="filiado-dados.php?editar=pagar-private">efetuar o pagamento </a> referente à este mês! Valor: '.$valor.',00
        </div>';
    }else{
        $mensalidade = '';
    }
    
?>

    <?php echo $mensalidade ?>
    
    <h1 class="titulo_maior"> Perfil <?php echo $nome ?> </h1>

    <div class="content_foto_perfil"> <!-- *** Foto perfil *** -->
        <div class="foto_perfil">
            <img src="<?php echo $foto ?>">
        </div>
        
    </div>
    <div class="content_dados"> <!--  Dados Publicos do acompanhante  -->
        <p class="titulo"> Dados públicos 
            <a href="filiado-dados.php?editar=dados">
            <img src="icones/editar.ico" class="icone" title="editar">
            </a>
        </p>
        <p> Estes dados são exibidos aos clientes para que eles possam saber detalhes sobre você </p>
        
        <ul class="lst_dados">
            <li> <p>Nome de usuário:</p><?php echo $nome ?> </li>
            <li> <p> Nascimento: </p>   <?php echo $dia.'/'.$mes.'/'.$ano  ?> </li>
            <li> <p> E-mail: </p>       <?php echo $email ?> </li>
            <li> <p> Celular 1: </p>    <?php echo $celular1 ?> </li>
            <li> <p> Celular 2: </p>    <?php echo $celular2 ?> </li>
            <li> <p> Etnia: </p>        <?php echo $etnia ?> </li>
            <li> <p> Cor de cabelo:</p> <?php echo $cor ?> </li>
            <li> <p> Sexo: </p>         <?php echo $senha ?> </li>
            <li> <p> Altura: </p>       <?php echo $altura ?> </li>
            <li> <p> Peso: </p>         <?php echo $peso ?> Kg </li>
            <li> <p> Cidade: </p>       <?php echo $cidade ?> </li>
            <li> <p> Estado: </p>       <?php echo $estado ?> </li>
        <li><p>Valor para contratar:</p><?php echo $cobrar ?>,00 </li>
        </ul>
        <div class="apresentacao">
            <p> Apresentacao </p>
            <?php echo $apresentacao ?>
        </div>
    </div>
    <div class="content_midia"> <!-- ****** Imagens ****** -->
        <p class="titulo"> Imagens 
            <a href="filiado-fotos.php?editar">
            <img src="icones/editar.ico" class="icone" title="editar">
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
                <img src="<?php echo $rs[$cont]->foto ?>">
            </div>
        
        <?php
                $cont++;
                }
            }
            if(count($rs) < $qtd_fotos){
        ?>
            <div class="imgs">
                <a href="filiado-fotos.php">
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
        <p class="titulo"> Dados privados <a href="filiado-dados.php?editar=dados-private">
            <img src="icones/editar.ico" class="icone" title="editar">
            </a>
        </p>
        <p> Os dados a seguir são ultilizados <b>apenas para efetuar o pagamento</b> e não serão compartilhados com nenhum outro usuário </p>
        
        <ul class="lst_dados">
            <li> <p>Nome:              </p><?php echo $nome ?> </li> 
            <li> <p>Sobrenome:         </p><?php echo $sobrenome ?> </li> 
            <li> <p>Telefone:          </p><?php echo '('.$ddd.')'.$telefone ?> </li> 
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

    <div class="sua_conta"> <!-- ****** Tipo de conta ****** -->
        <p class="titulo"> Seu tipo de conta </p>

        <div class="tipo_conta">
            <p class="titulo"> <?php echo $titulo ?> </p>
            <p class="valor"> Preço: <?php echo $valor ?>,00 / Mês </p>
            <p> Quantidade de fotos: <?php echo $qtd_fotos ?> </p>
            <p> Quantidade de videos: <?php echo $qtd_videos ?> </p>
        </div>
        
        <div class="clear"></div>
        
        <p class="clear"> Alterar tipo de conta &raquo; </p>
        
    </div>