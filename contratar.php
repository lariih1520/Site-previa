<?php
    if(isset($_GET['btn_larissa'])){
        $rua = $_GET['rua'];
        echo $rua;
    }
?>
<html>
    <head>
        <title>ViaCEP Webservice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Adicionando JQuery -->
        <script src="js/jquery-3.2.1.min.js" ></script>

        <!-- Adicionando Javascript -->
        <script type="text/javascript" >

            $(document).ready(function() {

                $("#botao").val("Digite um cep");

                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                }

                //Quando o campo cep perde o foco.
                $("#cep").blur(function() {

                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if(validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#rua").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#botao").val("Salvar");
                            $("#frm").attr('action', 'contratar.php');

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });

        </script>
    </head>

    <body>
    <!-- Inicio do formulario -->
      <form method="get" action="." id="frm">
        <label>Cep:
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" /></label><br />
        <label>Rua:
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="2" /></label><br />
        <label>
        <input name="btnSalvar" type="submit" id="botao" /></label><br />
      </form>
        
        <div id="informacoes">
            <p> Estes dados são sigilosos e nós usaremos apenas para ttransferencia </p>
            <ul class="lst_dados_ver">
                <li>
                    <p class="label_dados"> Senha </p>
                    <span>
                    <?php 
                        $len = strlen($senha);
                        $cont = 0;
                
                        while($cont < $len){
                            echo '*';
                            $cont++;
                        }
                    ?>
                    </span>
                </li>
                <li> <p> Telefone: </p> </li>
                <li> <p> CEP: </p> </li>
                <li> <p> Rua: </p> </li>
                <li> <p> Numero: </p> </li>
                <li> <p> Bairro: </p> </li>
                <li> <p> Cidade: </p> </li>
                <li> <p> Estado: </p> </li>
                <li> <p> CPF: </p> </li>
                <li> <p> Numero cartão: </p> </li>
                <li> <p> cvv: </p> </li>
                <li> <p> expiracaoMes: </p> </li>
                <li> <p> expiracaoAno: </p> </li>
            </ul>
            <div class="editar_dados"><a href="?perfil=cliente&editar=informacoes#content"> Editar dados &raquo; </a></div>
        </div>
        
    </body>

</html>