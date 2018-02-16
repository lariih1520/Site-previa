<?php
    
    include_once('controller/filiado_controller.php');

    if(empty($_GET['codigo'])){
        echo "Cadastre-se ou faça login";
    }

    if(isset($_GET['codigo'])){
        include_once('view/perfil/filiado_visualizar.php');
    }

    if (!empty($_SESSION['filiado'])) {
        include_once('view/perfil/filiado_usuario.php');
    }
?>

