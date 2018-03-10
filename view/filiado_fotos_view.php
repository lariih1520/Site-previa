<?php
    $id = $_SESSION['id_filiado'];

    $controller = new ControllerAcompanhante();
    
    /* Buscar quantas fotos o usuário pode colocar */
    $rs = $controller->BuscarTipoConta();
    $qtdfotos = $rs->qtd_fotos;
    $videos = $rs->qtd_videos;
    
    /* Buscar fotos já cadastradas se existirem */
    $result = $controller->BuscarImagensFiliado();
    $nmr = 0;

    /* Qtd de fotos que ainda podem ser colocadas */
    if($result != false){
        $nmr = count($result);
    }

    $fotos = $qtdfotos - $nmr;
    
    if($videos == 1){ $qtd = 'Video'; }
    elseif($videos > 1){ $qtd = 'Videos'; }

?>
    <h1 class="titulo_maior"> Escolha as fotos que você deseja publicar! </h1>

    <?php
        
        $res = $controller->BuscarFotoPerfil($id);
        if($res != false){
            
            if(!empty($_GET['editar'])){
    ?>
            <!--     Editar foto do perfil      -->
            <form id="formulario" method="post" enctype="multipart/form-data" action="router<?php echo $php ?>?controller=acompanhante&modo=perfil&id=<?php echo $id ?>" class="content_perfil">
                <div class="img_perfil" id="ver">
                    <img src="<?php echo $res ?>" alt="Editar foto de perfil">
                </div>
                <p><input type="file" name="flPerfil" id="imgperfil"></p>

            </form>
            <script type="text/javascript">
            $(document).ready(function(){

                 $('#formulario').live('change',function(){

                     $('#ver').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
                     setTimeout(function(){

                        $('#formulario').ajaxForm({
                        target:'#ver'
                        }).submit();

                     });

                 });

             })

           </script>
                
    <?php   
            }else{
    ?>
            <!-- Exibir a foto de perfil se já estiver cadastrada -->
            <div class="content_perfil">
                <div class="img_perfil" id="ver">
                    <img src="<?php echo $res ?>" alt="Foto">
                </div>
            </div>
    <?php
            }
        }else{
    ?>

    <!-- cadastrar foto do perfil se ainda não existir -->
    <form id="formulario" method="post" enctype="multipart/form-data" action="router<?php echo $php ?>?controller=acompanhante&modo=perfil&id=<?php echo $id ?>" class="content_perfil">
        <div class="img_perfil" id="ver">
            
        </div>
        <p><input type="file" name="flPerfil" id="imgperfil"></p>
        
    </form>
    <script type="text/javascript">
    $(document).ready(function(){

         $('#formulario').live('change',function(){

             $('#ver').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
             setTimeout(function(){

                $('#formulario').ajaxForm({
                target:'#ver'
                }).submit();

             });

         });

     })

   </script>
    <?php
        }
    ?>

    <!--  Cadastrar as fotos permitidas de acordo com o seu tipo de conta  -->
    <div id="content_midia">
        <p class="enunciado"> De acordo com a conta de sua escolha você pode postar <?php echo $qtdfotos ?> fotos. </p>
        
        
        <!-- Exibir as fotos já cadastradas se existirem -->
    <?php
        $cont = 0;
        while($cont < $nmr){
            
            if(!empty($_GET['editar'])){
    ?>
            <form id="frm<?php echo $cont ?>" method="post" enctype="multipart/form-data" action="router<?php echo $php ?>?controller=acompanhante&modo=foto&id=<?php echo $id ?>&name=fl<?php echo $cont; ?>&editar=<?php echo $result[$cont]->id_midia; ?>" class="imgs_filiado">
                <div class="img" id="ver<?php echo $cont ?>">
                    <img src="<?php echo $result[$cont]->foto ?>" alt="Editar foto">
                </div>
                <input type="file" id="img<?php echo $cont; ?>" name="fl<?php echo $cont; ?>">
            </form>

            <script type="text/javascript">
            $(document).ready(function(){

                 $('#img<?php echo $cont; ?>').live('change',function(){

                     $('#ver<?php echo $cont ?>').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
                     setTimeout(function(){

                        $('#frm<?php echo $cont ?>').ajaxForm({
                        target:'#ver<?php echo $cont ?>'
                        }).submit();

                     });

                 });

             })

           </script>
            
    <?php
            }else{
    ?>
        <div class="imgs_filiado">
            <div class="img">
                <img src="<?php echo $result[$cont]->foto ?>" alt="Foto">
            </div>
        </div>
        
    <?php 
            }
            
            $cont++;
        }
        
          
        /**** Cadastrar fotos na conta do usuário ****/
          
        $cont = 0;
        while($cont < $fotos){
    ?>
        <form id="frm<?php echo $cont ?>" method="post" enctype="multipart/form-data" action="router<?php echo $php ?>?controller=acompanhante&modo=foto&id=<?php echo $id ?>&name=fl<?php echo $cont; ?>" class="imgs_filiado">
            <div class="img" id="ver<?php echo $cont ?>">
                
            </div>
            <input type="file" id="img<?php echo $cont; ?>" name="fl<?php echo $cont; ?>">
        </form>
        
        <script>
        $(document).ready(function(){
            
             $('#img<?php echo $cont; ?>').live('change',function(){
                
                 $('#ver<?php echo $cont ?>').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
                 setTimeout(function(){
                    
                    $('#frm<?php echo $cont ?>').ajaxForm({
                    target:'#ver<?php echo $cont ?>'
                    }).submit();

                 });
                
             });
            
         })
	 
	   </script>
        
    <?php
            $cont++;
        }
    ?>
        
        <div style="clear: both;"></div>
    </div>
    

    <!--  Se aconta permitir que o usuário poste videos  -->
