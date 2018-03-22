    <h1 class="titulo_maior"> Lista de todos os hospedes do site </h1>

<?php 
    
    if(!empty($_GET['Atualizar'])){
        $contllr = new ControllerAcompanhante();
        $rs = $contllr->AtualizarStatusPagamento();
        
    }
    
    if(isset($_GET['gerar'])){
        
        if($_GET['gerar'] == 'desconto' and !empty($_GET['id'])){
            $id_desconto = $_GET['id'];
            $contllr = new ControllerAcompanhante();
            $rs = $contllr->BuscarDadosFiliado($id_desconto);
            
            if($rs != null){
                $id = $rs->id_filiado;
                $nome = $rs->nome;
                $valorMes = $rs->valor;
                $desconto = $rs->desconto;
            }
            
?>
    <form action="router.php?controller=hospedes&modo=desconto&cod=<?php echo $id ?>" method="post" class="form">
        <fieldset>
            <legend class="titulo"> Gerar desconto </legend>

            <div class="novoDesconto">
            <p> <label> Codigo: </label> <?php echo $id ?>  &#124; 
                <label> Nome: </label> <?php echo $nome ?>  &#124; 
                <label> Valor mensal: </label> R$ <?php echo $valorMes ?>,00 </p> 
            <p><label> Desconto: </label>
                <input type="text" name="txtValor" id="valor" value="<?php echo $valorMes ?>" class="hide">
                <input type="text" name="txtValorPorcentagem" id="ValorPorcentagem" class="hide">
                <input type="text" name="txtPorcentagem" size="5" id="desconto"> %
            </p>
            <p> <label> Valor com desconto: </label> R$ <span id="valorDesconto"> </span>,00 </p>
            
            <p> <input type="submit" name="btnConfirmar" value="Confirmar" class="botao on"> 
                <a href="?"> Cancelar </a>
            </p>
                Este desconto é valido para o próximo pagamento
            </div>
            
            <?php if($desconto != 0){ ?>
            <div class="descontoAnterior">
                <p><b>Desconto atual</b></p>
                <p> Valor do desconto: <?php echo $desconto ?></p>
                <p> Valor com desconto: <?php echo $valorMes - $desconto ?></p>
                <p><a href="router.php?controller=hospedes&modo=deldesconto&code=<?php echo $id ?>" class="onOff off"> 
                    Excluir desconto </a></p>
            </div>
            <?php } ?>
            
        </fieldset>
    </form>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script>
        
        $("#desconto").keyup(function(){
            
            valorPag = $("#valor").val();
            desc = $("#desconto").val();
            
            if(desc > 0){
                valorbd = Math.round((valorPag * desc) / 100);
                valorDesc = valorPag - Math.round((valorPag * desc) / 100);
            }else{
                valorDesc = valorPag;
            }
            
            $("#valorDesconto").html(valorDesc);
            $("#ValorPorcentagem").val(valorbd);
            
        });
        
        
        
    </script>
<?php 
        }
    }

    if(isset($_GET['modo'])){
?>
    <div id="visualizar">
        
        
<?php 
        $id = $_GET['codigo'];
        $controller = new ControllerAcompanhante();
        $rs = $controller->BuscarDadosFiliado($id);
        
        if($rs != false){
            
            if($rs->conta_ativa == 1){ $conta_ativa = 'Ativa'; }else{ $conta_ativa = 'Inativa'; }
                
            if($rs->foto_perfil != null){
?>
        <div class="foto_perfil"><a href="../perfil-filiado.php?codigo=<?php echo $rs->id_filiado ?>"> <img src="<?php echo '../'.$rs->foto_perfil ?>" alt="Ver perfil"></a> </div>
        
<?php       }
            
            
        if($rs->apresentacao == '-' or $rs->apresentacao == '0'){ 
            $apresentacao = ''; 
        }else{
            $apresentacao = '<div class="apresentacao"><p>Apresentacao</p> <span>'.$rs->apresentacao.'</span></div>'; 
        }
            
        echo $apresentacao;
?>
        
        <div style="clear:both;"></div>
        <ul class="lst_dados_usuario">
            
            <li><p>Codigo</p> <span><?php echo $rs->id_filiado ?></span></li>
            <li><p>Nome</p> <span><?php echo $rs->nome ?></span></li>
            <li><p>Nascimento</p> <span><?php echo $rs->nasc ?></span></li>
            <li><p>Email</p> <span><?php echo $rs->email ?></span></li>
            <li><p>Senha</p> <span><?php echo $rs->senha ?></span></li>
            <li><p>Celular1</p> <span><?php echo $rs->celular1 ?></span></li>
            <li><p>Celular2</p> <span><?php echo $rs->celular2 ?></span></li>
            <li><p>Sexo</p> <span><?php echo $rs->sexo ?></span></li>
            <li><p>Altura</p> <span><?php echo $rs->altura ?></span></li>
            <li><p>Peso</p> <span><?php echo $rs->peso ?></span></li>
            <li>
                <?php if($rs->excluido == null or $rs->excluido == 0000-00-00){
                    if($conta_ativa == 'Ativa'){
                        $conta = 'Conta ativa';
                        $class= 'on';
                    }elseif($conta_ativa == 'Inativa'){
                       $conta = 'Conta inativa';
                        $class= 'off';
                    }
                    echo '<form action="router.php?controller=hospedes&modo=contaOnOff" method="post">';
                    echo '<input type="text" name="txtCod" value="'.$rs->id_filiado.'" class="hide">';
                    echo '<input type="submit" name="btnUpdate" value="'.$conta.'" class="onOff '.$class.'">';
                    echo '</form>';
                }else{ ?>
                
                <p>Conta ativa</p> <span><?php echo $conta_ativa ?></span>
                
                <?php } ?>
            </li>
            <li><p>Acompanha</p> <span><?php echo $rs->acompanha ?></span></li>
            <li><p>Cobrar</p> <span><?php echo $rs->cobrar ?> ,00 </span></li>
            <li><p>UF</p> <span><?php echo $rs->uf ?></span></li>
            <li><p>Cidade</p> <span><?php echo $rs->cidade ?></span></li>
            <li><p>Data de cadastro</p> <span><?php echo $rs->data_cadastro ?></span></li>
            <?php       
                if($rs->excluido != null or $rs->excluido != 0000-00-00){
            ?>
            
            <li><p>Data de exclusão </p> <span><?php echo $rs->excluido ?></span></li>
            
            <?php 
                }
        
                if($rs->nomeCard != null or $rs->sobrenomeCard != null or $rs->cpf != null){
            ?>
            <li><p>Nome cartão</p> <span><?php echo $rs->nomeCard ?></span></li>
            <li><p>Sobrenome cartão</p> <span><?php echo $rs->sobrenomeCard ?></span></li>
            <li><p>Telefone</p> <span><?php echo $rs->telefone ?></span></li>
            <li><p>Rua</p> <span><?php echo $rs->rua ?></span></li>
            <li><p>Numero</p> <span><?php echo $rs->numero ?></span></li>
            <li><p>Bairro</p> <span><?php echo $rs->bairro ?></span></li>
            <li><p>Cidade cartão</p> <span><?php echo $rs->cidadeCard ?></span></li>
            <li><p>Uf cartão</p> <span><?php echo $rs->ufCard ?></span></li>
            <li><p>Cep</p> <span><?php echo $rs->cep ?></span></li>
            <li><p>Cpf</p> <span><?php echo $rs->cpf ?></span></li>
            <?php 
                if($rs->excluido == null or $rs->excluido == '0000-00-00'){
                    
                    if($rs->desconto == 0){
                        $desc = "Gerar desconto";
                    }else{
                        $desc = "Alterar valor do desconto";
                    }
            ?>
            
            <li><p>desconto</p> <span><?php echo $rs->desconto ?>,00 </span> 
                <span class="addDesconto"><a href="?gerar=desconto&id=<?php echo $rs->id_filiado ?>"> <?php echo $desc ?> </a></span> 
            </li>
            
            <?php
                }
                 
            } 
            ?>
            
            <?php 
                if($rs->excluido == null or $rs->excluido == '0000-00-00'){
            ?>
            
            <li> <a href="#visualizar" onclick="confirmDelete('<?php echo $rs->id_filiado ?>');"> 
                <img src="icones/delete.png" class="icone" title="Excluir usuário" alt="excluirr">
            </a></li>
            
            <?php 
                }else{
            ?>    
            <li><p>Recuperar conta </p> 
                <a href="#" onclick="confirmRecuperar('<?php echo $rs->id_filiado ?>');"> 
                    <p> <img src="icones/recuperar.jpg" class="recuperar"> </p>
                </a>
            </li>
            
            <?php 
                }
            ?>
            
            <li> <a href="?" class="botao"> OK </a> </li>
<?php 
            
        }
?>
            
        </ul>
        <script>
            function confirmDelete(id){

                decisao = confirm('Deseja realmente excluir este hospede?')

                if(decisao){
                    window.location.href = "router.php?controller=hospedes&modo=delHospede&id="+id;

                }else{
                    return false;
                }
            }

            function confirmRecuperar(id){

                decisao = confirm('Deseja recuperar a conta deste hospede?')

                if(decisao){
                    window.location.href = "router.php?controller=hospedes&modo=recuperar&id="+id;

                }else{
                    return false;
                }
            }

        </script>
    </div>
<?php 
    }
