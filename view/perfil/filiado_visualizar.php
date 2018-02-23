<?php
    $id = $_GET['codigo'];

    $controller = new ControllerAcompanhante();
    $rs = $controller->BuscarDadosUsuario();

    if($rs != null){
        
        $foto = $rs->foto;
        $nome = $rs->nome;
        $altura = $rs->altura;
        $peso = $rs->peso;
        $sexo = $rs->sexo;
        $acompanha = $rs->acompanha;
        $celular1 = $rs->celular1;
        $celular2 = $rs->celular2;
        $apresentacao = $rs->apresentacao;
        
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        $data_hoje = date('d/m/Y');
        $dt_hoje = explode('/', $data_hoje);
        $dia_hoje = $dt_hoje[0];
        $mes_hoje = $dt_hoje[1];
        $ano_hoje = $dt_hoje[2];
        $dia = $rs->dia;
        $mes = $rs->mes;
        $ano = $rs->ano;
        $anos = $ano_hoje - $ano;
        
        /* Verificar idade */
        if ($mes < $mes_hoje) {
            $idade = $anos;

        } elseif ($mes == $mes_hoje) {

            if ($dia <= $dia_hoje) {
                $idade = $anos;

            } else {
                $idade = $anos - 1;
            }

        }else{
            $idade = $anos - 1;
        }

    }
?>
    <div id="content_perfil">
        <div class="perfil">
            <div id="pefil">
                <div class="foto_perfil">
                    <img src="<?php echo $foto ?>">
                </div>
                <div class="apresentacao">
                    <?php echo $apresentacao; ?>
                </div>
            </div>
            <div class="contrate">
                <a href="contratar.php?acompanhante=<?php echo $id ?>">
                    <p class="botao"> Contrate! </p>
                </a>
            </div>
        </div>

        <div id="dados_perfil">

            <p class="titulo"> Nome:  <?php echo $nome ?></p>
            <ul class="lst_dados">
                <li> Idade:  <?php echo $idade ?></li>
                <li> Altura: <?php echo $altura ?></li>
                <li> Peso:   <?php if($peso){ echo $peso; } ?></li>
                <li> Sexo:   <?php echo $sexo ?></li>
            </ul>
            <!--- Se a apresentação for muito grande
            <div class="contrate">
                <p class="botao">Contrate!</p>
            </div>
            -->
        </div>
        <div class="sugestoes">
            <ul class="lst_dados">
                <li><p> Acompanha: </p> <?php echo $acompanha ?>  </li>
                <li> Celular 1: <?php echo $celular1 ?> </li>
                <li> Celular 2:  <?php echo $celular2 ?> </li>
            </ul>
        </div>
    </div>
    

    <div id="midia">
<?php
    $rs = $controller->BuscarImagensFiliado();
    
    if($rs != false){
        $cont = 0;
        
        while($cont < count($rs)){
?>
        <div class="imgs_filiado">
            <img src="<?php echo $rs[$cont]->foto ?>" alt="foto do usuário">
        </div>
<?php
            $cont++;
        }
    }
?>
        <div style="clear:both;"></div>
    </div>

    <div id="sugestoes">
        <p class="titulo">Sugestões</p>
        <div> </div>
    </div>