<?php
    
    if(isset($_POST['btnLogin'])){
        require_once('controller/log.php');
        $log = new Controller();
        $log->Logar();
    }

    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    switch ($controller){

        case 'home':
            switch ($modo){
                case 'inserir':
                    include_once('model/home_class.php');
                    include_once('controller/home_controller.php');
                    
                    $controller = new ControllerHome();
                    $controller->Inserir();
                    
                    break;
                    
                case 'excluir':
                    include_once('model/home_class.php');
                    include_once('controller/home_controller.php');
                    
                    $controller = new ControllerHome();
                    $controller->Excluir();
                    
                    break;
                    
                    
            }
            
        case 'index':
            switch ($modo){
                case 'alterar':
                    include_once('model/index_class.php');
                    include_once('controller/index_controller.php');
                    
                    $controller = new ControllerIndex();
                    $controller->Alterar();
                    
                    break;
                    
                case 'excluir':
                    include_once('model/index_class.php');
                    include_once('controller/index_controller.php');
                    
                    $controller = new ControllerIndex();
                    $controller->Excluir();
                    
                    break;
                    
            }
        break;

    }

?>