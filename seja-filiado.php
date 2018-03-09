<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Cadastre-se e seja um de nossos acompanhantes </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Seja um de nossos acompanhantes e divulgue-se, basta se cadastrar" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas, cadastre-se, ser acompanhante de luxo" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_seja_filiado.css" />
    </head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php include_once('controller/filiado.php'); ?>
                <?php include_once('view/seja_filiado_view.php'); ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
        
        <script src="js/jquery-3.2.1.min.js" ></script>
        <script>
            
            function addClass(opt){
                
                opt.addClass('selecionado');
            }
            
            function termos(){
                
                if(document.getElementById('check').checked == true){ 	 
                    document.getElementById('btnConcordo').disabled = ""; 
                    $('#btnConcordo').removeClass('desabilitado');
                }  
                if(document.getElementById('check').checked == false){
                    document.getElementById('btnConcordo').disabled = "disabled";
                    $('#btnConcordo').addClass('desabilitado');
                }
            }
            

                //conta.classList.toggle('selecionado');
        </script>    
	</body>
</html>