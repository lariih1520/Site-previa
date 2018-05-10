<?php
    require_once('view/extencao.php');
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Página inicial </title>
		<meta charset="UTF-8">
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_inicio.css" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
        <script src="js/jquery.min.js"></script>
		<script src="js/jcarousellite.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script>
		
			function setaImagem(){
				var settings = {
					primeiraImg: function(){
						elemento = document.querySelector("#slider a:first-child");
						elemento.classList.add("ativo");
						this.legenda(elemento);
					},
			 
					slide: function(){
						elemento = document.querySelector(".ativo");
			 
						if(elemento.nextElementSibling){
							elemento.nextElementSibling.classList.add("ativo");
							settings.legenda(elemento.nextElementSibling);
							elemento.classList.remove("ativo");
						}else{
							elemento.classList.remove("ativo");
							settings.primeiraImg();
						}
			 
					},
			 
					proximo: function(){
						clearInterval(intervalo);
						elemento = document.querySelector(".ativo");
			 
						if(elemento.nextElementSibling){
							elemento.nextElementSibling.classList.add("ativo");
							settings.legenda(elemento.nextElementSibling);
							elemento.classList.remove("ativo");
						}else{
							elemento.classList.remove("ativo");
							settings.primeiraImg();
						}
						intervalo = setInterval(settings.slide,4000);
					},
			 
					anterior: function(){
						clearInterval(intervalo);
						elemento = document.querySelector(".ativo");
			 
						if(elemento.previousElementSibling){
							elemento.previousElementSibling.classList.add("ativo");
							settings.legenda(elemento.previousElementSibling);
							elemento.classList.remove("ativo");
						}else{
							elemento.classList.remove("ativo");						
							elemento = document.querySelector("a:last-child");
							elemento.classList.add("ativo");
							this.legenda(elemento);
						}
						intervalo = setInterval(settings.slide,4000);
					},
			 
					legenda: function(obj){
						var legenda = obj.querySelector("img").getAttribute("alt");
						document.querySelector("figcaption").innerHTML = legenda;
					}
			 
				}
			 
				//chama o slide
				settings.primeiraImg();
			 
				//chama a legenda
				settings.legenda(elemento);
			 
				//chama o slide à um determinado tempo
				var intervalo = setInterval(settings.slide,4000);
				document.querySelector(".next").addEventListener("click",settings.proximo,false);
				document.querySelector(".prev").addEventListener("click",settings.anterior,false);
			}
			 
			window.addEventListener("load", setaImagem ,false);
		</script>
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
                <?php 
                    include_once('controller/filiado_controller.php'); 
                    include_once('view/inicio_view.php'); 
                ?>
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
	</body>
</html>