<?php if($videos > 0){ ?>
    <div id="content_videos">
        <p class="enunciado"> De acordo com a conta de sua escolha você pode postar <?php echo $videos.' '.$qtd ?>. </p>
        
    <?php
    
        if(!empty($_GET['editar']) and $_GET['editar'] != 'videos'){
            /*** Ver videos ja cadastrados ***/
            $rs = $controller->BuscarVideosFiliado();

            $cont = 0;
            if($rs != false){

                while($cont < count($rs)){
        ?>
                <div class="videos_filiado">
                    <video width="350" height="300" controls>
                            <source src="<?php echo $rs[$cont]->video ?>" type="video/mp4">
                            <object width="400" height="260">
                                <param name="allowFullScreen" value="true"/>
                                <param name="allowscriptaccess" value="always"/>
                            </object>
                    </video>
                </div>
        <?php
                    $cont++;
                }
            }
        
        }else{
            /*** Editar videos ***/
            $rs = $controller->BuscarVideosFiliado();

            $cont = 0;
            if($rs != false){

                while($cont < count($rs)){
        ?>
            <form id="frmv<?php echo $cont ?>" method="post" enctype="multipart/form-data" 
                  action="router.php?controller=acompanhante&modo=video&id=<?php echo $id ?>&name=flv<?php echo $cont; ?>&editar=<?php echo $rs[$cont]->id_midia; ?>" 
                  class="imgs_filiado">
                <div class="img" id="verv<?php echo $cont ?>">                              

                    <video width="350" height="300" controls loop controlsList="nodownload">
                            <source src="<?php echo $rs[$cont]->video ?>" type="video/mp4">
                            <object width="400" height="260">
                                <param name="allowFullScreen" value="true"/>
                                <param name="allowscriptaccess" value="always"/>
                            </object>
                    </video>
                   
                </div>
                <input type="file" id="video<?php echo $cont; ?>" name="flv<?php echo $cont; ?>">
            </form>

            <script>
            $(document).ready(function(){

                 $('#video<?php echo $cont; ?>').live('change',function(){

                     $('#ver<?php echo $cont ?>').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
                     setTimeout(function(){

                        $('#frmv<?php echo $cont ?>').ajaxForm({
                        target:'#verv<?php echo $cont ?>'
                        }).submit();

                     });

                 });

             })

           </script>
        <?php
                    $cont++;
                }
            }
        }
                      
                      
        /*** Videos que ainda podem ser cadastrados ***/
        $videos = $videos - $cont;
                      
        $cont = 0;
        while($cont < $videos){
    ?>
        <form id="frmv<?php echo $cont ?>" method="post" enctype="multipart/form-data" action="router.php?controller=acompanhante&modo=video&id=<?php echo $id ?>&name=flv<?php echo $cont; ?>" class="imgs_filiado">
            <div class="img" id="verv<?php echo $cont ?>">
                
            </div>
            <input type="file" id="video<?php echo $cont; ?>" name="flv<?php echo $cont; ?>">
        </form>
        
        <script>
        $(document).ready(function(){
            
             $('#video<?php echo $cont; ?>').live('change',function(){
                
                 $('#ver<?php echo $cont ?>').html('<img src="ajax-loader.gif" alt="Enviando..."/>');
                 setTimeout(function(){
                    
                    $('#frmv<?php echo $cont ?>').ajaxForm({
                    target:'#verv<?php echo $cont ?>'
                    }).submit();

                 });
                
             });
            
         })
	 
	   </script>
        
        
    <?php
            $cont++;
        }
    ?>
    </div>

<?php }  ?>



    <!-- Botão que redirecioan para o perfil -->
    <p class="botao"><a href="perfil-filiado<?php echo $php ?>"> Concluido </a></p>


