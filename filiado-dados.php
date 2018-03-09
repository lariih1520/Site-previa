<?php
    session_start();

    if(empty($_SESSION['id_filiado'])){
        header('location:login.php?login=acompanhante');
    }
    if(empty($_GET['editar'])){
        header('location:perfil-filiado.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Alterar dados </title>
		<meta charset="UTF-8">
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
                include_once('controller/filiado_controller.php');
                
                $controller = new ControllerAcompanhante();
                $rs = $controller->BuscarDadosUsuario();
                
                if($rs != false){
                    $valor = $rs->valor;
                }
                
                $pagMes = $controller->getStatusPagamento();
                if($pagMes > 1){
                    $deve = $valor * $pagMes;
                }
                
                if($_GET['editar'] == 'pagar-private' & empty($_GET['forma'])){
            ?>
                <h1 class="titulo_maior"> Quase lá! </h1>
                <div class="formas_pag">
                    <div class="seleciona">
                        <a href="filiado-dados.php?editar=pagar-private&forma=boleto">
                            <p> Escolher a opção: </p>
                            Boleto
                            <p><?php echo 'Valor: R$'.$deve.',00'; ?></p>
                        </a>
                    </div>
                    <div class="seleciona">
                        <a href="filiado-dados.php?editar=pagar-private&forma=card">
                            <p> Escolher a opção: </p>
                            Cartão de crédito
                            <p><?php echo 'Valor: R$'.$deve.',00'; ?></p>
                        </a>
                    </div>
                </div>
            <?php
                }else{
                    
                    include_once('view/filiado_dados_view.php');
                        
                }
            ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>