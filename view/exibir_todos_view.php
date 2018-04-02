<?php

    if(!empty($_GET['var'])){ 
        $genero = $_GET['var'];
        
    }else{ 
        $genero = '0';
    }

    $sf = '';
    $sm = '';
    $am = '';
    $ah = '';
    $ad = '';

    if(isset($_GET['buscar'])){
        $etniafltr = $_GET['slc_etnia'];
        $cabelofltr = $_GET['slc_cor_cabelo'];
        $sexo = $_GET['slc_sexo'];
        $acompanha = $_GET['slc_acompanha'];
        
        if($acompanha == 1){
            $am = 'selected';
            
        }elseif($acompanha == 2){
            $ah = 'selected';
            
        }elseif($acompanha == 3){
            $ad = 'selected';
            
        }
        
        if($sexo == 1){
            $sf = 'selected';
        }elseif($sexo == 2){
            $sm = 'selected';
        }
        
    }else{
        $etniafltr = '';
        $cabelofltr = '';
    }

    if($genero == 'mulheres'){
        $sf = 'selected';
        
    }elseif($genero == 'homens'){
        $sm = 'selected';
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

                        if($etniafltr == $id_et){
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

                            if($cabelofltr == $id_cabelo){
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
        <li> Atende:
            <select name="slc_acompanha">
                <option value="0"> Selecione </option>
                <option value="1" <?php echo $am ?>> Mulheres </option>
                <option value="2" <?php echo $ah ?>> Homens </option>
                <option value="3" <?php echo $ad ?>> Os dois </option>
            </select>
        </li>
        <li class="pesquisa">
            <p onclick="form.submit();">
            <img src="icones/pesquisa.png" class="icone" title="Pesquisar" alt="pesquisar">
            </p>
        </li>
        <input type="text" value="pesquisa" name="buscar" class="hide">
        <li> <a href="?"> Limpar </a> </li>
    </ul>
    </form>
</div>


<div id="lista_acompanhantes">
    <?php
    
    if(isset($_GET['var'])){
        echo '<script> form.submit(); </script>';
        
    }
                        
    if(isset($_GET['buscar'])){
        
        $etnia = $_GET['slc_etnia'];
        $corCabelo = $_GET['slc_cor_cabelo'];
        $sexo = $_GET['slc_sexo'];
        $acompanha = $_GET['slc_acompanha'];
        
        $dadospesq = [
            'etnia' => $etnia,
            'cor_cabelo' => $corCabelo,
            'sexo' => $sexo,
            'acompanha' => $acompanha 
        ];
            
        $pesq = new ControllerAcompanhante();
        $rs = $pesq->BuscarFiliadosFiltro($dadospesq);
        
        $msg = 'Não há filiados com estas caracteristicas';
        
    }else{
        
        $controller = new ControllerAcompanhante();
        $rs = $controller->ListarFiliados();
        $msg = "Ainda não há filiados";
    }
    
    if($rs != false){
        $cont = 0;
        while($cont < count($rs)){
        
            $id = $rs[$cont]->id;
            $nome = $rs[$cont]->apelido;
            $foto = $rs[$cont]->foto;
            $uf   = $rs[$cont]->uf;
?>
    <div class="acompanhante">
        <a href="perfil-filiado<?php echo $php ?>?codigo=<?php echo $id ?>">
            <img src="<?php echo $foto ?>">
            <div class="tonight"></div>
            <p> Nome:<?php echo $nome ?></p>
            <p> Estado: <?php echo $uf ?> </p>
        </a>
    </div>
    
<?php
            $cont++;
        }
    }else{
        
        echo '<center> '.$msg.' </center>';
        
    }
?>
    
    <div style="clear: both;"></div>
</div>
