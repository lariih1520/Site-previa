<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");

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