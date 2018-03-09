<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight </title>
		<meta charset="UTF-8">
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	</head>
    <?php 
        
        require_once('controller/index_controller.php');
        $controller = new ControllerIndex();
        $rs = $controller->BuscarImagens();
    
        if($rs != null || $rs != '-'){
            
            $cont = 0;
            
            while($cont < count($rs)){
                $imagem[$cont] = "style=\"background-image:url('".$rs[$cont]->imagem."');\" ";
        
                $cont++;
            }
            
        }else{
            $cont = 0;
            while($cont <= 5){
                $imagem[$cont] = "";
                
                $cont++;
            }
        }
    
    ?>
	<body <?php echo $imagem[0] ?>>
        <?php
            
            if(!empty($_SESSION['id_cliente'])){
                $lgrc = true;
                $msg = '<a href="perfil?perfil=cliente"> Ir para o perfil </a>';

            }else{
                $lgrc = false;
                $msg = '<a href="login"> Faça Login </a>';
            }
            
            
        ?>
		<div id="principal_index">
			
            <div id="introducao">
                <p> Precisa de um acompanhante? </p>
                  
                Entre e veja as opções que temos disponíveis para contratar de forma rápida e fácil.
                
                <p class="alerta"> (SE VOCÊ TIVER MAIS DE 18 ANOS) </p>
                <div class="termos"> 
                    Ao entrar no site você concorda com os <a href="sobre-o-site.php"> Termos de uso </a>
                    do site
                </div>
            </div>
            
            <div id="menu_index">
                <div id="fazer_login" <?php echo $imagem[1] ?>> <?php echo $msg ?> </div>
                <div id="ir_site" <?php echo $imagem[2] ?>><a href="inicio"> Ir para o site </a></div>
                <div id="ver_homens" <?php echo $imagem[3] ?>><a href="inicio?#homens"> Homens </a></div>
                <div id="ver_mulheres" <?php echo $imagem[4] ?>><a href="inicio?#mulheres"> Mulheres </a></div>
                <div id="seja_filiado" <?php echo $imagem[5] ?>><a href="seja-filiado"> Seja um dos nossos filiados </a></div>
            </div>
            
		</div>
	</body>
</html>