<?php
    $id = $_GET['codigo'];

    $controller = new ControllerAcompanhante();

    if(isset($_GET['r'])){@$controller->ClienteVizualizar();}
    
    $rs = $controller->BuscarDadosUsuario();

    if($rs != null and $rs->excluido == null){
        
        $deleted = $rs->excluido;
        $id_filiado = $rs->id_filiado;
        $foto = $rs->foto;
        $nome = $rs->apelido;
        $altura = $rs->altura;
        $peso = $rs->peso;
        $sexo = $rs->sexo;
        $acompanha = $rs->acompanha;
        $celular1 = '('.$rs->ddd1.')'.$rs->celular1;
        $celular2 = '('.$rs->ddd2.')'.$rs->celular2;
        $apresentacao = $rs->apresentacao;
        $cobrar = $rs->cobrar;
        $etnia = $rs->etnia;
        $idetnia = $rs->idetnia;
        $uf = $rs->uf;
        $cidade = $rs->cidade;
        
        $tamanhoApresent = strlen($apresentacao);
        
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
        
        if(!empty($_SESSION['id_cliente'])){
            require_once('controller/cliente_controller.php');
            $controllerCliente = new ControllerCliente();
            $rs = $controllerCliente->FiliadoEmLista($id_filiado);
        }else{
            $rs = true;
        }
        if($rs == true){
            $action = '#content_perfil';
            $msg = 'Em minha lista';
        }else{
            $action = "router.php?controller=cliente&modo=addLista";
            $msg = 'Adicionar a minha lista';
        }
        
        
        
    if(empty($_SESSION['id_cliente'])){
        $href = 'login.php';
        $msg = 'Adicionar a minha lista';
    }else{
        $href = '#content_perfil';
    }
?>
    <div id="content_perfil">
        <form action="<?php echo $action ?>" method="post" id="form">
            <p id="addLista">
                <a href="<?php echo $href ?>" onclick="form.submit();"> <?php echo $msg ?> </a>
            </p>
            <input type="text" name="txtIdFiliado" value="<?php echo $id_filiado ?>" class="hide">
        </form>
            
        <div class="perfil">
            <div id="pefil">
                <div class="foto_perfil">
                    <img src="<?php echo $foto ?>" alt="Foto perfil">
                    <div class="tonight"></div>
                </div>
                <div class="apresentacao">
                    <?php echo $apresentacao; ?>
                </div>
            </div>
        </div>

        <div id="dados_perfil">

            <p class="titulo"> Nome:  <?php echo $nome ?></p>
            <ul class="lst_dados">
                <li> Idade:  <?php echo $idade ?></li>
                <li> Altura: <?php echo $altura ?></li>
                
                <?php if($peso != null){ ?>
                
                <li> Peso:   <?php echo $peso; ?> Kg </li>
                
                <?php } ?>
                
                <li> Sexo:   <?php echo $sexo ?></li>
                <li> Valor:  R$ <?php echo $cobrar ?>,00 / hora </li>
                <li> Etnia:   <?php echo $etnia ?> </li>
                <li> Estado:   <?php echo $uf ?> </li>
                <li> Cidade:   <?php echo $cidade ?> </li>
            </ul>
        </div>
        <div class="sugestoes">
            <ul class="lst_dados">
                <li> Atende: <?php echo $acompanha ?>  </li>
                <li> Celular 1: <?php echo $celular1 ?> <img src="icones/whatsapp.png" alt="whatsapp" class="icone"></li>
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
            <div class="tonight"></div>
        </div>
<?php
            $cont++;
        }
    }
?>
        <div style="clear:both;"></div>
    </div>

    <div id="midia">
<?php
    $rs = $controller->BuscarVideosFiliado();
    
    if($rs != false){
        $cont = 0;
        
        while($cont < count($rs)){
?>
        <div class="videos_filiado">
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
?>
        <div style="clear:both;"></div>
    </div>

<?php
        
}else{
    echo '<p class="conta_null"> Conta inesistente </p>';
    $sexo = 0;
    $idetnia = 0;
}
    if($sexo == "Masculino"){
        $sexo = 2;
    }elseif($sexo == "Feminino"){
        $sexo = 1;
    }

    $controller = new ControllerAcompanhante();
    $resp = $controller->BuscarFiliadosSexo($sexo, $idetnia, 3, $id);

    if($resp != null){
?>

    <div id="sugestoes">
        <p class="titulo">Sugestões</p>
        <ul class="lst_sugestoes">
        
        <?php
            $cont = 0;
            while($cont < count($resp)){
        ?>
        
            <li>
                <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $resp[$cont]->id ?>">
                    <span class="perfil_sugestao">
                         <p> Nome: <?php echo $resp[$cont]->apelido ?></p>
                         <p> Estado: <?php echo $resp[$cont]->uf ?></p>
                         <p> Idade: <?php echo $resp[$cont]->idade ?></p>
                    </span>
                </a>
                <img src="<?php echo $resp[$cont]->foto  ?>" alt="Foto" class="img_peril">
                <div class="tonight"></div>
            </li>
        
        <?php
                $cont++;
            }
            
        ?>
        
        </ul>        
    </div>

<?php
              
    }

?>