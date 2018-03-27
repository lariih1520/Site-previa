<?php

class Pagamento{
    public function iniciaPagamentoAction() { //gera o código de sessão obrigatório para gerar identificador (hash)

		//$data['token'] ='D1A51A1CA9FC46C7BA9990F11D04C77E'; //token teste SANDBOX
		$data['token'] ='C4B50A6C27204920A3428A497C30198C'; //token Oficial

		$emailPagseguro = "raquelkzs@yahoo.com.br";

		$data = http_build_query($data);
		//$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions'; //Sandbox
		$url = 'https://ws.pagseguro.uol.com.br/v2/sessions'; //Oficial

		$curl = curl_init();

		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

		curl_setopt($curl, CURLOPT_URL, $url . "?email=".$emailPagseguro);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt( $curl,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $curl,CURLOPT_RETURNTRANSFER, true );
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$xml = curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);
		$idSessao = $xml -> id;
		return $idSessao;
		exit;
		//return $codigoRedirecionamento;

	}

    public function efetuaPagamentoCartao($dados) {

		$data['token'] ='C4B50A6C27204920A3428A497C30198C'; //token produção
		//$data['token'] ='D1A51A1CA9FC46C7BA9990F11D04C77E'; //token sandbox 
		$data['paymentMode'] = 'default';
		$data['senderHash'] = $dados['hash']; //gerado via javascript
		$data['creditCardToken'] = $dados['creditCardToken']; //gerado via javascript
		$data['paymentMethod'] = 'creditCard';
		$data['receiverEmail'] = 'raquelkzs@yahoo.com.br';
		$data['senderName'] = $dados['senderName']; //nome do usuário deve conter nome e sobrenome
		$data['senderAreaCode'] = $dados['senderAreaCode'];
		$data['senderPhone'] = $dados['senderPhone'];
		$data['senderEmail'] = $dados['senderEmail'];
		$data['senderCPF'] = $dados['senderCPF'];
		$data['installmentQuantity'] = '1';
		//$data['noInterestInstallmentQuantity'] = '1';
		$data['installmentValue'] = $dados['installmentValue']; //valor da parcela
		$data['creditCardHolderName'] = $dados['creditCardHolderName']; //nome do titular
		$data['creditCardHolderCPF'] = $dados['creditCardHolderCPF'];
		$data['creditCardHolderBirthDate'] = $dados['creditCardHolderBirthDate'];
		$data['creditCardHolderAreaCode'] = $dados['creditCardHolderAreaCode'];
		$data['creditCardHolderPhone'] = $dados['creditCardHolderPhone'];
		$data['billingAddressStreet'] = $dados['billingAddressStreet'];
		$data['billingAddressNumber'] = $dados['billingAddressNumber'];
		$data['billingAddressDistrict'] = $dados['billingAddressDistrict'];
		$data['billingAddressPostalCode'] = $dados['billingAddressPostalCode'];
		$data['billingAddressCity'] = $dados['billingAddressCity'];
		$data['billingAddressState'] = $dados['billingAddressState'];
		$data['billingAddressCountry'] = 'BRA';
		$data['currency'] = 'BRL';
		$data['itemId1'] = '01';
		$data['itemQuantity1'] = '1';
		$data['itemDescription1'] = 'Mensalidade do usuario';
		$data['reference'] = $dados['reference']; 
		$data['shippingAddressRequired'] = 'false';
		$data['itemAmount1'] = $dados['itemAmount1'];

		$emailPagseguro = "raquelkzs@yahoo.com.br";

		$data = http_build_query($data);
        
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions';
		//$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions'; //URL de teste

		$curl = curl_init();

		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

		curl_setopt($curl, CURLOPT_URL, $url . "?email=" . $emailPagseguro);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt( $curl,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $curl,CURLOPT_RETURNTRANSFER, true );
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$xml = curl_exec($curl);

		curl_close($curl);

		$xml = simplexml_load_string($xml);
        //var_dump($xml);

        if($xml->error){
            $erro = $xml->error->message;
            $code = $xml->error->code;
            $retornoCartao = array(
                'code' => $code,
                'erro' => $erro,
                'token' => $dados['creditCardToken']
            );

        }else{
            //echo $xml -> paymentLink;
            $code =  $xml -> code;
            $date =  $xml -> date;

            $retornoCartao = array(
                    'code' => $code,
                    'date' => $date
            );
        }
        
		return $retornoCartao;

	}

	public function efetuaPagamentoBoleto($dados) {

		$data['token'] ='C4B50A6C27204920A3428A497C30198C'; //token produção
		//$data['token'] ='D1A51A1CA9FC46C7BA9990F11D04C77E'; //token sandbox
		$data['paymentMode'] = 'default';
		$data['senderHash'] = $dados['hash'];
		$data['paymentMethod'] = 'boleto';
		$data['receiverEmail'] = 'raquelkzs@yahoo.com.br';
		$data['senderName'] = $dados['senderName'];
		$data['senderAreaCode'] = $dados['senderAreaCode'];
		$data['senderPhone'] = $dados['senderPhone'];
		$data['senderEmail'] = $dados['senderEmail'];
		$data['senderCPF'] = $dados['senderCPF'];
		$data['currency'] = 'BRL';
		$data['itemId1'] = '01';
		$data['itemQuantity1'] = '1';
		$data['itemDescription1'] = 'Mensalidade usuario';
		$data['reference'] = $dados['reference'];
		$data['shippingAddressRequired'] = 'false';
		$data['itemAmount1'] = $dados['itemAmount'];

		$emailPagseguro = "raquelkzs@yahoo.com.br";

		$data = http_build_query($data);
		$url = 'https://ws.pagseguro.uol.com.br/v2/transactions'; //URL real
		//$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions'; //URL de teste

		$curl = curl_init();

		$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

		curl_setopt($curl, CURLOPT_URL, $url . "?email=".$emailPagseguro);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt( $curl,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $curl,CURLOPT_RETURNTRANSFER, true );
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$xml = curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);

        //var_dump($xml);
        
        if($xml->error){
            $erro = $xml->error->message;
            $code = $xml->error->code;
            $retornoBoleto = array(
                'erro' => $erro,
                'code' => $code
            );
            
        }else{
            
            $boletoLink =  $xml -> paymentLink;
            $code =  $xml -> code;
            $date =  $xml -> date;

            $retornoBoleto = array(
                    'paymentLink' => $boletoLink,
                    'date' => $date,
                    'code' => $code
            );
        }
        
		return $retornoBoleto;

	}
    
    
}

?>