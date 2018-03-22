<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
	
	require_once("PagSeguro.class.php");
	require_once("db_class.php");
    
	if(isset($_POST['notificationType']) and $_POST['notificationType'] == 'transaction'){
		$PagSeguro = new PagSeguro();
		$response = $PagSeguro->executeNotification($_POST);
        
		if( $response->status==3 or $response->status == 4 ){
            $conexao = new Mysql_db();
            $conect = $conexao->conectar();
            
            $status = $response->status;
            $code = $response->code;
            
            $sql = 'update tbl_mensalidade set status = '.$status.' where code = "'.$code.'" ';
            mysqli_query($conect, $sql);
                
		}else{
            
			//PAGAMENTO PENDENTE
            
            $status = $response->status;
            $code = $response->code;
            
			$sql = 'update tbl_mensalidade set status = '.$status.' where code = "'.$code.'" ';
            mysqli_query($conect, $sql);
		}
        
        mysqli_close($conect);
	}

    //RECEBER RETORNO
    if(isset($_GET['transaction_id'])){
        
        $pagamento = $PagSeguro->getStatusByCode($_GET['transaction_id']);
        $pagamento->codigo_pagseguro = $_GET['transaction_id'];
        
        $code = $_GET['transaction_id'];
        $status = $pagamento->status;
        
        $conexao = new Mysql_db();
        $conect = $conexao->conectar();
        
        if($pagamento == 3 or $pagamento == 4){
            //ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO

            $sql = 'update tbl_mensalidade set status = '.$status.' where code = "'.$code.'" ';
            mysqli_query($conect, $sql);
            
        }else{
            //ATUALIZAR NA BASE DE DADOS
            
            $sql = 'update tbl_mensalidade set status = '.$status.' where code = "'.$code.'" ';
            mysqli_query($conect, $sql);
        }
    }
?>