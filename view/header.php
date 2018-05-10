    <?php
        
        if(!isset($_GET['r'])) {
            if(empty($_GET)){
                echo "
                <script> 
                document.location=\"?r=1&Largeur=\"+screen.width+\"&Hauteur=\"+screen.height; 
                </script>"; 
            }else{
                echo "
                <script> 
                document.location=\"".$_SERVER['REQUEST_URI']."&r=1&Largeur=\"+screen.width+\"&Hauteur=\"+screen.height; 
                </script>"; 
            }
        }
    
        if(!empty($_SESSION['id_cliente'])){
            $lgrc = true;
            $lgrf = false;
            $perfil = 'perfil-cliente'.$php.'?';
            
        }else{
            $perfil = '';
            $lgrc = false;
            $lgrf = false;
        }

        if(!empty($_SESSION['id_filiado'])){
            $lgrf = true;
            $perfil = 'perfil-filiado'.$php.'?';
            
        }elseif(empty($_SESSION['id_cliente'])){
            $perfil = 'login'.$php.'?';
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
                if ($lgrc == true or $lgrf == true) {
            ?>
            <a href="inicio<?php echo $php ?>?sair">
                <img src="icones/power.png" class="icon" alt="Sair">
            </a>
            <?php
                }
            ?>
            <a href="<?php echo $perfil ?>confirguracoes">
                <img src="icones/config.png" class="icon" alt="Configuraçãoes">
            </a>
        </div>
    </nav>
    <header>
        <div id="content_header"> 
            <div id="content_logo">
                <a href="index<?php echo $php ?>">
                   <img src="imagens/logo.png" id="logo" title="Tonight.net" alt="logo tonight">
                </a>
            </div>
            <ul class="lst_menu">
                <li><a href="inicio<?php echo $php ?>"> Home </a></li>
                <li><a href="localidade<?php echo $php ?>"> Filtrar por estado </a></li>
                <?php
                    if($lgrf == false){
                ?>
                <li><a href="seja-filiado<?php echo $php ?>"> Seja acompanhante </a></li>
                <?php
                    }
                ?>
                <li><a href="exibir-todos<?php echo $php ?>"> Ver todos </a></li>
                <li><a href="sobre-o-site<?php echo $php ?>"> Sobre </a></li>
            </ul>
            <div class="content_logar">
                <?php
                    if($lgrc == false and $lgrf == false){
                ?>
                <div class="botao_header">
                    <a href="login<?php echo $php ?>"> Fazer login </a>
                </div>
                <div class="tipo_login">
                    <p><a href="login<?php echo $php ?>?login=cliente"> Sou cliente </a></p>
                    <p><a href="login<?php echo $php ?>?login=acompanhante"> Sou acompanhante </a></p>

                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        
    </header>