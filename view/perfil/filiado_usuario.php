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
        $cobrar = $rs->cobrar;
        $celular1 = $rs->celular1;
        $celular2 = $rs->celular2;
        $titulo = $rs->titulo;
        $valor = $rs->valor;
        $qtd_fotos = $rs->qtd_fotos;
        $qtd_videos = $rs->qtd_videos;
        
    }

?>

    <h1 class="titulo_maior"> Perfil <?php echo $nome ?> </h1>
    
    <div class="content_foto_perfil"> <!-- *** Foto perfil *** -->
        <div class="foto_perfil">
            <img src="<?php echo $foto ?>">
        </div>
        
    </div>
    <div class="content_dados"> <!--  Dados Publicos do acompanhante  -->
        <p class="titulo"> Dados publicos </p>
        <ul class="lst_dados">
            <li> <p> Nome: </p>         <?php echo $nome ?> </li>
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
        
    </div>
    <div class="content_midia"> <!-- ****** Imagens ****** -->
        <p class="titulo"> Imagens </p>
        
        <div class="imgs">
            
        </div>
        <div class="imgs">
            
        </div>
        <div class="imgs">
            
        </div>
        
        <div style="clear: both;"></div> 
    </div>
    <div class="content_dados_seguranca"> <!-- *** Dados Privados *** -->
        <p class="titulo"> Dados privados </p>
            Ainda não cadastrados
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