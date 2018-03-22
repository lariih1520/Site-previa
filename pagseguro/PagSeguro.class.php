<?php
class PagSeguro{
	private $email         = "raquelkzs@yahoo.com.br";
	private $token = "D1A51A1CA9FC46C7BA9990F11D04C77E"; //Sandbox
	//private $token = "C4B50A6C27204920A3428A497C30198C"; //Oficial
	private $url_retorno   = "https://tonight.net.br/pagseguro/notificacao.php";
	
	//URL OFICIAL
	//COMENTE AS 4 LINHAS ABAIXO E DESCOMENTE AS URLS DA SANDBOX PARA REALIZAR TESTES
    /*
	private $url              = "https://ws.pagseguro.uol.com.br/v2/checkout/";
	private $url_redirect     = "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=";
	private $url_notificacao  = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/';
	private $url_transactions = 'https://ws.pagseguro.uol.com.br/v2/transactions/';
    */
	//URL SANDBOX
	//DESCOMENTAR PARA REALIZAR TESTES
	
	private $url              = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/";
	private $url_redirect     = "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=";
	private $url_notificacao  = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/';
	private $url_transactions = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';
	
	
	private $email_token = "";//NÃO MODIFICAR
	private $statusCode = array(0=>"Pendente",
								1=>"Aguardando pagamento",
								2=>"Em análise",
								3=>"Pago",
								4=>"Disponível",
								5=>"Em disputa",
								6=>"Devolvida",
								7=>"Cancelada");

	public function __construct(){
		$this->email_token = "?email=".$this->email."&token=".$this->token;
		$this->url .= $this->token;
	}
	
	//RECEBE UMA NOTIFICAÇÃO DO PAGSEGURO
	//RETORNA UM OBJETO CONTENDO OS DADOS DO PAGAMENTO
	public function executeNotification($POST){
		$url = $this->url_notificacao.$POST['notificationCode'].$this->email_token;
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$transaction= curl_exec($curl);
		if($transaction == 'Unauthorized'){
            var_dump($transaction);
		    exit;
		}
		curl_close($curl);
		$transaction_obj = simplexml_load_string($transaction);
        
        var_dump($transaction_obj);
        
		return $transaction_obj;		
	}
	
	//Obtém o status de um pagamento com base no código do PagSeguro
	//Se o pagamento existir, retorna um código de 1 a 7
	//Se o pagamento não exitir, retorna NULL
	public function getStatusByCode($code){
		$url = $this->url_transactions.$code.$this->email_token;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
		$transaction = curl_exec($curl);
		if($transaction == 'Unauthorized') {
			echo 'Erro no sistema';
			exit;//Mantenha essa linha para evitar que o código prossiga
		}
		$transaction_obj = simplexml_load_string($transaction);
		
		if(count($transaction_obj -> error) > 0) {
		   echo 'Erro no sistema';
		   var_dump($transaction_obj);
		}		

		if(isset($transaction_obj->status)){
            $status = $transaction_obj->status
			return $status;
        }else{
			return NULL;
        }
	}
	
	//Obtém o status de um pagamento com base na referência
	//Se o pagamento existir, retorna um código de 1 a 7
	//Se o pagamento não exitir, retorna NULL
	public function getStatusByReference($reference){
		$url = $this->url_transactions.$this->email_token."&reference=".$reference;
        
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
		$transaction = curl_exec($curl);
		if($transaction == 'Unauthorized') {
            
            echo 'Erro no sistema';
			//Insira seu código avisando que o sistema está com problemas
			exit;
		}
		$transaction_obj = simplexml_load_string($transaction);
		if(count($transaction_obj -> error) > 0) {
            echo 'Erro no sistema';
            //Insira seu código avisando que o sistema está com problemas
            var_dump($transaction_obj);
            exit;
		}
		//print_r($transaction_obj);
		if(isset($transaction_obj->transactions->transaction->status)){
            $status = $transaction_obj->transactions->transaction->status;
			return $status;
        }else{
			return NULL;
        }
	}
	
	public function getStatusText($code){
        $cod = intval($code);
        
		if($code >= 1 && $code <= 7){
			return $this->statusCode[$cod];
        }else{
			return $this->statusCode[0];
        }
	}
	
}
?>