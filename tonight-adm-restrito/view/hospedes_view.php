    <h1 class="titulo_maior"> Lista de todos os hospedes do site </h1>
    
<?php 
    if(isset($_GET['modo'])){
?>
    <div id="visualizar">
        
        
<?php 
        $id = $_GET['codigo'];
        $controller = new ControllerAcompanhante();
        $rs = $controller->BuscarDadosFiliado($id);
        
        if($rs != false){
            
            if($rs->foto_perfil != null){
?>
        <div class="foto_perfil"><a href="../perfil-filiado.php?codigo=<?php echo $rs->id_filiado ?>"> <img src="<?php echo '../'.$rs->foto_perfil ?>" alt="Ver perfil"></a> </div>
        
<?php       } 
?>
        <ul class="lst_dados_usuario">
            
            <li><p>codigo</p> <span><?php echo $rs->id_filiado ?></span></li>
            <li><p>nome</p> <span><?php echo $rs->nome ?></span></li>
            <li><p>nasc</p> <span><?php echo $rs->nasc ?></span></li>
            <li><p>email</p> <span><?php echo $rs->email ?></span></li>
            <li><p>senha</p> <span><?php echo $rs->senha ?></span></li>
            <li><p>celular1</p> <span><?php echo $rs->celular1 ?></span></li>
            <li><p>celular2</p> <span><?php echo $rs->celular2 ?></span></li>
            <li><p>sexo</p> <span><?php echo $rs->sexo ?></span></li>
            <li><p>apresentacao</p> <span><?php echo $rs->apresentacao ?></span></li>
            <li><p>altura</p> <span><?php echo $rs->altura ?></span></li>
            <li><p>peso</p> <span><?php echo $rs->peso ?></span></li>
            <li><p>conta_ativa</p> <span><?php echo $rs->conta_ativa ?></span></li>
            <li><p>acompanha</p> <span><?php echo $rs->acompanha ?></span></li>
            <li><p>cobrar</p> <span><?php echo $rs->cobrar ?> ,00 </span></li>
            <li><p>uf</p> <span><?php echo $rs->uf ?></span></li>
            <li><p>cidade</p> <span><?php echo $rs->cidade ?></span></li>
            <li><p>data_cadastro</p> <span><?php echo $rs->data_cadastro ?></span></li>
            <li><p>nomeCard</p> <span><?php echo $rs->nomeCard ?></span></li>
            <li><p>sobrenomeCard</p> <span><?php echo $rs->sobrenomeCard ?></span></li>
            <li><p>telefone</p> <span><?php echo $rs->telefone ?></span></li>
            <li><p>rua</p> <span><?php echo $rs->rua ?></span></li>
            <li><p>numero</p> <span><?php echo $rs->numero ?></span></li>
            <li><p>bairro</p> <span><?php echo $rs->bairro ?></span></li>
            <li><p>cidadeCard</p> <span><?php echo $rs->cidadeCard ?></span></li>
            <li><p>ufCard</p> <span><?php echo $rs->ufCard ?></span></li>
            <li><p>cep</p> <span><?php echo $rs->cep ?></span></li>
            <li><p>desconto</p> <span><?php echo $rs->desconto ?>,00 </span></li>
            <li><p>cpf</p> <span><?php echo $rs->cpf ?></span></li>
            <li> <a href="?" class="botao"> OK </a> </li>
<?php 
            
        }
?>
            
        </ul>
        
    </div>
<?php 
    }
?>
    <div id="hospedes">
        <table class="lst_hospedes">
            <tr class="tbl_titulo">
                <td> Codigo: </td><td> Nome: </td><td> Nasc: </td><td> Uf </td><td> Cobra </td><td> CPF </td><td> Ver </td> 
            </tr>
            
        <?php 
            $controller = new ControllerAcompanhante();
            $rs = $controller->ListarAcompanhantes();
            
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
                echo "<tr><td colspan='6'> Não encontrado </td></tr>";
            }
        ?>    
        </table>
    </div>
    
    <br>
    <br>
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

