    <span class="voltar"><a href="index.php"> &larr; Voltar </a></span>
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
            $id = $_GET['code'];
    ?>
        <div class="vizualisar lado">
            <img src="../<?php echo $img ?>">
            <p> Pertence ao usuário de código: <?php echo $id ?> </p>
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
                $filiado = $rs[$cont]->filiado;
    ?>
        
            <li><img src="../<?php echo $img ?>">
                <p><a href="?ver=<?php echo $img ?>&code=<?php echo $filiado ?>#content_bar">Ver</a></p>
                <p><a href="router.php?controller=home&modo=excluir&id=<?php echo $id_home ?>#imagem">Excluir</a></p>
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
    
    <div class="titulo"> Adicionar fotos dos usuários ao slide </div>
   
    <div id="img_todas">
        <ul class="lst_fotos">
    <?php
        require_once('controller/filiado_controller.php');
        $controller = new ControllerAcompanhante();
        $rs = $controller->ListarAcompanhantes();

        $cont = 0;
        if($rs != false){
            
            while($cont < count($rs)){
                $id = $rs[$cont]->id_filiado;
                $img = $rs[$cont]->foto;
                $nome = $rs[$cont]->nome;
    ?>
        
            <li>
                <form action="router.php?controller=home&modo=inserir&id=<?php echo $id ?>" method="post" id="form">
                    <div>
                        <img src="../<?php echo $img ?>">
                    </div>
                    <input type="text" name="txtIdFiliado" class="hide" value="<?php echo $img ?>">
                    <p><input type="submit" name="btnSalvar" value="Adicionar" class="add"></p>
                    <p><?php echo $nome ?></p>
                </form>
                
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
    