    <?php 
    
        if(isset($_GET['login'])){
            
            if($_GET['login'] == 'cliente' || $_GET['login'] == 'acompanhante'){
                $modo = $_GET['login'];   
                
            }else{
                $modo = 'cliente';
            }
            
        }else{
            $modo = 'cliente';
            
        }
    
    ?>

    <form action="router.php?controller=<?php echo($modo); ?>&modo=logar" method="post" id="login">
        
        <h1 class="titulo centro"> 
            <?php
                if($modo == 'cliente'){
                    echo("Fazer login como cliente");
                    $desc = "Faça o login e contrate um dos nossos acompanhantes.";
                    $link = "seja-cliente.php";
                    
                }else{
                    echo("Fazer login como acompanhante");
                    $desc = "Faça o login para que você possa ser contratado como acompanhante.";
                    $link = "seja-filiado.php";
                }
            ?>
            
        </h1>
        
        <div class="alinhar">
        
            <p> Usuário </p>
            <input type="text" name="txtEmail" placeholder="E-mail"/>

            <p> Senha </p>
            <input type="password" name="txtSenha" placeholder="Senha"/>
        
        </div>
        
        <p class="botao_alinhar">
            <input type="submit" name="btnLogar" value="Logar" class="botao"/> 
        </p>
        
        <p class="desc"><?php echo ($desc); ?></p>
        
        
        <p class="cadastre_se">
            Ainda não tem uma conta? Clique <a href="<?php echo($link) ?>"> aqui </a>
            e cadastre-se!
        </p>
        
    </form>