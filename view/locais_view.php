<?php
    require_once('controller/filiado_controller.php');
    $controller = new ControllerAcompanhante();
    $rs = $controller->EstadosFiliados();

    if($rs != false){
        
        $cont = 0;
        while($cont < count($rs)){
?>
    <a href="?uf=<?php echo $rs[$cont] ?>">
        <div class="content_estado">
            <p> Estado de <?php echo $rs[$cont] ?> </p>

        </div>
    </a>
<?php
            $cont++;
        }
    }
?>
    <div style="clear:both;"></div>


    <div id="lista">
    <p class="pesquisa"><a href="?"> Limpar pesquisa </a></p>
        
<?php
    $uf = 1;
        
    if(isset($_GET['uf'])){
        $uf = $_GET['uf'];
    }
        
    $controller = new ControllerAcompanhante();
    $rs = $controller->ListarFiliadosEstado($uf);

    if($rs != false){
        
        $cont = 0;
        while($cont < count($rs)){
?>
    <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $rs[$cont]->id ?>">    
        <div class="filiado">
            <img src="<?php echo $rs[$cont]->foto ?>" alt="Foto de perfil">
            <p> Nome: <?php echo $rs[$cont]->apelido ?> </p>
            <p> Estado: <?php echo $rs[$cont]->uf ?> </p>
        </div>
    </a>
        
<?php
            $cont++;
        }
    }else{
        echo '<center> Ainda não há acompanhnates cadastrados </center>';
    }
?>
        <div style="clear:both;"></div>
    </div>