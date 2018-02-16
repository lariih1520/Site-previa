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
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		
    <?php
        if(!empty($_GET)){
            if($_GET['perfil'] == 'acompanhante'){ ?>  
        
        <link rel="stylesheet" type="text/css" href="css/estilo_perfil_filiado.css" /> 
    
    <?php   }else{ ?>  
        
        <link rel="stylesheet" type="text/css" href="css/estilo_perfil_cliente.css" /> 
    
    <?php
            }
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
                    
                    if (!empty($_GET)){
                        
                        if ($_GET['perfil'] == 'acompanhante'){
                            include_once('view/perfil_filiado.php'); 
                            
                        } else {
                            include_once('view/perfil_cliente.php'); 
                        }
                        
                    }elseif (empty($_GET)){
                        header('location:login.php');
                    }
                ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>