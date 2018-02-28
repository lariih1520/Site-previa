<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Perfil do usuário </title>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="pt-br" />
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
        
    <?php
        /* Ver perfil do acompanhante */
        if(!empty($_GET['codigo'])){ ?>  
        
        <link rel="stylesheet" type="text/css" href="css/estilo_perfil_filiado.css" /> 
    
    <?php 
        /* O acompanhante ver o próprio perfil */
        }else{ 
    ?>
        
        <link rel="stylesheet" type="text/css" href="css/estilo_filiado.css" /> 
        
    <?php   
        }
    ?>
	</head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php
                    
                include_once('view/perfil_filiado_view.php'); 
                        
                ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>