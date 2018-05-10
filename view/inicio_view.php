                <!-- Início do slide de fotos -->
                <div id="slide">
                    <figure>
					<!-- CONTROLADORES -->
                       <span class="trs next"></span>
                       <span class="trs prev"></span>

                     <!-- IMAGENS DO SLIDE -->
                    <div id="slider">
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
                
                <!-- Começo dos Slides-->
                <?php
                $fotosslide = new Inicio();
                $resp = $fotosslide->FotosSlide();
                
                if($resp != false){
                ?>
                <div class="w3-content w3-display-container">
                    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                <?php
                     
                    $nmr = (int)(count($resp) / 4);
                        
                    $cnt = 0;
                    while($cnt < $nmr){
                        $img1 = $resp[$cnt]->imgSlide;
                        $id1 = $resp[$cnt]->id_filiado;
                        $cnt++;
                        $img2 = $resp[$cnt]->imgSlide;
                        $id2 = $resp[$cnt]->id_filiado;
                        $cnt++;
                        $img3 = $resp[$cnt]->imgSlide;
                        $id3 = $resp[$cnt]->id_filiado;
                        $cnt++;
                        $img4 = $resp[$cnt]->imgSlide;
                        $id4 = $resp[$cnt]->id_filiado;

                ?>
                        <div class="mySlides">
                            <a href="perfil-filiado.php?codigo=<?php echo $id1 ?>"><img src="<?php echo $img1 ?>" alt="Fotos slide"></a>
                            <a href="perfil-filiado.php?codigo=<?php echo $id2 ?>"><img src="<?php echo $img2 ?>" alt="Fotos slide"></a>
                            <a href="perfil-filiado.php?codigo=<?php echo $id3 ?>"><img src="<?php echo $img3 ?>" alt="Fotos slide"></a>
                            <a href="perfil-filiado.php?codigo=<?php echo $id4 ?>"><img src="<?php echo $img4 ?>" alt="Fotos slide"></a>
                        </div>
                <?php
                        $cnt++;
                    }
                    
                ?>
                    <button class="w3-button w3-black w3-display-right" style="margin-left:-40px;" onclick="plusDivs(1)">&#10095;</button>
                </div>

                <script>/* Slide automático */
                    var slideIndex = 0;
                    carousel();

                    function carousel() {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                          x[i].style.display = "none"; 
                        }
                        slideIndex++;
                        if (slideIndex > x.length) {slideIndex = 1} 
                        x[slideIndex-1].style.display = "block"; 
                        setTimeout(carousel, 3000); //Mudar imagem a cada 3 segundos
                    }
                </script>
                <script>/* Slide manual */
                    var slideIndex = 1;
                    showDivs(slideIndex);

                    function plusDivs(n) {
                      showDivs(slideIndex += n);
                    }

                    function showDivs(n) {
                      var i;
                      var x = document.getElementsByClassName("mySlides");
                      if (n > x.length) {slideIndex = 1}    
                      if (n < 1) {slideIndex = x.length}
                      for (i = 0; i < x.length; i++) {
                         x[i].style.display = "none";  
                      }
                      x[slideIndex-1].style.display = "block";  
                    }
                </script>
                <?php
                }
                ?>
                <!-- Lista de usuários mulheres -->
                <div id="mulheres">
                    <h1 class="titulo"><a href="exibir-todos<?php echo $php ?>?var=mulheres">
                        <img src="icones/femini.png" class="icone" alt="Feminino" title="Mulheres">
                        <strong> Mulheres </strong></a>
                    </h1>
                    
                <?php
                    $sexo = 1;
                    
                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarFiliadosSexo($sexo.'.', null, 6, null);
                    
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
                        $rs = $controller->BuscarFiliadosSexo($sexo.'.', null, 6, null);
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
                