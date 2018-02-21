<!DOCTYPE html>
<html>
	<head>
		<title> Tonight - Cadastre-se e seja um de nossos acompanhantes </title>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="pt-br" />
		<meta name="viewport" content="initial-scale=1" />
		<meta name="author" content="Larissa AP" />
		<meta name="description" content="Seja um de nossos acompanhantes e divulgue-se, basta se cadastrar" />
		<meta name="keywords" content="Acompanhante, Acompanhantes, companhias para festas, cadastre-se, ser acompanhante de luxo" />
        <link rel="icon" type="icone/png" href="imagens/logo.png">
		<link rel="stylesheet" type="text/css" href="css/estilo_padrao.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_seja_filiado.css" />
    </head>
	<body>
		<div id="principal">
            
            <!-- Cabecalho -->
            <?php include_once('view/header.php'); ?>
            
            <!-- conteudo -->
            <section id="conteudo">
                <?php include_once('view/seja_filiado_view.php'); ?>
            </section>
            
            <!-- rodape -->
            <?php include_once('view/footer.html'); ?>
		</div>
        
        <script src="js/jquery-3.2.1.min.js" ></script>
        <script type="text/javascript" >

            function termos(){
                
                if(document.getElementById('check').checked == true){ 	 
                    document.getElementById('btnConcordo').disabled = ""; 
                    $('#btnConcordo').removeClass('desabilitado');
                }  
                if(document.getElementById('check').checked == false){
                    document.getElementById('btnConcordo').disabled = "disabled";
                    $('#btnConcordo').addClass('desabilitado');
                }
            }
            
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
                            $("#frm").attr('action', 'router.php?controller=acompanhante&modo=inserir');
                            $("#frm").attr('method', 'post');

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                } 
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } 
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } 
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });

                //conta.classList.toggle('selecionado');
        </script>    
	</body>
</html>