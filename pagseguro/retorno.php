<?php
    if(isset($_POST['notificationType'])){
        require_once('notificacao.php');
    }
    
    if(isset($_GET)){
        require_once('notificacao.php');
    }
    
?>
<html>
    <head>
        <title> Tonight.net - pagamento realizado com Sucesso </title>
        <meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Paganmento da mensalidade do hóspede do site" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, pagamento" />
        <link rel="icon" type="icone/png" href="../imagens/logo.png">
    </head>
    <body>
        <p> <a href="../perfil-filiado.php"> &larr; Voltar ao perfil </a> </p>
        <?php
            if(isset($_POST['VendedorEmail'])){
                echo '<p>Data da transacao:</p>';
                echo $_POST['DataTransacao'];
                
                echo '<p>Transação ID:</p>';
                echo $_POST['TransacaoID'];
                
                echo '<p>Valor Frete:</p>';
                echo $_POST['ValorFrete'];
                
                echo '<p>DataTransacao:</p>';
                echo $_POST['DataTransacao'];
            }
        
        ?>
        
        
    </body>
</html>
