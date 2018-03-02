<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
	require_once("PagSeguro.class.php");
    require_once('../controller/filiado_controller.php');
    require_once('../model/filiado_class.php');
        

	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		$PagSeguro = new PagSeguro();
		$response = $PagSeguro->executeNotification($_POST);
        
        $controller = new ControllerAcompanhante();
        
		if( $response->status==3 || $response->status==4 ){
            
            $controller->AtualizeStatusPag(3);
            
		}else{
            $controller->AtualizeStatusPag(1);
            
			//PAGAMENTO PENDENTE
			//echo $PagSeguro->getStatusText($PagSeguro->status);
		}
        
	}
    //RECEBER RETORNO
    if( isset($_GET['transaction_id']) ){
        $pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);

        $pagamento->codigo_pagseguro = $_GET['transaction_id'];

        if($pagamento->status==3 || $pagamento->status==4){
            //ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
            $controller = new ControllerAcompanhante();
            $controller->AtualizeStatusPag(3);

        }else{
            //ATUALIZAR NA BASE DE DADOS
            $controller = new ControllerAcompanhante();
            $controller->AtualizeStatusPag($pagamento->status);
        }
    }
?>