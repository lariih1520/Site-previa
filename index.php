<?php
    require_once('view/extencao.php');
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tonight </title>
		<meta charset="UTF-8">
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Precisa de um ampanhante? Nós temos o que você precisa" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
        <script src="js/jquery-3.2.1.min.js"></script>
	</head>
    <?php 
        
        require_once('controller/index_controller.php');
    
        $controller = new ControllerIndex();
        $rs = $controller->BuscarImagens();
    
        if($rs != null || $rs != '-'){
            
            $cont = 0;
            
            while($cont < count($rs)){
                $imagem[$cont] = "style=\"background-image:url('".$rs[$cont]->imagem."');\" ";
        
                $cont++;
            }
            
        }else{
            $cont = 0;
            while($cont <= 5){
                $imagem[$cont] = "";
                
                $cont++;
            }
        }
    
    ?>
	<body <?php echo $imagem[0] ?>>
        <?php
            
            if(!empty($_SESSION['id_cliente'])){
                $lgrc = true;
                $msg = '<a href="perfil-cliente.php"> Ir para o perfil </a>';

            }else{
                $lgrc = false;
                $msg = '<a href="login"> Faça Login </a>';
            }
            
            
        ?>
        <div id="introducao" class="hidediv">
            <p> Precisa de um acompanhante? </p>

            Entre e veja as opções que temos disponíveis para contratar de forma rápida e fácil.

            <p class="alerta"> (SE VOCÊ TIVER MAIS DE 18 ANOS) </p>
            <div class="termos"> 
                Ao entrar no site você concorda com os <a href="sobre-o-site<?php echo $php ?>"> Termos de uso </a>
                do site
            </div>
        </div>
            
		<div id="principal_index">
			
            <div class="menu_index left">
                <div id="ir_site" <?php echo $imagem[2] ?>><a href="inicio<?php echo $php ?>"> Ir para o site </a></div>
                <div id="ver_homens" <?php echo $imagem[3] ?>><a href="inicio<?php echo $php ?>?#homens"> Homens </a></div>
                <div id="ver_mulheres" <?php echo $imagem[4] ?>><a href="inicio<?php echo $php ?>?#mulheres"> Mulheres </a></div>
                <a href="#" onclick="OpenMsg()">
                <img src="icones/help.png" alt="mais" class="icone">
                </a>
            </div>
            
            <div class="menu_index right">
                <div id="fazer_login" <?php echo $imagem[1] ?>> <?php echo $msg ?> </div>
                <div id="seja_filiado" <?php echo $imagem[5] ?>><a href="seja-filiado<?php echo $php ?>"> Seja um dos nossos filiados </a></div>
            </div>
            <div style="clear:both"></div>
            
		</div>
        <script>
            
            function OpenMsg(){
                $('#introducao').toggleClass("hidediv");
            }
            
        </script>
        <?php 
            
            $controller = new ControllerIndex();
            $resp = $controller->SlideDestaque();
                
            if($resp != false){
                $id = $resp[0]->id_filiado;
        ?>
        
        <div id="slide">
            
            <h1 class="titulo"> Destaque da semana </h1>
            <h1 class="titulo"> 
                <a href="perfil-filiado.php?codigo=<?php echo $id ?>">
                <img src="<?php echo $resp[0]->foto ?>" class="fotoperfil"> <?php echo $resp[0]->nome; ?> 
                </a>
            </h1>
            <div class="w3-content w3-display-container">
                <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <?php
                $mod = 0;
                $contRest = count($resp);
                
                if($contRest % 3 == 0){
                    $nmr = (int)($contRest / 3);    
                }else{
                    $nmr = (int)($contRest / 3);
                    $mod = $contRest % 3;
                    $nmr = $nmr + 1;
                }
                
                $cnt = 0;
                $cont = 0;
                while($cont < $nmr){
                    
                    if($mod != 0 and $cont == $nmr - 1){
                        if($mod == 1){
                            $img1 = $resp[$cnt]->foto;
                            $img2 = $resp[1]->foto;
                            $img3 = $resp[2]->foto;
                        }elseif($mod == 2){
                            $img1 = $resp[$cnt]->foto;
                            $img2 = $resp[0]->foto;
                        }
                    }else{
                        $img1 = $resp[$cnt]->foto;
                        $cnt++;
                        $img2 = $resp[$cnt]->foto;
                        $cnt++;
                        $img3 = $resp[$cnt]->foto;
                        $cnt++;
                    }
            ?>
                    <div class="mySlides">
                        <a href="perfil-filiado.php?codigo=<?php echo $id ?>">
                            <img src="<?php echo $img1 ?>" alt="Fotos slide">
                            <img src="<?php echo $img2 ?>" alt="Fotos slide">
                            <img src="<?php echo $img3 ?>" alt="Fotos slide">
                        </a>
                    </div>
            <?php
                    $cont++;
                }

            ?>
                <button class="w3-button w3-black w3-display-right" style="margin-left:-40px;" onclick="plusDivs(1)">&#10095;</button>
            </div>
            
            <script>/* Slide automático */
                var slideIndex = 0;
                carousel();

                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                      x[i].style.display = "none"; 
                    }
                    slideIndex++;
                    if (slideIndex > x.length) {slideIndex = 1} 
                    x[slideIndex-1].style.display = "block"; 
                    setTimeout(carousel, 3000); //Mudar imagem a cada 3 segundos
                }
            </script>
            <script>/* Slide manual */
                var slideIndex = 1;
                showDivs(slideIndex);

                function plusDivs(n) {
                  showDivs(slideIndex += n);
                }

                function showDivs(n) {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                  if (n > x.length) {slideIndex = 1}    
                  if (n < 1) {slideIndex = x.length}
                  for (i = 0; i < x.length; i++) {
                     x[i].style.display = "none";  
                  }
                  x[slideIndex-1].style.display = "block";  
                }
            </script>
        </div>
        <?php 
            } 
        ?>
	</body>
</html>