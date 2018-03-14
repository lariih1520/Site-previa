                <!-- Início do slide de fotos -->
                <div id="slide">
                    <figure>
					<!-- CONTROLADORES -->
                       <span class="trs next"></span>
                       <span class="trs prev"></span>

                     <!-- IMAGENS DO SLIDE -->
                    <div id="slider">
                        <!--<a href="#" class="trs"><img src="imagens/free-wallpaper.jpg" alt="" /></a>
                        <a href="#" class="trs"><img src="imagens/back.png" alt="" /></a>-->
                        
                        <?php
                            require_once('controller/home_controller.php');
                            $controller = new ControllerHome();
                            $rs = $controller->BuscarFotos();

                            $cont = 0;
                            if($rs != false){

                                while($cont < count($rs)){
                                    $img = $rs[$cont]->imagem;
                        ?>
                                <a href="#" class="trs"><img src="<?php echo $img ?>" alt="" /></a>

                        <?php
                                    $cont++;

                                }

                            }else{
                                echo 'Ainda não há imagens';

                            }

                        ?>
                       </div>

                       <figcaption></figcaption>
                    </figure>
                </div>
                
                <!-- Lista de usuários mulheres -->
                <div id="mulheres">
                    <h1 class="titulo"><a href="exibir-todos<?php echo $php ?>?var=mulheres"><strong> Mulheres &raquo; </strong></a></h1>
                    
                <?php
                    $sexo = 1;
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarFiliadosSexo($sexo, null, 15, null);
                    
                    if(count($rs) > 3){
                ?>
                    <div class="content">
                        <div class="menu-carrossel">
                            <a href="#" class="prev1" title="Anterior"> 
                               <img src="icones/left.png" class="icone" alt="anterior">
                            </a>
                        </div>
                <?php
                    }
                ?>
                        <div id="carrossel1" class="carrossel">
                            <ul>
                        <?php
                            if($rs != false){
                                    
                                $cont = 0;
                                while($cont < count($rs)){
                                    
                                    $foto = $rs[$cont]->foto;
                                    $id = $rs[$cont]->id;
                                    $nome = $rs[$cont]->nome;
                                    $idade = $rs[$cont]->idade;
                                    $uf = $rs[$cont]->uf;
                                    $acompanha = $rs[$cont]->acompanha;

                            ?>
                                <li>
                                    <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $id ?>">
                                    <div class="img_carrossel">
                                        <img src="<?php echo $foto ?>" alt="Foto carrossel"/>
                                    </div>
                                    <div class="apresentacao">
                                        <p> Nome: </p>
                                        <span><?php echo ucfirst($nome) ?></span>

                                        <p> Estado: 
                                            <?php echo $uf ?>
                                        </p>

                                        <p> Acompanha: </p>
                                        <?php echo $acompanha ?>
                                    </div>
                                    </a>
                                </li>
                        <?php
                                    $cont++;
                                }
                            }
                        ?>
                            </ul>
                        </div>
                        
                <?php
                    if(count($rs) > 3){
                ?>
                        <div class="menu-carrossel">
                            <a href="#" class="next1" title="Próximo"> 
                                <img src="icones/right.png" class="icone" alt="proximo">
                            </a>
                        </div>
                    </div>
                   
                    <script>	
                        $(function() {
                            $("#carrossel1").jCarouselLite({
                                btnPrev: '.prev1', 
                                btnNext: '.next1',
                                visible: 3
                            })
                        })
                    </script>
                <?php
                                 
                    }
                ?>
                </div>


                <!-- Lista de usuários homens -->
                <div id="homens">
                    <p class="titulo"><a href="exibir-todos<?php echo $php ?>?var=homens"><strong> Homens &raquo;</strong> </a></p>
                    <div class="content">
                     <?php
                        $sexo = 2;
                        $rs = $controller->BuscarFiliadosSexo($sexo, null, 15, null);

                        if(count($rs) > 3){
                    ?>
                        <div class="content">
                            <div class="menu-carrossel">
                                <a href="#" class="prev2" title="Anterior"> 
                                   <img src="icones/left.png" class="icone" alt="anterior">
                                </a>
                            </div>
                    <?php
                        }
                    ?>
                            <div id="carrossel2" class="carrossel">
                                <ul>
                            <?php
                                if($rs != false){

                                    $cont = 0;
                                    while($cont < count($rs)){

                                        $foto = $rs[$cont]->foto;
                                        $id = $rs[$cont]->id;
                                        $nome = $rs[$cont]->nome;
                                        $idade = $rs[$cont]->idade;
                                        $uf = $rs[$cont]->uf;
                                        $acompanha = $rs[$cont]->acompanha;
                                        
                                        $n = explode(' ', $nome);
                                        $nome = $n[0];

                            ?>
                                    <li>
                                        <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $id ?>">
                                            <div class="img_carrossel">
                                                <img src="<?php echo $foto ?>" alt="Foto de perfil" />
                                            </div>
                                            <div class="apresentacao">
                                                <p> Nome: </p>
                                                <span><?php echo ucfirst($nome) ?></span>

                                                <p> Estado: 
                                                    <?php echo $uf ?>
                                                </p>

                                                <p> Acompanha: </p>
                                                <?php echo $acompanha ?>
                                            </div>
                                        </a>
                                    </li>
                            <?php
                                        $cont++;
                                    }
                                }
                            ?>
                                </ul>
                            </div>
<!--
<p> Online </p><img src="icones/online.png" class="on_off"><img src="icones/offline.png" class="on_off">
-->
                    <?php
                        if(count($rs) > 3){
                    ?>
                            <div class="menu-carrossel">
                                <a href="#" class="next2" title="Próximo"> 
                                    <img src="icones/right.png" class="icone" alt="proximo">
                                </a>
                            </div>
                        </div>

                        <script>	
                            $(function() {
                                $("#carrossel2").jCarouselLite({
                                    btnPrev: '.prev2', 
                                    btnNext: '.next2',
                                    visible: 3
                                })
                            })
                        </script>
                <?php
                                 
                    }
                ?>
                    </div>
                </div>
                