    <h1 class="titulo_maior"> Planos - Conta dos hospedes </h1>
    
    <div id="ver_planos">
<?php
        $controller = new ControllerPlanos();
        $rs = $controller->ListarPlanos();
        
        if($rs != false){
            
            $cont = 0;
            while($cont < count($rs)){
?>
        <ul class="lst_planos">
            <li><p> Titulo: </p>
                <span> <?php echo $rs[$cont]->titulo ?> </span>
            </li>
            <li><p> Preço: </p>
                <span> R$ <?php echo $rs[$cont]->preco ?>,00 </span>
            </li>
            <li><p> Qtd. de fotos: </p>
                <span> <?php echo $rs[$cont]->nmrFotos ?> </span>
            </li>
            <li><p> Qtd. de vídeos: </p>
                <span> <?php echo $rs[$cont]->nmrVideos ?> </span>
            </li>
            <li>
                <p> Nmr de usuários </p>
                <span> <?php echo $rs[$cont]->nmrUsuarios ?> </span>
            </li>
            <li>
                <a href="?editar=<?php echo $rs[$cont]->id ?>"> Ver &#124; Editar </a>
            </li>
        </ul>
<?php
                $cont++;
            }
            
        }else{
            echo 'Não foram encontrados planos';
        } 
?>
        <div id="adicionar">
            <a href="?adicionar">
            <img src="icones/add.png" class="icone" alt="add" title="Adicionar plano">
            </a>
        </div>
    </div>
    

<?php
    if(isset($_GET['editar'])){
        $id = $_GET['editar'];
        $controller = new ControllerPlanos();
        $rs = $controller->BuscarPlano($id);
        
        if($rs != false){
?>
    <form id="editar_planos" action="router.php?controller=plano&modo=alterar&id=<?php echo $rs->id ?>" method="post">
        <p class="titulo"> Editar dados </p>
        
        <ul class="lst_planos">
            <li><p> Titulo: </p>
                <input type="text" name="txtTitulo" value="<?php echo $rs->titulo ?>">
            </li>
            <li><p> Preço: </p>
                R$ <input type="text" name="txtPreco" value="<?php echo $rs->preco ?>" size="3">,00
            </li>
            <li><p> Numero de fotos: </p>
                <span> <?php echo $rs->nmrFotos ?> </span>
            </li>
            <li><p> Numero de vídeos: </p>
                <span> <?php echo $rs->nmrVideos ?> </span>
            </li>
            <?php
                if($rs->nmrUsuarios == 0){
                    
            ?>
            <li>
                <a onclick="confirmDelete('<?php echo $rs->id ?>');">
                <img src="icones/delete.png" class="icone">
                </a>
            </li>
            <?php
                }
            ?>
        </ul>
         <?php
            if($rs->nmrUsuarios > 0){
                    
        ?>
            <p class="margem">
                (Não é possível excluir este plano)
            </p>
        <?php
            }
        ?>
        <p class="margem">
            <input type="submit" name="btnSalvar" value="Salvar" class="botao"> 
            <a href="?"> Cancelar </a>
        </p>
    </form>
    <script>
        
        function confirmDelete(id){
            
            decisao = confirm('Deseja realmente excluir o plano?')

            if(decisao){
                window.location.href = "router.php?controller=plano&modo=del&id="+id;
                
            }else{
                return false;
            }
        }
        
    </script>
<?php

        }
        
    }
    
    if(isset($_GET['adicionar'])){
        
?>    
    <form id="editar_planos" action="router.php?controller=plano&modo=add" method="post">
        <p class="titulo"> Adicionar plano </p>
        
        <ul class="lst_planos">
            <li><p> Titulo: </p>
                <input type="text" name="txtTitulo">
            </li>
            <li><p> Preço: </p>
                R$ <input type="text" name="txtPreco" size="3">,00
            </li>
            <li><p> Numero de fotos: </p>
                <input type="text" name="txtNmrFotos" size="3">
            </li>
            <li><p> Numero de vídeos: </p>
                <input type="text" name="txtNmrVideos" size="3">
            </li>
        </ul>
        <p class="margem">
            <input type="submit" name="btnSalvar" value="Salvar" class="botao"> 
            <a href="?"> Cancelar </a>
        </p>
    </form>
<?php
    }

?>