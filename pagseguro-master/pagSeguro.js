
    function SetarIdSession(){ //recebe codigo da dessão e seta o sessão id

        $.ajax({
            url :'pagseguro-master/PagSeguro.php/Pagamento()/iniciaPagamentoAction()',
            type : 'post',
            dataTyp : 'json',
            async : false,
            timeout: 20000,
            success: function(data){
                alert('sucess');
                PagSeguroDirectPayment.setSessionId(data);
            },
            error: function(data){
                alert('Error 1');
            }
        });
        
    }
	
    function GerarIdentificador(){ //gera identificação do usuário

          identificador = PagSeguroDirectPayment.getSenderHash();
          $(".hashPagSeguro").val(identificador);
        
    }

    function GetBrand(numCartao){
        bin = numCartao;
        PagSeguroDirectPayment.getBrand( {
              cardBin: bin,
              success: function(response) {
                bandeira = response['brand']['name'];
                $("#BandeiraPagSeguro").val(bandeira);
                return true;
              },
              error: function(response) {
                  alert('ERROR 3');
              }
          });
    }

    function GerarToken(numCartao, cvvCartao, expiracaoMes, expiracaoAno){  //criar token

        PagSeguroDirectPayment.createCardToken({
            cardNumber: numCartao,
            cvv: cvvCartao,
            expirationMonth: expiracaoMes,
            expirationYear: expiracaoAno,

            success: function(response){  $(".tokenPagamentoCartao").val(response['card']['token']); return true;},
            error: function(response){ return false; }
       });

    }
