<?php
    require_once('view/extencao.php');
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
            <?php 
                include_once('view/header.php');
                include_once("model/inicio_class.php");
            ?>
            
            <div id="cetralizar_divs">
            <!--         IMAGENS LATERAIS          -->
            <?php if(!empty($_GET['Largeur']) and $_GET['Largeur'] >= 1100){ ?>
            
                <ul class="listUsuarios">
                <?php
                    
                    $controller = new Inicio();
                    $resultsimg = $controller->ImagensLaterais();
                    
                    if($resultsimg != false){
                        
                        if(count($resultsimg) > 1){
                            $imgslt1 = round((count($resultsimg) / 2));
                        }else{
                            $imgslt1 = count($resultsimg);
                        }
                        
                        $cont = 0;
                        while($cont < $imgslt1){
                            $img = $resultsimg[$cont]->foto;
                ?>
                    <li>
                        <a href="perfil-filiado.php?codigo=<?php echo $resultsimg[$cont]->id ?>"> 
                        <img src="<?php echo $img; ?>" alt="Perfil usuário"> 
                        <img src="imagens/tonight.png" alt="tonight" class="tonigimg">
                        </a>
                    </li>
                <?php
                            $cont++;
                        }
                    }
                ?>
                </ul>
            <?php } ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php include_once('controller/filiado.php'); ?>
                <?php include_once('controller/filiado_controller.php'); ?>
                <?php include_once('view/seja_filiado_view.php'); ?>
            </section>
            
            <!--         IMAGENS LATERAIS          -->
            <?php if(!empty($_GET['Largeur']) and $_GET['Largeur'] >= 1330){ ?>
            
                <ul class="listUsuarios">
                <?php
                    $cont = $imgslt1;
    
                    if($resultsimg != false){
                        
                        while($cont < count($resultsimg)){
                            $img = $resultsimg[$cont]->foto;
                ?>
                    <li> 
                        <a href="perfil-filiado.php?codigo=<?php echo $resultsimg[$cont]->id ?>">
                        <img src="<?php echo $img; ?>" alt="Perfil usuário">
                        <img src="imagens/tonight.png" alt="tonight" class="tonigimg">
                        </a>
                    </li>
                <?php
                            $cont++;
                        }
                    }
                ?>
                </ul>
            
            <?php } ?>
                
            </div>
            <div style="clear:both;border:solid 1px transparent;"></div>
            
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