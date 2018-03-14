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
        break;
            
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

        case 'plano':
            switch ($modo){
                case 'alterar':
                    include_once('model/plano_class.php');
                    include_once('controller/planos_controller.php');
                    
                    $controller = new ControllerPlanos();
                    $controller->Alterar();
                    
                    break;
                    
                case 'add':
                    include_once('model/plano_class.php');
                    include_once('controller/planos_controller.php');
                    
                    $controller = new ControllerPlanos();
                    $controller->Adicionar();
                    
                    break;
                    
                case 'del':
                    include_once('model/plano_class.php');
                    include_once('controller/planos_controller.php');
                    
                    $controller = new ControllerPlanos();
                    $controller->ExcluirPlano();
                    
                    break;
                    
            }
        break;

        case 'hospedes':
            switch ($modo){
                case 'delHospede':
                    
                    include_once('model/filiado_class.php');
                    include_once('controller/filiado_controller.php');
                    
                    $controller = new ControllerAcompanhante();
                    $controller->ExcluirHospede();
                    
                    break;
                    
                case 'delAtrasados':
                    include_once('model/filiado_class.php');
                    include_once('controller/filiado_controller.php');
                    
                    $controller = new ControllerAcompanhante();
                    $controller->ExcluirFiliadoMensalAtrasada();
                    
                    break;
                    
                case 'recuperar':
                    include_once('model/filiado_class.php');
                    include_once('controller/filiado_controller.php');
                    
                    $controller = new ControllerAcompanhante();
                    $controller->RecuperarContaFiliado();
                    
                    break;
                    
                case 'desconto':
                    include_once('model/filiado_class.php');
                    include_once('controller/filiado_controller.php');
                    
                    $controller = new ControllerAcompanhante();
                    $controller->AdicionarDesconto();
                    
                    break;
                    
            }
            
        break;

    }

?>