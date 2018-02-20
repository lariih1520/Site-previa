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
		<link rel="stylesheet" type="text/css" href="css/estilo_index.css" />
	</head>
	<body>
        <?php
            session_start();

            if(!empty($_SESSION['id_cliente'])){
                $lgrc = true;
                $msg = '<a href="perfil.php?perfil=cliente"> Ir para o perfil </a>';

            }else{
                $lgrc = false;
                $msg = '<a href="login.php"> Faça Login </a>';
            }

        ?>
		<div id="principal_index">
			
            <div id="introducao">
                <p> Precisa de um acompanhante? </p>
                  
                Entre e veja as opções que temos disponíveis para contratar de forma rapida e fácil.
                
                <p class="alerta"> (SE VOCÊ TIVER MAIS DE 18 ANOS) </p>
            </div>
            
            <div id="menu_index">
                <div id="fazer_login"> <?php echo $msg ?> </div>
                <div id="ir_site"><a href="inicio.php"> Ir para o site </a></div>
                <div id="ver_homens"><a href="inicio.php?#homens"> Homens </a></div>
                <div id="ver_mulheres"><a href="inicio.php?#mulheres"> Mulheres </a></div>
                <div id="seja_filiado"><a href="seja-filiado.php"> Seja um dos nossos filiados </a></div>
            </div>
            
		</div>
	</body>
</html>