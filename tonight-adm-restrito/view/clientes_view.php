    <h1 class="titulo_maior"> Lista de todos os clientes do site </h1>
    
<?php 
    if(isset($_GET['modo'])){
?>
    <div id="visualizar">
            
<?php 
        $id = $_GET['codigo'];
        $controller = new ControllerCliente();
        $rs = $controller->BuscarDadosCliente($id);
        
        if($rs != false){
            
            if($rs->foto_perfil != null){
?>
        <div class="foto_perfil"><a href="../perfil-filiado.php?codigo=<?php echo $rs->id_filiado ?>"> <img src="<?php echo '../'.$rs->foto_perfil ?>" alt="Ver perfil"></a> </div>
        
<?php       } 
?>
        <ul class="lst_dados_usuario">
            
            <li><p>codigo</p> <span><?php echo $rs->id_cliente ?></span></li>
            <li><p>nome</p> <span><?php echo $rs->nome ?></span></li>
            <li><p>nasc</p> <span><?php echo $rs->nasc ?></span></li>
            <li><p>email</p> <span><?php echo $rs->email ?></span></li>
            <li><p>senha</p> <span><?php echo $rs->senha ?></span></li>
            <li><p>celular</p> <span><?php echo $rs->celular ?></span></li>
            <li><p>sexo</p> <span><?php echo $rs->sexo ?></span></li>
            <li><p>uf</p> <span><?php echo $rs->uf ?></span></li>
            <li><p>cidade</p> <span><?php echo $rs->cidade ?></span></li>
            <li><p>data_cadastro</p> <span><?php echo $rs->data_cadastro ?></span></li>
<!--            <li><p>cpf</p> <span><?php echo $rs->cpf ?></span></li> -->
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
                <td> Codigo: </td><td> Nome: </td><td> Nasc: </td><td> Uf </td><td> CPF </td><td> Ver </td> 
            </tr>
            
        <?php 
            $controller = new ControllerCliente();
            $rs = $controller->ListarClientes();
            
            if($rs != null){
                
                $cont = 0;
                while($cont < count($rs)){
                    $codigo = $rs[$cont]->id_filiado;
                    $nome   = $rs[$cont]->nome;
                    $nasc   = $rs[$cont]->nasc;
                    $uf     = $rs[$cont]->uf;
                    $cpf    = $rs[$cont]->cpf;
        ?>
            <tr>
                <td> <?php echo $codigo ?> </td>
                <td> <?php echo $nome ?>   </td>
                <td> <?php echo $nasc ?>   </td> 
                <td> <?php echo $uf ?>     </td> 
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