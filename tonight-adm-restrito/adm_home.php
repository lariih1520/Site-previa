<?php 
    include_once('controller/session.php'); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight Administração - HOME </title>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="pt-br" />
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
        <link rel="icon" type="icone/png" href="../imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_adm_home.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
             
             $('#imagem').live('change',function(){
                 
                 $('#visualizar').html('<img src="icones/ajax-loader.gif" alt="Enviando..."/>');
                 setTimeout(function(){

                     /* Efetua o Upload sem dar refresh na pagina */           
                        $('#formulario').ajaxForm({
                        target:'#visualizar' 
                        }).submit();

                 });

             });
            
            	 
            $('#btnSalvar').click(function(){
                /*Coloca a imagem de processando após o click do botao*/
                $('#visualizar').html('Salvando:<img src="icones/ajax-salvando.gif" alt="Salvando..."/>');

                /*Cria um temporizador automatico de 2 segundos para chamar o post da página*/
                setTimeout(function(){
                    
                    $('#formulario').attr('action', 'router.php?controller=home&modo=inserir');
                    $('#formulario').submit();

                });

            });
		
         })


        </script>
	</head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php include_once('view/adm_home_view.php'); ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.php'); ?>
		</div>
	</body>
</html>