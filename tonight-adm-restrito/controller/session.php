<?php
    session_start();

    if(empty($_SESSION['rgr'])){
        header('Location:login.php?search=rblss');
    }
    
    if(isset($_GET['sair'])){
        session_destroy();
        header('Location:../index.php');
    }

?>  