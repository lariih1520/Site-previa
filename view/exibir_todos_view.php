<?php
    if(!empty($_GET['var'])){ 
        $genero = $_GET['var'];
        
    }else{ 
        $genero =0;
    }

    $sf = '';
    $sm = '';
    $am = '';
    $ah = '';
    $ad = '';

    if($genero == 'homens'){
        $sm = 'selected';
        
    }elseif($genero == 'mulheres'){
        $sf = 'selected';
    }
    
?>

<div id="filtro">
    <form action="?" method="get" id="form">
    <ul class="lst_filtro">
        <li> Etnia:  
            <select name="slc_etnia">
                <option value="0"> Selecione </option>
            <?php

                $controller = new ControllerAcompanhante();
                $rs = $controller->BuscarEtnias();

                if($rs != null){
                    $cont = 0;

                    while($cont < count($rs)){
                        $id_et = $rs[$cont]->id_etnia;
                        $etnia = $rs[$cont]->etnia;


                        if($etniafld == $etnia){
                            $id_et = 'value="'.$id_et.'" selected';

                        }else{
                            $id_et = 'value="'.$id_et.'" ';
                        }

            ?>
                <option <?php echo $id_et ?>> <?php echo $etnia ?> </option>
            <?php          
                        $cont++;
                    }
                }

            ?>
            </select>
        </li>
        <li> Cabelo: 
            <select name="slc_cor_cabelo">
                <option value="0"> Selecione </option>
                <?php

                    $controller = new ControllerAcompanhante();
                    $rs = $controller->BuscarCorCabelo();

                    if($rs != null){
                        $cont = 0;

                        while($cont < count($rs)){
                            $id_cabelo = $rs[$cont]->id_cabelo;
                            $cor = $rs[$cont]->cor;

                            if($cor == $id_cabelo){
                                $id_cabelo = 'value="'.$id_cabelo.'" selected';

                            }else{
                                $id_cabelo = 'value="'.$id_cabelo.'" ';
                            }

                ?>
                    <option <?php echo $id_cabelo; ?> > <?php echo $cor ?> </option>
                <?php          
                            $cont++;
                        }
                    }                    

                ?>
            </select>
        </li>
        <li> Sexo:  
            <select name="slc_sexo" required>
                <option value="0"> Selecione </option>
                <option value="1" <?php echo $sf ?>> Feminino </option>
                <option value="2" <?php echo $sm ?>> Masculino </option>
            </select>
        </li>
        <li> Acompanha:
            <select name="slc_acompanha">
                <option value="0"> Selecione </option>
                <option value="1" <?php echo $am ?>> Mulheres </option>
                <option value="2" <?php echo $ah ?>> Homens </option>
                <option value="3" <?php echo $ad ?>> Os dois </option>
            </select>
        </li>
        <li class="pesquisa">
            <p onclick="form.submit();">
            <img src="icones/pesquisa.png" class="icone" alt="pesquisar">
            </p>
        </li>
    </ul>
    </form>
</div>


<div id="lista_acompanhantes">
    
    <div class="acompanhante">
        <img src="imagens/usuario.jpg">
        <p> Nome: Estado: </p>
        
    </div>
    <div class="acompanhante">
        <img src="imagens/usuario.jpg">
        <p> Nome: Estado: </p>
        
    </div>
    <div class="acompanhante">
        <img src="imagens/usuario.jpg">
        <p> Nome: Estado: </p>
        
    </div>
    
    <div style="clear: both;"></div>
</div>
