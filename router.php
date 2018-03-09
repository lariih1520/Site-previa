<?php

  $controller = $_GET['controller'];
  $modo = $_GET['modo'];
  
  //echo ($controller.' '.$modo);

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
                session_start();
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                require_once('controller/filiado.php');
                
                $controller = new ControllerAcompanhante();
                
                if(isset($_POST['txtTipo'])){
                    if(!empty($_POST['txtTipo'])){
                         $controller->CadastrarFiliado();
                        //echo 'isset';
                    }else{
                        //echo 'nao isset';
                        header('location:seja-filiado.php?etapa=2&escolha=plano');
                    }
                }
                
                if(!empty($_GET['q']) and $_GET['q'] == 'dados-private'){
                    $controller->CadastrarDadosPag();
                
                /* Dados privados e redireciona para pagamento */
                }elseif(!empty($_GET['q']) and $_GET['q'] == 'pagar'){
                    $controller->CadastrarDadosPag();
                    
                }
               
            break;
                
            case 'logar':
                session_start();
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $autentica_controller = new ControllerAcompanhante();
                $autentica_controller->Logar();
                
            break;
                  
            case 'perfil':
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $controller = new ControllerAcompanhante();
                $controller->FotoPerfil();
                
            break;
                  
            case 'foto':
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $controller = new ControllerAcompanhante();
                $controller->MidiaFiliado(1);
                
            break;
                  
            case 'video':
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $controller = new ControllerAcompanhante();
                $controller->MidiaFiliado(2);
                
            break;
                
            case 'plano':
                session_start();
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $controller = new ControllerAcompanhante();
                $controller->AlterarPlano();
                
            break;
                
            case 'alterar':
                session_start();
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                
                $controller = new ControllerAcompanhante();
                
                /* Dados perfil */
                if($_GET['q'] == 'dados'){
                    $controller->AlterarDados();
                    
                /* Dados privados e redireciona para perfil */
                }elseif($_GET['q'] == 'dados-private'){
                    $controller->AlterarDadosPrivate();
                
                /* Dados privados e redireciona para pagamento */
                }elseif($_GET['q'] == 'pagar'){
                    $controller->AlterarDadosPrivate();
                    
                }
                
            break;
                
            case 'excluir':
                session_start();
                require_once('model/filiado_class.php');
                require_once('controller/filiado_controller.php');
                $controller = new ControllerAcompanhante();
                $controller->ExcluirAcompanhante();
                
            break;
                
        }

    break;
    
    default:
        # code...
    break;
}


?>
