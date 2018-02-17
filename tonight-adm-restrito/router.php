<?php
    
    if(isset($_POST['btnLogin'])){
        require_once('controller/log.php');
        $log = new Controller();
        $log->Logar();
    }

    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    switch ($controller){

        case '':

            break;

    }

?>