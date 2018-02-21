    <?php
        session_start();
        
        if(!empty($_SESSION['id_cliente'])){
            $lgrc = true;
            $perfil = 'cliente';
            
        }else{
            $perfil = '';
            $lgrc = false;
        }

        if(!empty($_SESSION['id_filiado'])){
            $lgrf = true;
            $perfil = 'acompanhante';
            
        }else{
            $perfil = '';
            $lgrf = false;
        }

        if(isset($_GET['sair'])){
            $lgrc = false;
            $lgrf = false;
            session_destroy();
        }
        
    ?>
    
    <nav>
        <div id="barra_superior"> 
            <?php
                if ($lgrc == true || $lgrf == true) {
            ?>
            <a href="inicio.php?sair">
                <img src="icones/power.png" class="icon">
            </a>
            <?php
                }
            ?>
            <a href="perfil.php?perfil=<?php echo $perfil ?>&notification">
                <img src="icones/sino.png" class="icon">
            </a>
            <a href="perfil.php?perfil=<?php echo $perfil ?>&confirguracoes">
                <img src="icones/config.png" class="icon">
            </a>
        </div>
    </nav>
    <header>
        <div id="content_header"> 
            <div id="content_logo">
                <a href="index.php">
                   <img src="imagens/logo.png" id="logo" title="Tonight" alt="logo tonight">
                </a>
            </div>
            <ul class="lst_menu">
                <li><a href="inicio.php"> Home </a></li>
                <li><a href="localidade.php"> Filtrar por estado </a></li>
                <?php
                    if($lgrc == false || $lgrf == false){
                ?>
                <li><a href="seja-cliente.php"> Cadastre-se </a></li>
                
                <?php
                    }
                ?>
                <li><a href="seja-filiado.php"> Seja acompanhante </a></li>
                <li><a href="sobre-o-site.php"> Sobre </a></li>
            </ul>
            <div class="content_logar">
                <?php
                    if($lgrc == false && $lgrf == false){
                ?>
                <div class="botao_header">
                    <a href="login.php"> Fazer login </a>
                </div>
                <div class="tipo_login">
                    <p><a href="login.php?login=cliente"> Sou cliente </a></p>
                    <p><a href="login.php?login=acompanhante"> Sou acompanhante </a></p>

                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        
    </header>