<?php
    require_once('view/extencao.php');
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Filtrar acompanhantes por cidade </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_locais.css" />
	</head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <div id="conteudo">
                <?php include_once('view/locais_view.php'); ?>
            </div>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>