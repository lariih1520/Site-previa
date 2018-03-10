<?php
    
    include_once('controller/filiado_controller.php');

    if(empty($_GET) && empty($_SESSION['id_filiado'])){
        header('location:login'.$php.'?perfil=filiado');
    }

    if(isset($_GET['codigo'])){
        
        include_once('view/perfil/filiado_visualizar.php');
    }

   if (!empty($_SESSION['id_filiado']) and empty($_GET['codigo'])) {
        include_once('view/perfil/filiado_usuario.php');
   }
?>

