    <h1 class="titulo_maior"> Ver lucro </h1>


    <div id="lucro">
        <?php
            $controller = new ControllerLucro();
        
            $dia = date('d');
        
            if($dia == 10){
                $rs = $controller->LucroMesAtual();
            }else{
                $rs = false;
            }
        
            if($rs != false){
                $lucro = 'R$ '.$rs->lucro.',00';
                $desconto = $rs->desconto;
                $usersDesconto = $rs->usersDesconto;
            }else{
                $lucro = "Ainda não realizado";
                $desconto = '';
                $usersDesconto = '';
            }
        
        ?>
        <p class="titulo"> Mês atual: <?php echo $lucro ?>. </p>
        <p> Usuários com desconto:    <?php echo $desconto ?> </p>
        <p> Total descontos:          <?php echo $usersDesconto ?></p>
        <br>
        <div class="content_lucro">
            
            <h2> Ver média por tipo de conta </h2>
        <?php
            $rs = $controller->BuscarUsersTipoConta();
            if($rs != false){
                
                $cont = 0;
                while($cont < count($rs)){
                    $titulo = $rs[$cont]->titulo;
                    $nmrUsuarios = $rs[$cont]->nmrUsers;
                    $lucroMedia = $rs[$cont]->lucro;
        ?>
            <div class="conta">
                <p><b>Titulo do plano:</b> <?php echo $titulo ?> </p>
                <p><b>Qtd. usuários:</b>  <?php echo $nmrUsuarios ?></p>
                <p><b>Lucro em média:</b><?php echo 'R$ '.$lucroMedia.',00' ?></p>
            </div>
        <?php
                    $cont++;
                }
            }else{
                echo 'Não foram encontrados cientes cadastrados';
            }
        ?>
            
        </div>
        
        <p class="titulo"> Histórico do lucro mensal </p>
        <div class="content_lucro">
        <?php
        
            $rs = $controller->HistoricoMensal();
        
            if($rs != false){
                
                $cont = 0;
                while($cont < count($rs)){
                    $mesAno = $rs[$cont]->mesAno;
                    $nmrUsuarios = $rs[$cont]->nmrUsers;
                    $nmrUsuariosDesc = $rs[$cont]->nmrUsersDesc;
                    $totalDesc = $rs[$cont]->totalDesc;
                    $lucroMedia = $rs[$cont]->lucro;
        ?>
            <div class="conta">
                <p><b>Mes:</b> <?php echo $mesAno ?></p>
                <p><b>Qtd. usuários:</b> <?php echo $nmrUsuarios ?></p>
                <p><b>Usuários com desconto:</b> <?php echo $nmrUsuariosDesc ?></p>
                <p><b>Total descontos:</b> <?php echo $totalDesc ?></p>
                <p><b>Lucro teste:</b> R$ <?php echo $lucroMedia ?>,00</p>
            </div>
        <?php
                    $cont++;
                }
            }else{
                echo 'Não foi encontrado o histórico de pagamento';
            }
        ?>
        </div>
    </div>