?>
    <div class="content_pesq">
        <form action="hospedes.php" method="get" id="form">
            <p> Pesquise: 
                <input type="text" name="txtPesquisa" placeholder="Pesquise pelo nome ou codigo"> 
                <a href="#" onclick="form.submit();">
                    <img src="icones/pesquisa.png" class="icone">
                </a>
            </p>
            <p><a href="?"> Limpar </a></p>
        </form>
        <div id="hospedes">
            <table class="lst_hospedes">
                <tr class="tbl_titulo">
                    <td> Codigo: </td><td> Nome: </td><td> Nasc: </td><td> Uf </td><td> Cobra </td><td> CPF </td><td> Ver </td> 
                </tr>

            <?php 
                $controller = new ControllerAcompanhante();
                
                if(!empty($_GET['txtPesquisa'])){
                    $pesq = $_GET['txtPesquisa'];
                    $rs = $controller->PesquisarAcompanhante($pesq);
                }else{
                    $rs = $controller->ListarAcompanhantes();
                }

                if($rs != null){

                    $cont = 0;
                    while($cont < count($rs)){
                        $codigo = $rs[$cont]->id_filiado;
                        $nome   = $rs[$cont]->nome;
                        $nasc   = $rs[$cont]->nasc;
                        $uf     = $rs[$cont]->uf;
                        $cobra  = $rs[$cont]->cobrar;
                        $cpf    = $rs[$cont]->cpf;
            ?>
                <tr>
                    <td> <?php echo $codigo ?> </td>
                    <td> <?php echo $nome ?>   </td>
                    <td> <?php echo $nasc ?>   </td> 
                    <td> <?php echo $uf ?>     </td> 
                    <td> R$ <?php echo $cobra ?>,00  </td> 
                    <td> <?php echo $cpf ?>    </td>  
                    <td> 
                        <a href="?modo=ver&codigo=<?php echo $codigo ?>"> Mais </a>
                    </td> 
                </tr>

            <?php 
                        $cont++;
                    }
                }else{
                    echo "<tr><td colspan='7'> <center>Não encontrado</center> </td></tr>";
                    
                }
            ?>    
            </table>
        </div>
        <?php 
        
        $rs = $controller->BuscarFiliadosPagAtraso();
        
        if($rs != false){
            $msg = 'Algumas contas estão com o pagamento atrasado mais de uma semana! 
                    <a href="router.php?controller=hospedes&modo=delAtrasados" class="atualzar"> Deseja excluir ? </a>';
            
        }elseif($rs == false){
            $msg = 'Não há contas com o pagamento atrasado';
        }
        ?>
        <p class="delcontasatrasadas"><?php echo $msg ?><span><a href="?Atualizar=contas" class="atualzar"> Atualizar </a></span></p>
        
    </div>

    <?php 
        $controller = new ControllerAcompanhante();
        $rs = $controller->ListarFiliadosDesativados();

        if($rs != null){
    ?>
    <h1 class="titulo_maior"> Contas excluidas ou desativadas - Hospedes </h1>

    <div id="hospedes">
        <table class="lst_hospedes">
            <tr class="tbl_titulo">
                <td> Codigo: </td><td> Nome: </td><td> Nasc: </td><td> Uf </td><td> Cobra </td><td> CPF </td><td> Ver </td> 
            </tr>
            
        <?php 
            
                $cont = 0;
                while($cont < count($rs)){
                    $codigo = $rs[$cont]->id_filiado;
                    $nome   = $rs[$cont]->nome;
                    $nasc   = $rs[$cont]->nasc;
                    $uf     = $rs[$cont]->uf;
                    $cobra  = $rs[$cont]->cobrar;
                    $cpf    = $rs[$cont]->cpf;
        ?>
            <tr>
                <td> <?php echo $codigo ?> </td>
                <td> <?php echo $nome ?>   </td>
                <td> <?php echo $nasc ?>   </td> 
                <td> <?php echo $uf ?>     </td> 
                <td> R$ <?php echo $cobra ?>,00  </td> 
                <td> <?php echo $cpf ?>    </td>  
                <td> 
                    <a href="?modo=ver&codigo=<?php echo $codigo ?>"> Mais </a>
                </td> 
            </tr>
            
        <?php 
                    $cont++;
                }
              
        ?>    
        </table>
    </div>
    <?php
        }
    ?>   

<?php
    /*
    $controller = new ControllerAcompanhante();
    $rs = $controller->AtualizarFiliados();
    
    if(){
        
    }
    */
?>

