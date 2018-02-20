<?php
    
    include_once('controller/filiado_controller.php');

    if(empty($_GET && empty($_SESSION['filiado']))){
        header('location:login.php?perfil=filiado');
    }

    if(isset($_GET['codigo'])){
        include_once('view/perfil/filiado_visualizar.php');
    }

   // if (!empty($_SESSION['filiado'])) {
        include_once('view/perfil/filiado_usuario.php');
   // }
?>

