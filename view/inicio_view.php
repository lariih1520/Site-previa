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
                    <h1 class="titulo"><a href="exibir-todos<?php echo $php ?>?var=mulheres">
                        <img src="icones/femini.png" class="icone" alt="Feminino" title="Mulheres">
                        <strong> Mulheres </strong></a>
                    </h1>
                    
                <?php
                    $sexo = 1;
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarFiliadosSexo($sexo.'.', null, 9, null);
                    
                ?>
                    <div class="carrossel">
                        <ul>
                    <?php
                        if($rs != false){

                            $cont = 0;
                            while($cont < count($rs)){

                                $foto = $rs[$cont]->foto;
                                $id = $rs[$cont]->id;
                                $nome = $rs[$cont]->apelido;
                                $idade = $rs[$cont]->idade;
                                $uf = $rs[$cont]->uf;
                                $acompanha = $rs[$cont]->acompanha;

                        ?>
                            <li>
                                <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $id ?>">
                                <div class="img_carrossel">
                                    <img src="<?php echo $foto ?>" alt="Foto carrossel"/>
                                </div>
                                <div class="tonight"></div>
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
                        }else{
                            echo "<center> Infelismente não há mulheres cadastradas </center>";
                        }
                    ?>
                        </ul>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both;"></div>
                </div>


                <!-- Lista de usuários homens -->
                <div id="homens">
                    <p class="titulo"><a href="exibir-todos<?php echo $php ?>?var=homens">
                        <img src="icones/masc.jpg" class="icone" alt="Masculino" title="Homens">
                        <strong> Homens </strong> </a>
                    </p>
                    
                     <?php
                        $sexo = 2;
                        $rs = $controller->BuscarFiliadosSexo($sexo.'.', null, 9, null);
                    ?>
                        <div id="carrossel2" class="carrossel">
                            <ul>
                        <?php
                            if($rs != false){

                                $cont = 0;
                                while($cont < count($rs)){

                                    $foto = $rs[$cont]->foto;
                                    $id = $rs[$cont]->id;
                                    $nome = $rs[$cont]->apelido;
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
                                        <div class="tonight"></div>
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
                            }else{
                                echo "<center> Infelismente não há homens cadastrados </center>";
                            }
                        ?>
                            </ul>
                            <div style="clear:both;"></div>
                        </div>
                    <div style="clear:both;"></div>
                </div>
                