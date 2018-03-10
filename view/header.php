    <?php
        
        if(!empty($_SESSION['id_cliente'])){
            $lgrc = true;
            $perfil = 'perfil-cliente'.$php.'?';
            
        }else{
            $perfil = '';
            $lgrc = false;
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
                if ($lgrc == true || $lgrf == true) {
            ?>
            <a href="inicio<?php echo $php ?>?sair">
                <img src="icones/power.png" class="icon" alt="Sair">
            </a>
            <?php
                }
            ?>
            <a href="<?php echo $perfil ?>notification">
                <img src="icones/sino.png" class="icon" alt="Notificações">
            </a>
            <a href="<?php echo $perfil ?>confirguracoes">
                <img src="icones/config.png" class="icon" alt="Configuraçãoes">
            </a>
        </div>
    </nav>
    <header>
        <div id="content_header"> 
            <div id="content_logo">
                <a href="index<?php echo $php ?>">
                   <img src="imagens/logo.png" id="logo" title="Tonight" alt="logo tonight">
                </a>
            </div>
            <ul class="lst_menu">
                <li><a href="inicio<?php echo $php ?>"> Home </a></li>
                <li><a href="localidade<?php echo $php ?>"> Filtrar por estado </a></li>
                <?php
                    if($lgrc == false and $lgrf == false){
                ?>
                <li><a href="seja-cliente<?php echo $php ?>"> Cadastre-se </a></li>
                
                <?php
                    }
                ?>
                <li><a href="seja-filiado<?php echo $php ?>"> Seja acompanhante </a></li>
                <li><a href="sobre-o-site<?php echo $php ?>"> Sobre </a></li>
            </ul>
            <div class="content_logar">
                <?php
                    if($lgrc == false && $lgrf == false){
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