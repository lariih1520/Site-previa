                <!-- Início do slide de fotos -->
                <div id="slide">
                    <figure>
					<!-- CONTROLADORES -->
                       <span class="trs next"></span>
                       <span class="trs prev"></span>

                     <!-- IMAGENS DO SLIDE -->
                    <div id="slider">
                        <a href="#" class="trs"><img src="imagens/free-wallpaper.jpg" alt="" /></a>
                        <a href="#" class="trs"><img src="imagens/back.png" alt="" /></a>
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
                    <h1 class="titulo"> Mulheres </h1>
                    <div class="content">
                        <div class="menu-carrossel">
                            <a href="#" class="prev1" title="Anterior"> 
                               <img src="icones/left.png" class="icone">
                            </a>
                        </div>
                        <div id="carrossel1" class="carrossel">
                            <ul>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuaria.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        Tal pessoa
                                        <p>Idade: </p>
                                        tantos anos
                                        <p> Online </p>
                                        <img src="icones/online.png" class="on_off">
                                        <img src="icones/offline.png" class="on_off">
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuaria.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuaria.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuaria.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-carrossel">
                            <a href="#" class="next1" title="Próximo"> 
                                <img src="icones/right.png" class="icone">
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
                    
                </div>


                <!-- Lista de usuários homens -->
                <div id="homens">
                    <p class="titulo"> Homens </p>
                    <div class="content">
                        <div class="menu-carrossel">
                            <a href="#" class="prev2" title="Anterior"> 
                                <img src="icones/left.png" class="icone">
                            </a>
                        </div>
                        <div id="carrossel2" class="carrossel">
                            <ul>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuario.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        Tal pessoa
                                        <p>Idade: </p>
                                        tantos anos
                                        <p> Online </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuario.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuario.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img_carrossel">
                                        <img src="icones/usuario.jpg" />
                                    </div>
                                    <div class="apresentacao">
                                        <p>Nome: </p>
                                        <p>Idade: </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-carrossel">
                            <a href="#" class="next2" title="Próximo"> 
                                <img src="icones/right.png" class="icone">
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
                </div>
                