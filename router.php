<?php

  $controller = $_GET['controller'];
  $modo = $_GET['modo'];
  
  echo ($controller.' '.$modo);

switch ($controller) {

    case 'cliente':
        switch ($modo){
            case 'inserir':
                require_once('model/cliente_class.php');
                require_once('controller/cliente_controller.php');
                $controller = new ControllerCliente();
                $controller->Cadastrar();
               
            break;
                
            case 'logar':
                require_once('model/cliente_class.php');
                require_once('controller/cliente_controller.php');
                $autentica_controller = new ControllerCliente();
                $autentica_controller->Logar();
                
            break;
                
            case 'alterar':
                require_once('model/cliente_class.php');
                require_once('controller/cliente_controller.php');
                $autentica_controller = new ControllerCliente();
                $autentica_controller->Alterar();
                
            break;
        }


    break;
        
    case 'acompanhante':
        switch ($modo){
            case 'inserir':
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                require_once('controller/filiado.php');
                
                $controller = new ControllerAcompanhante();
                
                 if(!empty($_GET['tipo'])){
                     $controller->CadastrarFiliado();
                         
                 }
               
            break;
                
            case 'logar':
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $autentica_controller = new ControllerAcompanhante();
                $autentica_controller->Logar();
                
            break;
                
        }

    break;
    
    default:
        # code...
    break;
}


?>
