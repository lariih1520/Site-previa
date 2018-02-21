<!DOCTYPE html>
<html>
	<head>
		<title> Tonight </title>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="pt-br" />
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_inicio.css" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
        <script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jcarousellite.js"></script>
        <script type="text/javascript">
		
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
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php include_once('view/inicio_view.php'); ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
	</body>
</html>