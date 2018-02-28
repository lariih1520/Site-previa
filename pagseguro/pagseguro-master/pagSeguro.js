//SE NÃO GERAR O ID DA SESSÃO E SETAR ESSE ID NO setSessionId NADA VAI FUNCIONAR
//DEVE-SE GERAR A IDENTIFICAÇÃO DO USUÁRIO TAMBÉM
//SE FOR CARTÃO DE CRÉDITO DEVE-SE GERAR O TOKEN DO CARTÃO

$(document).ready(function() {
   
    identificador = PagSeguroDirectPayment.getSenderHash();
    $(".hashPagSeguro").val(identificador);

    number = $('#numCartao').val();
    
    if(number != null){
        
        bin = number.toString();

        PagSeguroDirectPayment.getBrand( {
              cardBin: bin,
              success: function(response) {

                $(".retornoTeste").html(response['brand']['name']);

                bandeira = response['brand']['name'];

                if(bandeira === 'elo'){
                  $('#img-elo').css("border","3px solid #5d9afc");
                } else{$('#img-elo').css("border","3px solid white");}

                if(bandeira === 'visa'){
                  $('#img-visa').css("border","3px solid #5d9afc");
                } else{$('#img-visa').css("border","3px solid white");}

                if(bandeira === 'mastercard'){
                  $('#img-mastercard').css("border","3px solid #5d9afc");
                } else{$('#img-mastercard').css("border","3px solid white");}

                if(bandeira === 'hipercard'){
                  $('#img-hipercard').css("border","3px solid #5d9afc");
                } else{$('#img-hipercard').css("border","3px solid white");}

                if(bandeira === 'amex'){
                  $('#img-amex').css("border","3px solid #5d9afc");
                } else{$('#img-amex').css("border","3px solid white");}

              },
              error: function(response) {

              }
          });
    }

    numCartao = $("#numCartao").val();
    
    if(numCartao != null){
       
        numCartao = $("#numCartao").val();
        cvvCartao = $("#cvv").val();
        expiracaoMes = $("#pagamentoMes").val();
        expiracaoAno = $("#pagamentoAno").val();

        PagSeguroDirectPayment.createCardToken({
            cardNumber: numCartao,
            cvv: cvvCartao,
            expirationMonth: expiracaoMes,
            expirationYear: expiracaoAno,

            success: function(response){  $(".tokenPagamentoCartao").val(response['card']['token']);},
            error: function(response){ console.log(response); }
       });

    }
	
});
	  
