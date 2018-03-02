<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Alterar dados </title>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="pt-br" />
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa, basta se cadastrar" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas, cadastre-se" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_filiado_dados.css" />
	</head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
            <?php
                if($_GET['editar'] == 'pagar-private' & empty($_GET['forma'])){
            ?>
                <h1 class="titulo_maior"> Quase lá! </h1>
                <div class="formas_pag">
                    <div class="seleciona">
                        <a href="filiado-dados.php?editar=pagar-private&forma=boleto">
                            <p> Escolher a opção: </p>
                            Boleto
                        </a>
                    </div>
                    <div class="seleciona">
                        <a href="filiado-dados.php?editar=pagar-private&forma=card">
                            <p> Escolher a opção: </p>
                            Cartão de crédito
                        </a>
                    </div>
                </div>
            <?php
                }else{
                    
                    include_once('controller/filiado_controller.php');
                    include_once('view/filiado_dados_view.php');
                        
                }
            ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>