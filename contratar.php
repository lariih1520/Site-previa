<?php
    require_once('view/extencao.php');

    session_start();

    if(!empty($_GET['codigo'])){
        $cod = $_GET['codigo'];
        
        if(empty($_SESSION['id_cliente'])){
            header('location:login'.$php.'?redirect=contrate&cod='.$cod);
        }
        
    }else{
        header('exibir-todos'.$php);
    }

    if(!empty($_SESSION['id_filiado'])){
        echo 'alert("Você está logado como acompanhante")';
        header('location:login'.$php);
    }
    
    
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Contrate </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa, contra-te" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas, cadastre-se" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_contrar.css" />
	</head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php
                    include_once('controller/filiado_controller.php');
                    include_once('controller/cliente_controller.php');
                    include_once('view/contratar_view.php');
                ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>