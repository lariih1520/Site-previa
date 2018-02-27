    <span class="voltar"><a href="default.php"> &larr; Voltar </a></span>
    <center><h1 class="titulo"> Gerenciamento da página home </h1></center>

    <div id="content_bar">

        <form method="post" enctype="multipart/form-data" action="upload.php" id="formulario" class="adicione lado">
            <div id="visualizar" class="imagem_add">

            </div>
            <p><input type="file" id="imagem" name="flFoto" ></p>
            <a href="adm_home.php"> Ok </a>
        </form>
        
    <?php
        
        if(isset($_GET['ver'])){
            $img = $_GET['ver'];
    ?>
        <div class="vizualisar lado">
            <img src="../<?php echo $img ?>">
        </div>
    <?php
        }
    ?>
    </div>

    <div class="titulo"> Todas as imagens do Slide </div>
   
    <div id="img_todas">
        <ul class="lst_fotos">
    <?php
        require_once('controller/home_controller.php');
        $controller = new ControllerHome();
        $rs = $controller->BuscarFotos();

        $cont = 0;
        if($rs != false){
            
            while($cont < count($rs)){
                $id_home = $rs[$cont]->id_home;
                $img = $rs[$cont]->imagem;
    ?>
        
            <li><img src="../<?php echo $img ?>">
                <p><a href="?ver=<?php echo $img ?>#content_bar">Ver</a></p>
                <p><a href="router.php?controller=home&modo=excluir&id=<?php echo $id_home ?>">Excluir</a></p>
            </li>
        
    <?php
                $cont++;
            
            }
            
        }else{
            echo 'Ainda não há imagens';
            
        }
        
    ?>
        </ul>
    </div>
    